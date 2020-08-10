@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('/employer') }}">Dashboard</a>
        </nav>
        <div class="row">
            <div class="col-md-6">
                <h3>Job Listing</h3>

                <dl class="row">
                    <dt class="col-sm-3">Category</dt>
                    <dd class="col-sm-9">{{ $job_post->category->name }}</dd>
                    <dt class="col-sm-3">Job Position</dt>
                    <dd class="col-sm-9">{{ $job_post->position }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9 text-truncate">{{ $job_post->description }}</dd>
                    <dt class="col-sm-3">Salary</dt>
                    <dd class="col-sm-9">{{ $job_post->salary }}</dd>
                    <dt class="col-sm-3">Date Created</dt>
                    <dd class="col-sm-9">{{ $job_post->created_at }}</dd>
                </dl>
            </div>
            <div class="col-md-6">
                <h3 class="pb-5">Your Profile</h3>
                <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $job_seeker->name }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $job_seeker->email }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $job_seeker->description() }}</dd>
                </dl>

            </div>
        </div>
@endsection
