@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('/employer') }}">Dashboard</a>
        </nav>
        <div class="row">
            <div class="col-md-6">
                <h3>Your Company Profile</h3>

                <dl class="row">
                    <dt class="col-sm-6">Company Name</dt>
                    <dd class="col-sm-6">{{ $company_name }}</dd>
                    <dt class="col-sm-6">Company Website</dt>
                    <dd class="col-sm-6">{{ $company_website }}</dd>
                    <dt class="col-sm-6">Company Email</dt>
                    <dd class="col-sm-6">{{ $company_email }}</dd>
                    <dt class="col-sm-6">Company Phone Number</dt>
                    <dd class="col-sm-6">{{ $company_phone }}</dd>
                </dl>
            </div>
            <div class="col-md-6">
                <h3 class="pb-5">Your Company Account Level</h3>
                @if ($membership == 1)
                    Prime
                @elseif ($membership == 2)
                    Gold
                @else
                    Basic
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-6 align-content-center">
                <a href="{{ url('employer/account/profile/edit') }}">Modify Profile</a>
            </div>
            <div class="col-6 align-content-center">
                <a href="{{ url('employer/account/profile/edit_level') }}">Change Membership</a>
            </div>
        </div>
    </div>
@endsection
