@extends('layouts.newBase')
@section('page_title','Create Course | Admin')
@section('create_course_select','mm-active')
@section('content')
    <div class="container mt-4 px-4">
        <h4>Create New Course</h4>
        <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
                <form action="{{ route('update.course') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="title" class="fw-bold">Title</label>
                            <input type="text" value="{{ $course->title }}" name="title" class="form-control shadow-none">
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-4">
                            <label for="image" class="fw-bold">Duration</label>
                            <input type="number" name="duration" value="{{ $course->duration }}" class="form-control shadow-none">
                            @error('duration')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="price" class="fw-bold">Price</label>
                            <input type="number" name="price" value="{{ $course->price }}" class="form-control shadow-none">
                            @error('price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label for="discount_price" class="fw-bold">Discount Price</label>
                            <input type="number" name="discount_price" value="{{ $course->discount_price }}" class="form-control shadow-none">
                            @error('discount_price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label for="course_type" class="fw-bold">Course Type</label>
                            <select name="course_type" id="course_type" class="form-control">
                                <option value="" selected hidden disabled>select</option>
                                @if ($course->course_type == 0)
                                    <option value="0" selected>Programming</option>
                                    <option value="1">Theory</option>
                                @elseif ($course->course_type == 1)
                                    <option value="0">Programming</option>
                                    <option value="1" selected>Theory</option>
                                @endif
                            </select>
                            @error('course_type')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="image" class="fw-bold">Cover Image</label>
                            <input type="file" name="image"  class="form-control shadow-none">
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-5">
                            <label for="image" class="fw-bold">Banner Image <span class="fw-light">(optional)</span></label>
                            <input type="file" name="banner_image"  class="form-control shadow-none">
                            @error('banner_image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" name="featured" type="checkbox" {{ ($course->featured == 'yes')?"checked":'' }} value="1" id="flexCheckDefault">
                        <label class="form-check-label h6" for="flexCheckDefault" class="fw-bold">
                          Featured Course
                        </label>
                      </div>
                    <div class="mb-3">
                        <label for="description" class="fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control shadow-none" cols="30" rows="5">{{ $course->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-dark float-end">Submit</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
