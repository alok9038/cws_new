@extends('layouts.user_base')
@section('page_title','Payments | codeWithSadiQ')
@section('payment_select','active')
@section('content')
<div class="container px-4 mt-4">
    <div class="card cws-shadow border-0 border-start border-3 border-danger rounded-0">
        <div class="card-header bg-white border-0 rounded-0">
            Payment History
        </div>
        <div class="card-body border-top">
            <table class="table table-md table-borderless">
                <tr>
                    <th>Sr no.</th>
                    <th>txn no</th>
                    <th>Course</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                @php
                    $sr = 0;
                @endphp
                @foreach ($payments as $payment)
                @php
                    $sr += 1;
                    $time = strtotime($payment->created_at);
                    $date = date("d M Y",$time );
                @endphp
                    <tr>
                        <td>{{ $sr }}</td>
                        <td>{{ $payment->transaction_id }}</td>
                        <td>{{ $payment->enrolled_course->course->title }}</td>
                        <td>₹ {{ $payment->fee }}</td>
                        <td>{{ $date }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer d-flex border-0 bg-transparent">
            <div class="ms-auto">{!! $payments->links() !!}</div>
        </div>
    </div>
</div>
@endsection
