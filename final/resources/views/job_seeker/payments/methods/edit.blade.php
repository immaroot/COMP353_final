@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{  url()->previous()  }}">Back</a>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Your Payment Method') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('job_seeker/payments/methods/' . $payment_method_id ) }}" aria-label="{{ __('Job Post') }}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" id="payment_method_id" name="payment_method_id" value="{{ $payment_method_id }}">

                            <div class="form-group row">
                                <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>

                                <div class="col-md-6">
                                    <input id="payment_method" type="text" class="form-control @error('payment_method') is-invalid @enderror" name="payment_method" value="{{ $payment_method }}" required autocomplete="payment_method" autofocus>

                                    @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="card_number" class="col-md-4 col-form-label text-md-right">{{ __('Card Number') }}</label>

                                <div class="col-md-6">
                                    <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="{{ $card_number }}" required autocomplete="card_number" autofocus>

                                    @error('card_number')
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
