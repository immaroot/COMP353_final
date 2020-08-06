<?php

namespace App\Http\Controllers\Employer;

use App\CompanyAccount;
use App\Employer;
use App\WorksFor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function create(){
        Auth::guard('employer')->check();

        return view('employer.employees.create');
    }

    public function store(Request $request){
        Auth::guard('employer')->check();

        $employer = Auth::guard('employer')->user();
        if (!$this->userCanAddUser($employer))
        {
            return abort('404');
        }

        $this->validator($request->all())->validate();

        $employee = Employer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => '2',
        ]);


        WorksFor::create([
            'user_id' => $employee->id,
            'company_account_id' => $employer->company()->id,
        ]);

        //return some view.. for now the dashboard..
        return view('employer.dashboard');


    }

    public function userCanAddUser(Employer $user)
    {
        return $user->company()->company_manager_user_id == $user->id;
    }
}
