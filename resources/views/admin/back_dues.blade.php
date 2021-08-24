@extends('layouts.newBase')
@section('page_title','Students Back dues | Admin')
@section('back_dues_select','mm-active')
@section('content')
@section('css')
    <link href="{{ asset('admin_assets/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
<div class="container mt-4 px-4">
        <span class="d-flex my-3"><h4>Back Dues</h4></span>
        <div class="card border-0 cws-shadow rounded-10 mb-4">
            <div class="card-body">
            {{--new table --}}
                <div class="table-responsive">
                    <table id="example2" class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sr = 0;
                            @endphp
                            @foreach ($dues as $due)
                                <tr>
                                    <td>{{ $due->student->name }}</td>
                                    <td class="text-success fw-bold">₹ {{ $due->amount }}</td>
                                    <td colspan="">
                                        @if ($due->status == 0)
                                            <span class="badge bg-light-danger text-danger">Due</span>
                                        @else
                                            <span class="badge bg-light-success text-success">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('admin.back.due.update') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="dues_id" value="{{ $due->id }}">
                                                @if($due->status == 0)
                                                    <button class="btn btn-sm btn-success">paid</button>
                                                @else
                                                    <button class="btn btn-sm btn-sm btn-danger">Unpaid</button>
                                                @endif
                                            </form>
                                            <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa bx bx-edit"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Update Amount</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="{{ route('admin.back.due.amount') }}" method="post">
                                              @csrf
                                              <input type="hidden" name="dues_id" value="{{ $due->id }}">
                                              <div class="mb-3">
                                                  <label for="amount">Amount</label>
                                                  <input type="text" id="amount" value="{{ $due->amount }}" name="amount" class="form-control shadow-none">
                                              </div>
                                              <div class="mb-3">
                                                  <input type="submit" value="change" class="btn btn-dark float-end">
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
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

