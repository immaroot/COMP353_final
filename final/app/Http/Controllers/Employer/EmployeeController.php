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

    public function create(){
        Auth::guard('employer')->check();
    
        return view('employer.employees.create');
    }

    public function store(Request $request){
        Auth::guard('employer')->check();
        
        //also should we check if the employee is the manager? fix after
        $employer = Employer::findOrfail(Auth::guard('employer') -> user() ->id);

        $employee = new Employer();

        $employee->name = $request['name'];
        $employee->email = $request['email'];
        $employee->password = Hash::make($request['password']);
        //whats a role again ? 
        $employee->role = '2';

        $employee->save();

        $wfEntry = new WorksFor();

        $wfEntry->user_id = $employee->id;
        $wfEntry->company_account_id = $employer->company()->id;
        $wfEntry->save();

        //return some view.. for now the dashboard..
        return view('employer.dashboard');


    }
}