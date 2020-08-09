@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url()->previous() }}">Back</a>
        </nav>
        <div class="row">
            <div class="col align-content-center">
                <h3>Job Listing</h3>

                <dl class="row">
                    <dt class="col-sm-3">Category</dt>
                    <dd class="col-sm-9">{{ $job_post->category->name }}</dd>
                    <dt class="col-sm-3">Job Position</dt>
                    <dd class="col-sm-9">{{ $job_post->position }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9 text-truncate">{{ $job_post->description }}</dd>
                    <dt class="col-sm-3">Salary</dt>
                    <dd class="col-sm-9">{{ $job_post->salary }}</dd>
                    <dt class="col-sm-3">Date Created</dt>
                    <dd class="col-sm-9">{{ $job_post->created_at }}</dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col align-content-center">
                <h3>Job Application</h3>

                <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $application->job_seeker->name }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $application->job_seeker->email }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $application->job_seeker->description }}</dd>
                    <dt class="col-sm-3">Message</dt>
                    <dd class="col-sm-9">{{ $application->message }}</dd>
                    <dt class="col-sm-3">Date Created</dt>
                    <dd class="col-sm-9">{{ $application->created_at }}</dd>
                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">{{ $application->application_status->name }}</dd>
                </dl>
            </div>
        </div>
        <div class="row">
            <div class="col align-content-center">
                <h3>Change Status Of Application</h3>
                <form method="POST" action="{{ url('/employer/applications/' . $job_post->id . '/' . $application->id ) }}" aria-label="{{ __('Edit application_status') }}">
                @method('PUT')
                @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <select id="application_status" class="form-control @error('application_status') is-invalid @enderror" name="application_status" required>
                                <option value="being reviewed" {{ $application->status == 0 ? 'selected' : '' }}>Being Reviewed</option>
                                <option value="accepted" {{ $application->status == 1 ? 'selected' : '' }}>Accepted</option>
                                <option value="denied" {{ $application->status == 2 ? 'selected' : '' }}>Denied</option>
                            </select>
                            @error('application_status   ')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
