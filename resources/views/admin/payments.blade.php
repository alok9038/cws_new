@extends('layouts.admin_base')
@section('page_title','Admin | CodeWithSadiQ')
@section('earning_select','active')
@section('content')
    <div class="container px-4">
        <span class="d-flex my-3"><h4>Earnings</h4> <a href="{{ route('admin.due.payments') }}" class="btn btn-info ms-auto"> Dues Payments</i></a></span>
    </div>
    <div class="container px-4 mt-4">
        <div class="card cws-shadow border-0 border-start border-3 border-danger rounded-0">
            <div class="card-header bg-white border-0 rounded-0">
                Payment History
            </div>
            <div class="card-body border-top">
                <table class="table table-md table-borderless">
                    <tr>
                        <th>Sr no.</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                    @php
                        $sr = 0;
                    @endphp
                    @foreach ($get_payments as $payment)
                    @php
                        $sr += 1;
                        $time = strtotime($payment->created_at);
                        $date = date("d M Y",$time );
                    @endphp
                        <tr>
                            <td>{{ $sr }}</td>
                            <td>{{ $payment->student->name }}</td>
                            <td>{{ $payment->enrolled_course->course->title }}</td>
                            <td class="text-success fw-bold">₹ {{ $payment->fee }}</td>
                            <td>{{ $date }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="card-footer d-flex border-0 bg-transparent">
                <div class="ms-auto">{!! $get_payments->links() !!}</div>
            </div>
        </div>
    </div>
@endsection
