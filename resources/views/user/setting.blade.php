@extends('layouts.user_base')
@section('page_title','user | codeWithSadiQ')
@section('setting_select','active')
@section('content')
<div class="container me-auto px-lg-5">
    <h4>Setting</h4>
    <div class="row">
        <div class="col-lg-4 ">
            <div class="card mt-4 border-0 rounded-10 cws-shadow bg-white p-3">
                <img src="{{ asset('assets/images/students/'.Auth()->user()->image) }}" style="height: 243px; width:100%;" alt="" class="img-fluid border-0 rounded-10 cws-shadow card-img-top mx-auto">
                <div class="card-footer">
                    <a href="" class="btn btn-dark">change</a>
                </div>
            </div>
        </div>
        <div class="card mt-4 border-0 col-lg-8 rounded-10 cws-shadow bg-white">
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
    </div>


</div>
<div class="container mt-5 px-lg-5">
    <h5>Account Settings</h5>
    <div class="card border-0 cws-shadow-md rounded-10">
        <div class="card-body">
            <form action="{{ route('update.admin.details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col">
                        <label class="fw-bold">Name</label>
                        <input type="text" name="name" value="{{ Auth()->user()->name }}" class="form-control shadow-none">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="mother_name" class="fw-bold">Mother's Name</label>
                        <input type="text" name="mother_name" value="{{ Auth()->user()->mother_name }}" class="form-control shadow-none">
                    </div>
                    <div class="mb-3 col">
                        <label for="father_name" class="fw-bold">Father's Name</label>
                        <input type="phone" name="father_name" value="{{ Auth()->user()->father_name }}" class="form-control shadow-none">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="email" class="fw-bold">Email</label>
                        <input type="email" name="email" value="{{ Auth()->user()->email }}" class="form-control shadow-none">
                    </div>
                    <div class="mb-3 col">
                        <label for="phone" class="fw-bold">Phone</label>
                        <input type="phone" name="phone" value="{{ Auth()->user()->contact }}" class="form-control shadow-none">
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-dark btn-sm float-end">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container my-5 px-lg-5">
    <h5>Change Password</h5>
    <div class="card border-0 cws-shadow-md rounded-10">
        <div class="card-body">
            <form action="{{ route('change.password') }}" method="POST">
                @csrf
                <div class="mb-3 col">
                    <label class="fw-bold">Current Password</label>
                    <input type="password" name="current_password" class="form-control shadow-none">
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label class="fw-bold" for="email">New Password</label>
                        <input type="password" name="password" class="form-control shadow-none">
                        @error('password')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 col">
                        <label class="fw-bold">Confirm Passoword</label>
                        <input type="password" name="password_confirmation" class="form-control shadow-none">
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-dark btn-sm float-end">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
