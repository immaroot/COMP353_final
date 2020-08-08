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

                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Job Position</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td>Tech</td>
                                    <td>programmer</td>
                                    <td><a class="btn btn-primary" href="#" role="button">23 applicants</a></td>
                                </tr>

                        </tbody>
                    </table>

            </div>
        </div>
    </div>
@endsection
