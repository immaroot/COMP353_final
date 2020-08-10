@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="/job_seeker">Back</a>
        </nav>
        <div class="row">
            <div class="col-md-6">
                <h3>Profile</h3>

                <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $name }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $description }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $email }}</dd>
                </dl>
            </div>
            <div class="col-md-6">
                <h3>Account</h3>

                <h4>Your Subscription Level:</h4>
                @if ($membership == 1)
                    <h4>Prime</h4>
                @elseif ($membership == 2)
                    <h4>Gold</h4>
                @else
                    <h4>Basic</h4>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-6 align-content-center">
                <a href="{{ url('job_seeker/account/edit') }}">Modify Profile</a>
            </div>
            <div class="col-6 align-content-center">
                <a href="{{ url('job_seeker/account/edit_level') }}">Change Membership</a>
            </div>
        </div>
    </div>
@endsection