@extends('layouts.base')
@section('page_title','CodeWithSadiQ')
@section('content')
@if ($course->banner_image !== null)
<div class="container-fluid border px-0" style="margin-top:-30px;background: url({{ asset('assets/images/course/banner/'.$course->banner_image) }});background-size:cover;background-position:center; height:300px;">
    <div class="container-fluid " style="height: 300px; background:rgba(0, 0, 0, 0.473);"></div>
</div>
@endif
    <div class="container py-5" style="{{ ($course->banner_image !== null)?"margin-top: -150px;":"" }}">
        <div class="card border-0 cws-shadow rounded-15">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card-img-top">
                            <img src="{{ asset('assets/images/course/'.$course->image) }}" style="object-fit: cover; height:293px;" alt="{{ $course->image }}" class="img-fluid rounded-15">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h5 class="h3 fw-bold">{{ $course->title }}</h5>
                        <p class="text-success mt-4" style="font-size: 20px;">₹ {{ $course->discount_price }} /- month</p>
                        <span class="mb-3"><strong>Duration : {{ $course->duration }} months</strong></span>
                        <p class="mt-4">{{ $course->description }}</p>

                        @if (check_enroll($course->id)->count() != 1)
                        <form action="{{ route('enroll') }}" method="post">
                            @csrf
                            <input type="text" hidden value="{{ $course->id }}" name="course_id">
                            <button class="btn btn-theme-info">Enroll Now!</button>
                        </form>
                        @else
                            <alert class="alert-info alert p-2 border-0 text-success">Course already enrolled!</alert>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>Related Courses</h2>
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
                        $related_courses = related_course($course->id);
                    @endphp
                    @foreach ($related_courses as $rc)
                    <div class="col mb-4">
                        <a href="{{ route('home.course.view',['slug'=>$rc->slug]) }}" class="" title="{{ $rc->title }}">
                            <div class="card border-0 rounded-15 cws-shadow-md">
                                <div class="card-img-top rounded-15">
                                    <img src="{{ asset('assets/images/course/'.$rc->image) }}" class="img-fluid rounded-15" style="height: 233px;  object-fit:cover;" alt="$course->image">
                                </div>
                                <div class="card-body">
                                    <p class="h5 text-truncate">{{ $rc->title }}</p>
                                    <p class="text-success">₹ {{ $rc->discount_price }} /-</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
