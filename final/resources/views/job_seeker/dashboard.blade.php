@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="container" style="align-content: center;">
                <h1 class="text-center"> Welcome Job Seeker!</h1>
            </div>
        </div>
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('employer/job_applications') }}">Search For Job Posts</a>
            <a class="nav-link" href="{{ url('employer/employees') }}">Manage Job Applications</a>
            <a class="nav-link" href="{{ url('employer/account') }}">Manage Account</a>
            <a class="nav-link" href="{{ url('employer/payments') }}">Payments</a>
        </nav>
        <div class="row">
            <div class="col">
                <h3>Current Job Listing</h3>
                @if (isset($job_applications) && $job_applications->count() > 0)
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Job Position</th>
                            <th scope="col">Description</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($job_applications as $job_application)
                            <tr>
                                <td>{{ $job_application->job_category_id }}</td>
                                <td>{{ $job_application->position }}</td>
                                <td>{{ $job_application->description }}</td>
                                <td>{{ $job_application->salary }}</td>
                                <td>{{ $job_application->created_at }}</td>
                                <td>{{ $job_application->status }}</td>
                                <td><a href="{{ url('/employer/job_applications/' . $job_application->id . '/edit' ) }}">Modify</a></td>
                                <td><a href="{{ url('/employer/job_applications/' . $job_application->id . '/remove' ) }}">Remove</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h5>No job listings yet.</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
