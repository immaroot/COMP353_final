@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
            <div class="container" style="align-content: center;">
                <div class ="row">
                    <div class = "col text-center">
                        <h1 class="text-center"> Welcome Job Seeker!</h1>
                        <a class="btn btn-primary" href="job_seeker/job_posts"> Search for Jobs!</a>
                    </div>
                </div>
            </div>
    </div>
    <nav class="nav pb-5">
        <a class="nav-link" href="{{ url('job_seeker/applications') }}">Manage Applications</a>
        <a class="nav-link" href="{{ url('job_seeker/account') }}">Manage Account</a>
        <a class="nav-link" href="{{ url('job_seeker/payments') }}">Payments</a>

    </nav>
    <div class="row">
        <div class="col">
            <h3>Current Job Applications</h3>
            @if (isset($applications) && $applications->count() > 0)
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Job Name</th>
                    <th scope="col">Posted Date</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($applications as $application)
                <tr>
                    <td>{{ $application->job_post->position }}
                    <td>{{ $application->job_post->created_at }}</td>
                    <td>{{ $application->created_at }}</td>
                    <td><a class="btn btn-primary" href="{{url('job_seeker/job_posts/'. $application->job_post->id .'/disp')}}">View Job Post</a></td>
                    <td>{{ $application->application_status->name }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h5>No job applications.</h5>
            @endif
        </div>
    </div>
</div>
@endsection
