@extends('layouts.newBase')
@section('workshop_select','mm-active')
@section('content')
    <div class="container">
        <div class="card border-0 rounded-10 cws-shadow">
            <div class="card-header border-0 pt-3 bg-transparent d-flex">
                <h4 class="card-title">Workshop</h4>
            </div>
            <div class="card-body">
                <div class="div">
                    <form action="{{ route('admin.workshop.create.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="fw-bold">Title: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" value="{{ old('title') }}" id="title" name="title">
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <div class="col">
                                <label for="event_date" class="fw-bold">Event date: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control shadow-none" value="{{ old('event_date') }}" id="event_date" name="event_date">
                                @error('event_date')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="event_time" class="fw-bold">Time: <span class="text-danger">*</span></label>
                                <input type="time" class="form-control shadow-none" value="{{ old('event_time') }}" id="event_time" name="event_time">
                                @error('event_time')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="event_last_date" class="fw-bold">Registration Last date: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control shadow-none" value="{{ old('last_date') }}" id="event_last_date" name="last_date">
                                @error('event_last_date')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fee" class="fw-bold">Event Fee: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" value="{{ old('fee') }}" id="fee" name="fee">
                            @error('fee')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="fw-bold">Description : </label>
                            <textarea type="text" class="form-control shadow-none" rows="5" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="fw-bold">Image : </label>
                            <input type="file" class="form-control shadow-none" rows="5" id="image" name="image">
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark sm float-end">Save setting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
