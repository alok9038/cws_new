@extends('layouts.newBase')
@section('page_title','Students | Admin')
@section('user_select','mm-active')
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
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Father's Name</th>
                                <th>email</th>
                                <th>Gender</th>
                                <th>Dues Fees</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sr = 0;
                            @endphp
                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    @php
                                        $sr +=1;
                                    @endphp
                                    <tr>
                                        <td>{{ $sr }}</td>
                                        <td><img src="{{ asset('assets/images/students/'.$user->image) }}" style="height: 50px; width:50px" alt="" class="img-fluid rounded-circle cws-shadow"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->father_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->gender == 0)
                                                Male
                                            @elseif ($user->gender == 1)
                                                Female
                                            @else
                                                Other
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $total_course_fee = 0;
                                                foreach(course_amount($user->id) as $am){
                                                    $total_course_fee += $am->course->discount_price;
                                                }
                                                $dues_amount = 0;

                                                foreach (dues_amount($user->id) as $item) {
                                                    foreach ($item->paytm_payments as $p) {
                                                        $dues_amount += $p->fee;
                                                    }
                                                }

                                                $dues =  $total_course_fee - $dues_amount;
                                            @endphp
                                            @if ($dues !== 0)
                                                <span class="p-2 rounded-3 bg-light-danger text-danger">₹ {{ $dues }}</span>
                                            @else
                                                <span class="p-2 rounded-3 bg-light-success text-success">No Dues</span>
                                            @endif

                                        </td>
                                        <td>
                                            <button class="btn"><i class="bx bx-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5">No Record found!</td></tr>
                            @endif
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
