@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{  url()->previous()  }}">Back</a>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Choose Your Preferred Membership Type') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('job_seeker/account/edit_level') }}" aria-label="{{ __('Edit Membership') }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label for="membership" class="col-md-4 col-form-label text-md-right">{{ __('Membership Type') }}</label>

                                <div class="col-md-6">
                                    <select id="membership" class="form-control @error('membership') is-invalid @enderror" name="membership" required>
                                        <option value="basic" {{ $account_level == 0 ? 'selected' : '' }}>Basic</option>
                                        <option value="prime" {{ $account_level == 1 ? 'selected' : '' }}>Prime</option>
                                        <option value="gold" {{ $account_level == 2 ? 'selected' : '' }}>Gold</option>
                                    </select>
                                    @error('membership   ')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
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
