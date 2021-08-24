@extends('layouts.newBase')
@section('page_title','Create Course | Admin')
@section('course_select','mm-active')

@section('content')
@section('css')
    <link href="{{ asset('admin_assets/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
<div class="container mt-4 px-4">
        <span class="d-flex my-3"><h4>Create New Course</h4> <a href="{{ route('add.course.view') }}" class="btn btn-info ms-auto"> Add New Course</i></a></span>
        <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
                {{--new table --}}
                <div class="table-responsive">
                    <table id="example2" class="table table-borderless table-hover">
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
                                    <td>₹ {{ $course->price }}</td>
                                    <td>₹ {{ $course->discount_price }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('edit.course.view',['id'=>$course->id]) }}" class="btn rounded-0 btn-sm shadow-none btn-light-secondary"><i class="bx bx-edit"></i></a>

                                            <form action="{{ route('drop.course') }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="text" value="{{ $course->id }}" hidden name="course_id">
                                                <button class="btn rounded-0 btn-sm shadow-none btn-light-danger"><i class="bx bx-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin_assets/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel', 'pdf', 'print']
            } );

            table.buttons().container()
                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
        } );
    </script>
@endsection
