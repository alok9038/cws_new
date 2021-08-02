@extends('layouts.newBase')
@section('page_title','Admin | CodeWithSadiQ')
@section('earning_select','mm-active')
@section('content')
    <div class="container px-4">
        <span class="d-flex my-3"><h4>Earnings</h4> <a href="{{ route('add.course.view') }}" class="btn btn-info ms-auto"> Dues Payments</i></a></span>
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
                        {{-- <th>Course</th> --}}
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                    @php
                        $paid_amount = 0;
                        $sr = 0;
                    @endphp
                    @foreach ($enrolls as $enroll)
                        @php
                            $payment = paid_amount($enroll->id);
                            foreach ($payment as $paid) {
                                $paid_amount += $paid->fee;
                            }
                            $sr += 1;
                            $time = strtotime($enroll->created_at);
                            $date = date("d M Y",$time );
                        @endphp
                        <tr>
                            <td>{{ $sr }}</td>
                            <td>{{ $enroll->student->name }}</td>
                            {{-- <td>{{ $enroll->course->title }}</td> --}}
                            <td class="text-success fw-bold">₹ {{ $enroll->fee }}</td>
                            <td>{{ $date }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="card-footer d-flex border-0 bg-transparent">
                {{-- <div class="ms-auto">{!! $get_payments->links() !!}</div> --}}
            </div>
        </div>
    </div>
@endsection
