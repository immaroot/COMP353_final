@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{  url()->previous()  }}">Back</a>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Post A Job') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('employer/job_posts/' . $job_id ) }}" aria-label="{{ __('Job Post') }}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" id="job_id" name="job_id" value="{{ $job_id }}">

                            <div class="form-group row">
                                <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Job Position') }}</label>

                                <div class="col-md-6">
                                    <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ $position }}" required autocomplete="position" autofocus>

                                    @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Job Description') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" required autocomplete="description">{{ $description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category Of Job') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="category" name="category">
                                        <option value="1" @if($category == '1') selected @endif>Finance</option>
                                        <option value="2" @if($category == '2') selected @endif>Restaurant</option>
                                    </select>

                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Category Of Job') }}</label>

                                <div class="col-md-6">
                                    <input id="salary" type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ $salary }}" required autocomplete="salary" autofocus>

                                    @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status Of Job') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="status" name="status">
                                        <option value="0" @if($status == '0') selected @endif>Available</option>
                                        <option value="1" @if($status == '1') selected @endif>Position Filled</option>
                                        <option value="2" @if($status == '2') selected @endif>Removed</option>
                                    </select>

                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
