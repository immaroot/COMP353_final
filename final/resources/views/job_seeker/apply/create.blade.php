@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{  url()->previous()  }}">Back</a>
        </nav>

        <div class="row">
            <div class="col">
                <h3>Selected Job Listing details</h3>
                @if (isset($jobPostings) && $jobPostings->count() > 0)
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Job Position</th>
                            <th scope="col">Description</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Date Created</th>
                            <!-- <th scope="col">Status</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobPostings as $jobPostings)
                            <tr>
                                <td>{{ $jobPostings->name }}</td>
                                <td>{{ $jobPostings->position }}</td>
                                <td>{{ $jobPostings->description }}</td>
                                <td>{{ $jobPostings->salary }}</td>
                                <td>{{ $jobPostings->created_at }}</td>
                                <!-- <td>{{ $jobPostings->status }}</td> !-->
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h5>No job listings yet.</h5>
                @endif
            </div>
        </div>
    </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Apply for Job') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('employer/job_posts') }}" aria-label="{{ __('Job Post') }}">
                            @csrf

                             <div class="form-group row">
                                <label for="postID" class="col-md-4 col-form-label text-md-right">{{ __('Job post ID') }}</label>

                                <div class="col-md-6">
                                    <input disabled ="true" id="postID" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" required autocomplete="message" autofocus >
                                    </textarea>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Job Application Details') }}</label>

                                <div class="col-md-6">
                                    <textarea id="position" rows="20" cols="100" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" required autocomplete="message" autofocus >
                                    </textarea>

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
                                        {{ __('Apply') }}
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
