<?php

namespace App\Http\Controllers\Auth;

use App\CompanyAccount;
use App\Employer;
use App\Http\Controllers\Controller;
use App\WorksFor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployerRegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:employer')->except('logout');
        $this->middleware('guest:job_seeker')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function createEmployer(Request $request)
    {
        $this->validator($request->all())->validate();

        $employer = Employer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => '2',
        ]);

        $account = CompanyAccount::create([
            'name' => $request['company_name'],
            'phone' =>$request['phone'],
            'email' => $request['email'],
            'website' => $request['website'],
            'level' => $request['level'],
            'company_manager_user_id' => $employer->id,
        ]);

        WorksFor::create([
            'user_id' => $employer->id,
            'company_account_id' => $account->id,
        ]);
        Auth::login($employer);
        return redirect()->intended('employer');
    }

    public function showEmployerRegisterForm()
    {
        return view('employer.auth.register');
    }
}
