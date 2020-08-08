@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url()->previous() }}">Back</a>
        </nav>
        <div class="row">
            <div class="col align-content-center">
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
        </div>
        <div class="row">
            <div class="col">
                <h3>Current Job Applications</h3>
                @if (isset($applications) && $applications->count() > 0)
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Description</th>
                            <th scope="col">Message</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $application->job_seeker->name }}</td>
                                <td>{{ $application->job_seeker->email }}</td>
                                <td class="text-truncate">{{ $application->job_seeker->description }}</td>
                                <td class="text-truncate">{{ $application->message }}</td>
                                <td>{{ $application->created_at }}</td>
                                <td>{{ $application->status }}</td>
                                <td><a href="{{ url('/employer/applications/' . $application->id . '/edit' ) }}">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h5>No job applications yet.</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
