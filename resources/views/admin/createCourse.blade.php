@extends('layouts.admin_base')
@section('page_title','Create Course | Admin')
@section('create_course_select','active')
@section('content')
    <div class="container mt-4 px-4">
        <h4>Create New Course</h4>
        <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
                <form action="{{ route('add.course') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control shadow-none">
                        @error('title')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="price">Price</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="form-control shadow-none">
                            @error('price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col">
                            <label for="discount_price">Discount Price</label>
                            <input type="number" name="discount_price" value="{{ old('discount_price') }}" class="form-control shadow-none">
                            @error('discount_price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="image">Cover Image</label>
                            <input type="file" name="image"  class="form-control shadow-none">
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-4">
                            <label for="image">Duration</label>
                            <input type="number" name="duration"  class="form-control shadow-none">
                            @error('duration')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label h6" for="flexCheckDefault">
                          Featured Course
                        </label>
                      </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control shadow-none" cols="30" rows="5">{{ old('description') }}</textarea>
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
