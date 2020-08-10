@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Company's Profile</div>
                    <div class="card-body">
                        <p class="card-text">
                            Company's Name : {{ $company_name }}
                        </p>
                        <p class="card-text">
                            Company's Website : {{ $company_website }}
                        </p>
                        <p class="card-text">
                            Company's Email : {{ $company_email }}
                        </p>
                        <p class="card-text">
                            Company's Phone Number : {{ $company_phone }}
                        </p>
                        <a class="btn btn-primary" href="{{ url('employer/profile/edit') }}" role="button">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
