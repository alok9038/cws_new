@extends('layouts.user_base')
@section('page_title','user | codeWithSadiQ')
@section('course_select','active')
@section('content')
    <div class="container px-lg-5">
        <h4>My Course</h4>
        <div class="card mt-4 border-0 rounded-0 cws-shadow bg-white">
            <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                Php & Mysqli
            </div>
            <div class="card-body border-top">
                <div class="d-flex p-2 bg-light">
                    <span><img src="https://www.codewithsadiq.com/images/php.jpg" alt="" style="width: 150px;" class="img-fluid"></span>
                    <span class="mt-2 ms-3">Php & Mysqli <br> <p class="small text-danger">rs. 400 dues</p></span>
                </div>
            </div>
        </div>
    </div>
@endsection
