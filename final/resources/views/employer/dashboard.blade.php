@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Employer Dashboard</div>

                    <div class="card-body">
                        Hello {{ Auth::guard('employer')->user()->name }}. You are an Employer!
                        <a class="btn btn-primary" href="{{ url('employer/job_posts/create') }}" role="button">Post A Job!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
