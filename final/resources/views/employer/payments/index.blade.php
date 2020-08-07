@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{ url('/employer/payments/methods') }}">Manage Payment Method</a>
            <a class="nav-link" href="{{ url('/employer/payments/preference') }}">Change Payment Preferences</a>
            <a class="nav-link" href="{{ url('/employer') }}">Dashboard</a>
        </nav>
        <div class="row">
            <div class="col">
                <h3>Payments History</h3>
                @if (isset($payments) && $payments->count() > 0)
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Method</th>
                            <th scope="col">Card Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->method }}</td>
                                <td>{{ $payment->card_number }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h5>No payments have been made</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
