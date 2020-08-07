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
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user->isAdmin())
                        <tr class="table-danger">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td></td>
                        </tr>
                        @else
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ url('employer/employees/'. $user->id) }}" method="post">
                                    <button type="submit" class="btn btn-link">Delete</button>
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endif
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
