<?php

namespace App\Http\Controllers\Employer;

use App\CompanyAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->account->id);
        return view('employer.profile.view', [
            'company_name' => $company->name,
            'company_website' => $company->website,
            'company_email' => $company->email,
            'company_phone' => $company->phone,
        ]);
    }

    public function edit()
    {
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->account->id);
        return view('employer.profile.edit', [
            'company_name' => $company->name,
            'company_website' => $company->website,
            'company_email' => $company->email,
            'company_phone' => $company->phone,
        ]);
    }

    public function update(Request $request)
    {
        $company = CompanyAccount::findOrFail(Auth::guard('employer')->user()->account->id);

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

        return view('employer.profile.view', [
            'company_name' => $company->name,
            'company_website' => $company->website,
            'company_email' => $company->email,
            'company_phone' => $company->phone,
        ]);
    }
}
