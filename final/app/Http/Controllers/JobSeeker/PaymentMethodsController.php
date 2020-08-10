<?php

namespace App\Http\Controllers\JobSeeker;

use App\JobSeeker;
use App\Payment;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();

        $payment_methods = $job_seeker->profile->payment_methods();
        return view('job_seeker.payments.methods.index', ['payment_methods' => $payment_methods]);
    }

    public function create()
    {
        Auth::guard('job_seeker')->check();
        $job_seeker = JobSeeker::findOrfail(Auth::guard('job_seeker')->user()->id);

        return view('job_seeker.payments.methods.create');
    }

    public function store(Request $request)
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();

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
        $payment_method->account_id = $job_seeker->profile->id;

        $payment_method->is_automatic = $request['automatic'] == "true";
        $payment_method->is_preferred = $request['preferred'] == "true";

        if ($job_seeker->profile->payment_methods()->count() < 1)
        {
            $payment_method->is_preferred = true;
        }


        $payment_method->save();

        return redirect('job_seeker/payments/methods');
    }

    public function edit($id)
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();
        $payment_method = PaymentMethod::findOrFail($id);

        if (!$this->paymentMethodBelongsToProfile($job_seeker, $payment_method))
        {
            return abort('404');
        }

        return view('job_seeker.payments.methods.edit', [
            'payment_method_id' => $payment_method->id,
            'payment_method' => $payment_method->method,
            'card_number' => $payment_method->card_number,
        ]);
    }

    public function update(Request $request)
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();
        $payment_method = PaymentMethod::findOrFail($request['payment_method_id']);

        if (!$this->paymentMethodBelongsToProfile($job_seeker, $payment_method))
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

        return redirect('job_seeker/payments/methods');
    }

    public function showPreference()
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();

        $payment_methods = $job_seeker->profile->payment_methods();
        return view('job_seeker.payments.methods.preference', ['payment_methods' => $payment_methods]);
    }

    public function updatePreference(Request $request)
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();

        $request->validate([
            'preference' => 'required',
        ]);

        $payment_methods = $job_seeker->profile->payment_methods();
        $preferred_method = PaymentMethod::findOrFail($request['preference']);

        if (!$this->paymentMethodBelongsToProfile($job_seeker, $preferred_method))
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

        return redirect('job_seeker/payments');
    }

    public function destroy($id)
    {
        Auth::guard('job_seeker')->check();

        $job_seeker = Auth::guard('job_seeker')->user();
        $payment_method = PaymentMethod::findOrFail($id);

        if (!$this->paymentMethodBelongsToProfile($job_seeker, $payment_method))
        {
            return abort('404');
        }

        if ($payment_method->is_preferred == true)
        {
            $next_preferred = $job_seeker->profile->payment_methods()->except($payment_method->id)->first();
            $next_preferred->is_preferred = true;
            $next_preferred->save();
        }

        $payment_method->delete();

        return $this->index();
    }

    public function paymentMethodBelongsToProfile($job_seeker, $payment_method)
    {
        return $job_seeker->profile->payment_methods()->contains($payment_method);
    }
}
