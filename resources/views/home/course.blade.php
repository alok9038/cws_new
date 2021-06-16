@extends('layouts.base')
@section('page_title','CodeWithSadiQ')
@section('content')
    <div class="container py-5">
        <div class="card border-0  rounded-15">
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
                        <p>{{ $course->description }}</p>
                        <button class="btn btn-theme-info">Enroll Now!</button>
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
                        <a href="{{ route('home.course.view',['slug'=>$rc->slug, 'id'=>$rc->id]) }}" class="" title="{{ $rc->title }}">
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