@extends('layouts.base')
@section('page_title','CodeWithSadiQ')
@section('banner')
<div class="container" style="padding-top: 100px;">
    <div class="row d-flex align-items-center">
        <div class="col-lg-7 mt-5 border-start border-3 rounded border-secondary">
            <div class="card rounded-15 border-0 bg-transparent">
                <div class="card-body">
                    <h5 class="fw-light text-dark fw-bolder" style="font-family: 'Baloo Tammudu 2', cursive;font-size:46px;">Learn Topics That
                        Matters To You</h5>
                    {{-- <hr> --}}
                    <p style="font-family: 'Roboto', sans-serif; font-size:22px;">CWS is an on-demand marketplace for top Web programming engineers, developers, consultants, architects, programmers, and tutors.</p>
                    <p style="font-family: 'Roboto', sans-serif; font-size:18px;"><span class="fw-bold text-success">We Believe: </span>Knowledge is not skill. Knowledge plus ten thousand times is skill.</p>
                    <a href="#our_course" class="btn-info btn d--flex-inline mx-auto rounded-25 px-3 py-2 cws-shadow-md">Explore Now!</a>
                </div>
            </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
            <img src="{{ asset('assets/images/boy.png') }}" class="img-fluid vert-move" alt="">
        </div>
    </div>
</div>
@endsection
@section('content')
    <div class="container-fluid p-0" style="margin-top:-100px;">
        @include('include.slider')

        <div class="container-fluid py-5" style="background-image: url({{ asset('assets/images/d.svg') }}); background-attachment:fixed; background-size:cover; background-position:center;">
            <div class="container d-flex justify-content-center align-items-center">
                <div>
                    <p class="text-center text-white">STARTING ONLINE LEARNING</p>
                    <h4 class="text-center h2 text-white">ENHANCE YOUR SKILLS WITH BEST ONLINE COURSES</h4>
                    <button class="btn btn-outline-light d-flex mx-auto rounded-25 py-2 mt-3 px-3">Comming Soon!</button>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-light" id="our_course">
            <div class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>Our Courses</h2>
                                <div class="section-borders">
                                    <span class="bg-success"></span>
                                    <span class="black-border"></span>
                                    <span class="bg-success"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                        @php
                            $courses = courses();
                        @endphp
                        @foreach ($courses as $course)
                        @php
                           $course_id = \Crypt::encrypt($course->id)
                        @endphp
                        <div class="col mb-4">
                            <a href="{{ route('home.course.view',['slug'=>$course->slug, 'id'=>$course_id]) }}" class="" title="{{ $course->title }}">
                                <div class="card border-0 rounded-15 cws-shadow-md">
                                    <div class="card-img-top rounded-15">
                                        <img src="{{ asset('assets/images/course/'.$course->image) }}" class="img-fluid rounded-15 w-100" style="height: 233px;  object-fit:cover;" alt="$course->image">
                                    </div>
                                    <div class="card-body">
                                        <p class="h5 text-truncate">{{ $course->title }}</p>
                                        <p class="text-success">₹ {{ $course->discount_price }} /-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
