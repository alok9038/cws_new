@extends('layouts.admin_base')
@section('page_title','Create Course | Admin')
@section('course_select','active')
@section('content')
    <div class="container mt-4 px-4">
        <span class="d-flex my-3"><h4>Create New Course</h4> <a href="{{ route('add.course.view') }}" class="btn btn-info ms-auto"> Add New Course</i></a></span>
        <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
                <table class="table table-hover table-borderless">
                    <thead>
                        <tr class="table-light">
                            <th>Sr no.</th>
                            <th>image</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($courses) !== 0)
                        @php
                            $i = 0;
                        @endphp
                            @foreach ($courses as $course)
                            @php
                                $i ++;
                            @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><div class="rounded-10 cws-shadow" style="height: 50px; width:55px;"><img src="{{ asset('assets/images/course/'.$course->image) }}" style="height: 50px; width:55px;" class="img-fluid rounded-10" alt="{{ $course->image }}"></div></td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->price }}</td>
                                    <td>{{ $course->discount_price }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn rounded-0 btn-sm btn-secondary"><i class="fa fa-edit"></i></button>

                                            <form action="{{ route('drop.course') }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="text" value="{{ $course->id }}" hidden name="course_id">
                                                <button class="btn rounded-0 btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No course found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
