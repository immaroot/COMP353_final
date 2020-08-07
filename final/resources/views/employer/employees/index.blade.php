@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('/employer/employees/create') }}">Add New User</a>
            <a class="nav-link" href="{{ url('/employer') }}">Dashboard</a>
        </nav>
        <div class="row">
            <div class="col">
                @if (isset($users) && $users->count() > 0)
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td></td>
                            <td><a href="{{ url('/employer/job_posts/edit' ) }}">Modify</a></td>
                            <td><a href="{{ url('/employer/job_posts/remove' ) }}">Remove</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h5>No other users yet.</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
