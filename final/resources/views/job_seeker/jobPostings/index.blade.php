@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('/employer/job_posts/create') }}">Add New Job Offer</a>
            <a class="nav-link" href="{{ url('/employer') }}">Dashboard</a>
        </nav>
        <div class="row">
            <div class="col">
                <h3>Current Job Listing</h3>
                @if (isset($jobPostings) && $jobPostings->count() > 0)
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Job Position</th>
                            <th scope="col">Description</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Date Created</th>
                            <!-- <th scope="col">Status</th> -->
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobPostings as $jobPostings)
                            <tr>
                                <td>{{ $jobPostings->name }}</td>
                                <td>{{ $jobPostings->position }}</td>
                                <td>{{ $jobPostings->description }}</td>
                                <td>{{ $jobPostings->salary }}</td>
                                <td>{{ $jobPostings->created_at }}</td>
                                <!-- <td>{{ $jobPostings->status }}</td> !-->
                                <td><a href="{{ url('/job_seeker/apply/' . $jobPostings->id) }}">Apply</a></td>
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
