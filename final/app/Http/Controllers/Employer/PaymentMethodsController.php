<?php

namespace App\Http\Controllers\Employer;

use App\CompanyAccount;
use App\Employer;
use App\Payment;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();

        if (!$this->userCanManagePayments($employer))
        {
            return abort('404');
        }
        $payment_methods = $employer->company()->payment_methods();
        return view('employer.payments.methods.index', ['payment_methods' => $payment_methods]);
    }

    public function create()
    {
        Auth::guard('employer')->check();
        $employer = Employer::findOrfail(Auth::guard('employer')->user()->id);

        if (!$this->userCanManagePayments($employer))
        {
            return abort('404');
        }

        return view('employer.payments.methods.create');
    }

    public function store(Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();

        if (!$this->userCanManagePayments($employer))
        {
            return abort('404');
        }

        $request->validate([
            'payment_method' => 'required',
            'card_number' => 'required',
        ]);

        $payment_methods = PaymentMethod::all();

        if ($request['preferred'] == "true")
        {
            foreach ($payment_methods as $payment_method)
            {
                $payment_method->is_preferred = false;
                $payment_method->save();
            }
        }

        $payment_method = new PaymentMethod();
        $payment_method->method = $request['payment_method'];
        $payment_method->card_number = $request['card_number'];
        $payment_method->account_role = 2;
        $payment_method->account_id = $employer->company()->id;

        $payment_method->is_automatic = $request['automatic'] == "true";
        $payment_method->is_preferred = $request['preferred'] == "true";

        if ($employer->company()->payment_methods()->count() < 1)
        {
            $payment_method->is_preferred = true;
        }


        $payment_method->save();

        return redirect('employer/payments/methods');
    }

    public function edit($id)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $payment_method = PaymentMethod::findOrFail($id);

        if (!$this->userCanManagePayments($employer) || !$this->paymentMethodBelongsToCompanyAccount($employer, $payment_method))
        {
            return abort('404');
        }

        return view('employer.payments.methods.edit', [
            'payment_method_id' => $payment_method->id,
            'payment_method' => $payment_method->method,
            'card_number' => $payment_method->card_number,
        ]);
    }

    public function update(Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $payment_method = PaymentMethod::findOrFail($request['payment_method_id']);

        if (!$this->userCanManagePayments($employer) || !$this->paymentMethodBelongsToCompanyAccount($employer, $payment_method))
        {
            return abort('404');
        }
        $request->validate([
            'payment_method' => 'required',
            'card_number' => 'required',
        ]);

        $payment_method->method = $request['payment_method'];
        $payment_method->card_number = $request['card_number'];

        $payment_method->save();

        return redirect('employer/payments/methods');
    }

    public function showPreference()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();

        if (!$this->userCanManagePayments($employer))
        {
            return abort('404');
        }
        $payment_methods = $employer->company()->payment_methods();
        return view('employer.payments.methods.preference', ['payment_methods' => $payment_methods]);
    }

    public function updatePreference(Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();

        $request->validate([
            'preference' => 'required',
        ]);

        $payment_methods = PaymentMethod::all();
        $preferred_method = PaymentMethod::findOrFail($request['preference']);

        if (!$this->userCanManagePayments($employer) || !$this->paymentMethodBelongsToCompanyAccount($employer, $preferred_method))
        {
            return abort('404');
        }

        foreach ($payment_methods as $payment_method)
        {
            $payment_method->is_preferred = false;
            $payment_method->save();
        }

        $preferred_method->is_preferred = true;
        $preferred_method->is_automatic = $request['automatic'] == "true";
        $preferred_method->save();

        return redirect('employer/payments');
    }

    public function destroy($id)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $payment_method = PaymentMethod::findOrFail($id);

        if (!$this->userCanManagePayments($employer) || !$this->paymentMethodBelongsToCompanyAccount($employer, $payment_method))
        {
            return abort('404');
        }

        if ($payment_method->is_preferred == true)
        {
            $next_preferred = $employer->company()->payment_methods()->except($payment_method->id)->first();
            $next_preferred->is_preferred = true;
            $next_preferred->save();
        }

        $payment_method->delete();

        return $this->index();
    }

    public function userCanManagePayments(Employer $user)
    {
        return $user->company()->company_manager_user_id == $user->id;
    }

    public function paymentMethodBelongsToCompanyAccount($employer, $payment_method)
    {
        return $employer->company()->payment_methods()->contains($payment_method);
    }
}
