@extends('layouts.newBase')
@section('page_title','Students Payments | Admin')
@section('earning_select','mm-active')
@section('content')
@section('css')
    <link href="{{ asset('admin_assets/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
<div class="container mt-4 px-4">
        <span class="d-flex my-3"><h4>Payments</h4></span>
        <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
            {{--new table --}}
                <div class="table-responsive">
                    <table id="example2" class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Sr no.</th>
                                <th>Student Name</th>
                                {{-- <th>Course</th> --}}
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $paid_amount = 0;
                                $sr = 0;
                            @endphp
                            @foreach ($enrolls as $enroll)
                                @php
                                    $payment = paid_amount($enroll->id);
                                    foreach ($payment as $paid) {
                                        $paid_amount += $paid->fee;
                                    }
                                    $sr += 1;
                                    $time = strtotime($enroll->created_at);
                                    $date = date("d M Y",$time );
                                @endphp
                                <tr>
                                    <td>{{ $sr }}</td>
                                    <td>{{ $enroll->student->name }}</td>
                                    {{-- <td>{{ $enroll->course->title }}</td> --}}
                                    <td class="text-success fw-bold">₹ {{ $enroll->fee }}</td>
                                    <td>{{ $date }}</td>
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

