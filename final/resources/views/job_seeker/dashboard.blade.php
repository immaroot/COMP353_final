@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Job Seeker Dashboard</div>

                    <div class="card-body">
                        Hi there {{ Auth::guard('job_seeker')->user()->name }}. Here we will have job postings for you to apply..
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
