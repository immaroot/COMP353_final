@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
            <div class="container" style="align-content: center;">
                <div class ="row">
                    <div class = "col text-center">
                        <h1 class="text-center">Viewing Job Application</h1>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Application #{{$app->id}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Your current message:</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>{{$app->message}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4>Edit your application message:</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('job_seeker/application/'.$app->id) }}" aria-label="{{ __('Job Application') }}">
        @method('PUT')
        @csrf
            <div class="form-group row">
                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Application Message') }}</label>
                <div class="col-md-6">
                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="3" required autocomplete="message">{{ old('message') }}</textarea>
                        @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col">
            <h3>Would you like to delete your application?</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-danger" href="{{url('job_seeker/application/'.$app->id.'/delete')}}">Delete</a>
        </div>
    </div>
</div>



@endsection
