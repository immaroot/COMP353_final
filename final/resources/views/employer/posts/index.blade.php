@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($job_posts as $job_post)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-subtitle">Position: {{ $job_post->position }}</h5>
                        <p class="card-text">
                            {{ $job_post->description }}
                        </p>
                        <p class="card-text">
                            {{ $job_post->job_category_id }}
                        </p>
                        <a class="stretched-link" href="{{ url('employer/job_posts/' . $job_post->id . '/edit/') }}" role="button">Edit</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
