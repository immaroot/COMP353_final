@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('/employer/job_posts/create') }}">Add New Job Offer</a>
            <a class="nav-link" href="{{ url('/employer') }}">Dashboard</a>
        </nav>
        <div class="row">
            <div class="col">
                <h3>Current Job Applications</h3>
                @if (isset($job_posts) && $job_posts->count() > 0)
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Job Position</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Job Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($job_posts as $job_post)
                            <tr>
                                <td>{{ $job_post->category->name }}</td>
                                <td>{{ $job_post->position }}</td>
                                <td>{{ $job_post->created_at }}</td>
                                <td>{{ $job_post->job_status->name }}</td>
                                <td><a class="btn btn-primary btn-sm" href="{{ url('employer/applications/' . $job_post->id) }}" role="button">{{ $job_post->applicants_count }} applicants</a></td>
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
