@extends('layouts.admin_base')
@section('page_title','Admin | CodeWithSadiQ')
@section('dashboard_select','active')
@section('content')
    <div class="container px-4">
        <h4>Dashboard</h4>
        <div class="row mt-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
            <div class="col">
                <div class="card cws-shadow border-0 border-start border-3 border-danger rounded-0">
                    <div class="card-header bg-white border-0 rounded-0">
                        Total Courses
                    </div>
                    <div class="card-body d-flex">
                        <span class="ms-"><img src="{{ asset('assets/images/icons/book.svg') }}" style="height: 40px;" class="img-fluid"></span>
                        <span class="ms-4"><h2>{{ $course }}</h2></span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card cws-shadow border-0 border-start border-3 border-info rounded-0">
                    <div class="card-header bg-white border-0 rounded-0">
                        Total Users
                    </div>
                    <div class="card-body d-flex">
                        <span><h2>{{ $users }}</h2></span>
                        {{-- <span><img src="{{ asset('assets/images/icons/book.svg') }}" style="height: 18px;" class="img-fluid "></span> --}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card cws-shadow border-0 border-start border-3 border-warning rounded-0">
                    <div class="card-header bg-white border-0 rounded-0">
                        Total Dues Payments
                    </div>
                    <div class="card-body">
                        @php
                            $paid = 0;
                            foreach ($payments as $p) {
                                $paid += $p->fee;
                            }
                            $dues_payment = 0;
                            foreach ($dues as $due) {
                                $dues_payment += $due->course->discount_price;
                            }
                        @endphp
                        <h2>₹
                            @if (($dues_payment - $paid) > 0)
                                {{  $dues_payment - $paid }}
                            @else
                                0
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card cws-shadow border-0 border-start border-3 border-success rounded-0">
                    <div class="card-header bg-white border-0 rounded-0">
                        Total Payments
                    </div>
                    <div class="card-body">
                        <h2>₹ {{ $paid }}</h2>
                    </div>
                </div>
            </div>
        </div>
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
                            <td>{{ $payment->fee }}</td>
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
