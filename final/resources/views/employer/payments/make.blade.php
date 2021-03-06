@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{  url('employer/payments')  }}">Back</a>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Choose Method For Payment') }}</div>
                    <div class="card-body pl-5">
                        <div class="row">
                            <h5>The Amount Due Is {{ $invoice->amount }}</h5>
                        </div>
                        @if (isset($payment_methods) && $payment_methods->count() > 0)
                            <form method="POST" action="{{ url('employer/payments/make') }}" aria-label="{{ __('Job Post') }}">
                                @csrf
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

                                @foreach($payment_methods as $payment_method)
                                    <div class="form-group row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="{{ $payment_method->id }}" value="{{ $payment_method->id }}" {{ $payment_method->is_preferred ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $payment_method->id }}">
                                                {{ $payment_method->method }} {{ $payment_method->card_number }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="automatic" value="true" id="automatic">
                                        <label class="form-check-label" for="automatic">
                                            Make Payments Automatically?
                                        </label>
                                    </div>
                                </div>


                                @else
                                    <h5>No payment methods have been added</h5>
                                @endif
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
