@extends('layouts.newBase')
@section('page_title','Workshop Enrolled Students | Admin')
@section('workshop_enrolled_select','mm-active')
@section('content')
@section('css')
    <link href="{{ asset('admin_assets/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
<div class="container mt-4 px-4">
        <span class="d-flex my-3"><h4>Students</h4></span>
        <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
            {{--new table --}}
                <div class="table-responsive">
                    <table id="example2" class="table table-hover table-borderless">
                        <thead>
                            <tr class="border-bottom">
                                <th>Sr no</th>
                                <th>Student Name</th>
                                <th>Workshop Title</th>
                                <th>Workshop Date</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Payment Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sr = 0;
                            @endphp
                            @foreach($enrolls as $enroll)
                                <tr>
                                @php
                                    $sr +=1;
                                @endphp
                                    <td>{{ $sr }}</td>
                                    <td>{{ $enroll->student->name }}</td>
                                    <td>{{ $enroll->workshop->title }}</td>
                                    <td>{{ $enroll->workshop->event_date }}</td>
                                    <td>{{ $enroll->workshop->fee }}</td>
                                    <td><span class="badge bg-light-success text-success">Paid</span></td>
                                    <td>{{ $enroll->payment->created_at }}</td>
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
