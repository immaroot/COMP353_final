@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url()->previous() }}">Back</a>
        </nav>
        <div class="row">
            <div class="col align-content-center">
                <h3>Profile</h3>

                <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $name }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $email }}</dd>
                    <dt class="col-sm-3">Phone Number</dt>
                    <dd class="col-sm-9">{{ $phone }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $description }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
