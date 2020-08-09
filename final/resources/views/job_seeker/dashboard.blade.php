@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
            <div class="container" style="align-content: center;">
                <div class ="row">
                    <div class = "col text-center">
                        <h1 class="text-center"> Welcome Job Seeker!</h1>
                        <a class="btn btn-primary" href=""> Search for Jobs!</a>
                    </div>
                </div>
            </div>
    </div>
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
                @for ($i = 0; $i < count($applications); $i++)
                <tr>
                    <td>{{ $details[$i] -> position}}
                    <td>{{ $details[$i] -> created_at}}</td>
                    <td>{{ $applications[$i] -> created_at}}</td>
                    <td><a class="btn btn-primary" href="">View Job Post</a></td>
                    <td><a class="btn btn-secondary" href="">Modify Application</a></td>
                </tr>
                @endfor
                </tbody>
            </table>
            @else
            <h5>No job applications.</h5>
            @endif
        </div>
    </div>
</div>
@endsection
