@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $company_name }}</h4>
                        <h5 class="card-subtitle">Position: {{ $position }}</h5>
                        <p class="card-text">
                            {{ $description }}
                        </p>
                        <a class="btn btn-primary " href="{{ url('employer/job_posts/' . $job_id . '/edit/') }}" role="button">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
