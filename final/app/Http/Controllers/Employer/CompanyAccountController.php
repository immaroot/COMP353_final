<?php

namespace App\Http\Controllers\Employer;

use App\CompanyAccount;
use App\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CompanyAccountController extends Controller
{
    public function show()
    {
        $company = Auth::guard('employer')->user()->company();
        return view('employer.profile.view', [
            'company_name' => $company->name,
            'company_website' => $company->website,
            'company_email' => $company->email,
            'company_phone' => $company->phone,
        ]);
    }

    public function index()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->company()->id);
        $level = $company->level;

        if (!$this->userCanManageProfile($employer) || !$this->profileBelongsToCompanyAccount($employer, $company))
        {
            return abort('404');
        }

        return view('employer.account.index', [
            'company_name' => $company->name,
            'company_website' => $company->website,
            'company_email' => $company->email,
            'company_phone' => $company->phone,
            'membership' => $level,
        ]);

    }

    public function edit()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->company()->id);

        if (!$this->userCanManageProfile($employer) || !$this->profileBelongsToCompanyAccount($employer, $company))
        {
            return abort('404');
        }

        return view('employer.account.profile.edit', [
            'company_name' => $company->name,
            'company_website' => $company->website,
            'company_email' => $company->email,
            'company_phone' => $company->phone,
        ]);
    }

    public function update(Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->company()->id);

        if (!$this->userCanManageProfile($employer) || !$this->profileBelongsToCompanyAccount($employer, $company))
        {
            return abort('404');
        }

        $request->validate([
            'company_name' => 'required',
            'website' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $company->name = $request['company_name'];
        $company->website = $request['website'];
        $company->email = $request['email'];
        $company->phone = $request['phone'];
        $company->save();

        return redirect('employer/account');
    }

    public function editMembership()
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->company()->id);

        if (!$this->userCanManageProfile($employer) || !$this->profileBelongsToCompanyAccount($employer, $company))
        {
            return abort('404');
        }

        return view('employer.account.profile.change-membership', [
            'account_level' => $company->level,
        ]);
    }

    public function updateMembership(Request $request)
    {
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->company()->id);

        if (!$this->userCanManageProfile($employer) || !$this->profileBelongsToCompanyAccount($employer, $company))
        {
            return abort('404');
        }

        $request->validate([
            'membership' => 'required',
        ]);

        if ($request['membership'] == 'prime')
            $company->level = 1;

        if ($request['membership'] == 'gold')
            $company->level = 2;

        $company->save();

        return redirect('employer/account');

    }

    public function userCanManageProfile(Employer $user)
    {
        return $user->company()->company_manager_user_id == $user->id;
    }

    public function profileBelongsToCompanyAccount($employer, $company)
    {
        return $employer->company()->id == $company->id;
    }
}
