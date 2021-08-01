@extends('layouts.newBase')
@section('payment_setting','mm-active')
@section('content')
    <div class="container">
        <div class="card border-0 rounded-10 cws-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Payment Settings</h4>
            </div>
            <div class="card-body">
                <div class="div">
                    <form action="{{ route('payment.setting') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_token" value="s6kLmFKjdjFb6FYwkVI2HgeLgM3BVNKVbz7DS0Xk">                    <div class="mb-3">
                            <label for="PAYTM_ENVIRONMENT" class="fw-bold">PAYTM ENVIRONMENT: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" value="{{ env('PAYTM_ENVIRONMENT') }}" id="PAYTM_ENVIRONMENT" name="PAYTM_ENVIRONMENT">
                            <p class="text-muted small">For Live use production and for Test use local as ENVIRONMENT</p>
                        </div>
                        <div class="mb-3">
                            <label for="PAYTM_MERCHANT_ID" class="fw-bold">PAYTM MERCHANT ID: <span class="text-danger">*</span></label>
                            <input type="text" id="PAYTM_MERCHANT_ID" value="{{ env('PAYTM_MERCHANT_ID') }}" class="form-control shadow-none" name="PAYTM_MERCHANT_ID">
                        </div>
                        <div class="mb-3">
                            <label for="PAYTM_MERCHANT_KEY" class="fw-bold">PAYTM MERCHANT KEY: <span class="text-danger">*</span> : </label>
                            <input type="text" id="PAYTM_MERCHANT_KEY" value="{{ env('PAYTM_MERCHANT_KEY') }}" class="form-control shadow-none" name="PAYTM_MERCHANT_KEY">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark sm float-end">Save setting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
