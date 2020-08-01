@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Post A Job') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('employer/job_posts') }}" aria-label="{{ __('Job Post') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Job Position') }}</label>

                                <div class="col-md-6">
                                    <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" required autocomplete="position" autofocus>

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
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" required autocomplete="description">{{ old('description') }}</textarea>
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
                                        <option value="1">Finance</option>
                                        <option value="2">Restaurant</option>
                                    </select>

                                    @error('category')
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
