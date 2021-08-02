@extends('layouts.user_base')
@section('page_title','Payments | codeWithSadiQ')
@section('payment_select','active')
@section('content')
<link href="{{ asset('admin_assets/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

<div class="container px-4 mt-4">
    <div class="card cws-shadow border-0 border-start border-3 border-danger rounded-0">
        <div class="card-header bg-white border-0 rounded-0">
            Payment History
        </div>
        <div class="card-body border-top">
            <table id="example2" class="table table-md table-borderless">
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>#order id</th>
                        <th>txn no</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $sr = 0;
                @endphp
                @foreach ($payments as $payment)
                @php
                    $sr += 1;
                    $time = strtotime($payment->created_at);
                    $date = date("d M Y",$time );
                @endphp
                    <tr>
                        <td>{{ $sr }}</td>
                        <td>{{ $payment->order_id }}</td>
                        <td>{{ $payment->transaction_id }}</td>
                        {{-- <td>{{ $payment->enrolled_course->course->title }}</td> --}}
                        <td>₹ {{ $payment->fee }}</td>
                        <td>{{ $date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex border-0 bg-transparent">
            <div class="ms-auto">{!! $payments->links() !!}</div>
        </div>
    </div>
</div>

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
