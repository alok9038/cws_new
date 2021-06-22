@extends('layouts.user_base')
@section('page_title','user | codeWithSadiQ')
@section('setting_select','active')
@section('content')
<div class="container px-lg-5">
    <h4>Setting</h4>
    <div class="card mt-4 border-0 rounded-10 cws-shadow bg-white">
        <div class="card-header p-4 border-0 bg-light" style="height: 70px;">

        </div>
        <div class="img d-flex" style="margin-top:-50px;">
            <img src="{{ asset('assets/images/students/'.Auth()->user()->image) }}" style="height: 90px; width:90px;" alt="" class="img-fluid border-0 cws-shadow rounded-circle mx-auto">
        </div>
        <div class="card-body text-center">
            <h6 class="h5">{{ Auth()->user()->name }}</h6>
            <h4 class="h6 mt-2">Father's name : {{ Auth()->user()->father_name }}</h4>
            <h4 class="h6 mt-2">Mother's name : {{ Auth()->user()->mother_name }}</h4>
            <h4 class="small mt-2">Date Of birth : {{ Auth()->user()->dob }}</h4>
            <h4 class="small mt-2">Address : {{ Auth()->user()->address }}</h4>
        </div>
    </div>

    <div class="card border-0 mt-4 rounded-0 cws-shadow">
        <div class="card-header bg-white border-start border-info border-3  border-0">
            Change Password
        </div>
        <div class="card-body border-top">
            <form action="{{ route('change.password') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="text" name="oldpassword" class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="text" name="newpassword" class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Submit" class="btn btn-dark float-end cws-shadow-md">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
