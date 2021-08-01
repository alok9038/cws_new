@extends('layouts.admin_base')
@section('page_title','Admin :: Users | CodeWithSadiQ')
@section('user_select','active')
@section('content')
    <div class="container">
        <div class="d-flex mb-3">
            <h5>Users</h5>
        </div>
        <div class="card border-0 cws-shadow rounded-10">
            <div class="filter-section p-2 cws-shadow d-flex rounded-10 mx-3 mt-3 bg-light">
                <span class="mt-2"><strong>Filter</strong></span>
                <div class="d-flex ms-auto">
                    <i class="fa fa-filter mt-2 me-2"></i>
                    <div class="d-flex">
                        <form action="{{ route('view.user.filter') }}" method="get">
                            <select name="gender" onchange="this.form.submit()" class="form-control">
                                <option value="" selected hidden disabled>Sort by Gender</option>
                                <option value="all">All</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                                <option value="2">Other</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr class="border-bottom">
                        <th>Sr no</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Father's Name</th>
                        <th>email</th>
                        <th>Gender</th>
                    </tr>
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
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5">No Record found!</td></tr>
                    @endif
                </table>
            </div>
            <div class="card-footer d-flex border-0 bg-transparent">
                <div class="ms-auto">{!! $users->links() !!}</div>
            </div>
        </div>
    </div>

@endsection
