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
                        <span><h2>24</h2></span>
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
                        <h2>$ 324</h2>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card cws-shadow border-0 border-start border-3 border-success rounded-0">
                    <div class="card-header bg-white border-0 rounded-0">
                        Total Payments
                    </div>
                    <div class="card-body">
                        <h2>$ 3824</h2>
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
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
