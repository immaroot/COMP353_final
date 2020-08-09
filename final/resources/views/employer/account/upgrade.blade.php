@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="nav pb-5">
            <a class="nav-link" href="{{  url()->previous()  }}">Back</a>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Upgrade Your Membership') }}</div>

                    <div class="card-body">
                        You need to upgrade to Gold to post more job listings.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
