@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{  url('job_seeker/payments/methods/add')  }}">Add A Payment Method</a>
            <a class="nav-link" href="{{  url('job_seeker/payments')  }}">Back</a>
        </nav>
        <div class="row">
            <div class="col">
                <h3>Payments Methods</h3>
                @if (isset($payment_methods) && $payment_methods->count() > 0)
                    @foreach($payment_methods as $payment_method)
                    <div class="card col-sm-9">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-9">
                                        <dl class="row">
                                            <dt class="col-sm-3">Method</dt>
                                            <dd class="col-sm-9">{{ $payment_method->method }}</dd>
                                            <dt class="col-sm-3">Card Number</dt>
                                            <dd class="col-sm-9">{{ $payment_method->card_number }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-link" href="{{ url('job_seeker/payments/methods/' . $payment_method->id . '/edit') }}">Modify</a>
                                        <form action="{{ url('job_seeker/payments/methods/'. $payment_method->id) }}" method="post">
                                            <button type="submit" class="btn btn-link">Delete</button>
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <h5>No payment methods have been added</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
