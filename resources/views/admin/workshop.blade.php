@extends('layouts.newBase')
@section('page_title','Workshop | Admin')
@section('workshop_select','mm-active')
@section('content')
@section('css')
    <link href="{{ asset('admin_assets/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
<div class="container mt-4 px-4">
    <span class="d-flex my-3"><h4>Workshop</h4> <a href="{{ route('admin.workshop.create.view') }}" class="btn btn-info ms-auto"> Add New</i></a></span>
    <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
            {{--new table --}}
                <div class="table-responsive">
                    <table id="example2" class="table table-hover table-borderless">
                        <thead>
                            <tr class="border-bottom">
                                <th>Sr no</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Last Registration Date</th>
                                <th>Fee</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sr = 0;
                            @endphp
                            @foreach ($workshops as $workshop)
                                <tr>
                                    <td>{{ $sr += 1 }}</td>
                                    <td>{{ $workshop->title }}</td>
                                    <td>{{ $workshop->event_date }}</td>
                                    <td>{{ $workshop->last_date }}</td>
                                    <td>{{ $workshop->fee }}</td>
                                    <td>{{ $workshop->time }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('admin.drop.workshop') }}" method="post">
                                                @csrf
                                                <input type="text" name="workshop_id" value="{{ $workshop->id }}" hidden>
                                                <button class="btn "><i class="bx bx-trash"></i></button>
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
