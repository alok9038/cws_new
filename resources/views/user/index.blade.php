@extends('layouts.user_base')
@section('page_title',"User | CodeWithSadiQ")
@section('dashboard_select','active')
@section('content')
    <div class="container px-lg-5">
        <h4>Dashboard</h4>
        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 rounded-0 cws-shadow bg-white">
                    <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                        My Courses
                    </div>
                    <div class="card-body border-top">
                        @php
                            $paid_amount = 0;
                        @endphp
                        @if (count($enrolls) > 0)
                        @foreach ($enrolls as $enroll)
                        <div class="d-flex p-2 bg-light rounded-10">
                            <span><img src="{{ asset('assets/images/course/'.$enroll->course->image) }}" alt="{{ $enroll->course->image }}" style="width: 150px;" class="img-fluid rounded-10"></span>
                            <span class="mt-1 ms-3">{{ $enroll->course->title }} <br>
                                @php
                                   $payment = paid_amount($enroll->id);
                                   foreach ($payment as $paid) {
                                       $paid_amount += $paid->fee;
                                   }
                                @endphp
                                @if ($enroll->payment == 'full')
                                    <p class="small text-success">₹ {{ $enroll->course->discount_price }}
                                    <p class="small text-success fw-bold " style="margin-top: -20px;">Fully paid <br>
                                @else
                                    <p class="small text-success">₹ {{ $paid_amount }} paid <br>
                                    <span class="small text-danger">₹
                                    {{ $enroll->course->discount_price  - $paid_amount }} dues</span></p>
                                @endif

                            </span>
                        </div>
                        @if ($paid_amount != $enroll->course->discount_price)
                            <div class="p-2">
                                <div id="payment" class="" style="display: none">
                                    <form action="{{ route('pay.dues') }}" class="mb-3" method="post">
                                        @csrf
                                        <div class="form-check mb-2">
                                            <input class="form-check-input payment_type" type="radio" value="custom" name="payment_type" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                            Custom Amount
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="enroll_id" value="{{ $enroll->id }}" hidden>
                                            <input type="text" name="custom_payment" id="custom_pay" placeholder=" enter amount" class="form-control d-none rounded-0 shadow-none" style="height: 33px;">
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input payment_type" type="radio" value="full_{{ $enroll->course->discount_price  - $paid_amount }}" name="payment_type" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                            Pay Rest amount ( ₹ {{ $enroll->course->discount_price  - $paid_amount }} )
                                            </label>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-center">
                                            <input type="submit" id="submit_btn" class="btn btn-info mt-4 btn-sm " value="Pay ">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center border-0 bg-transparent">
                                <button class="btn btn-info btn-sm  mx-auto" id="pay_btn">Pay Dues</button>
                                <button class="btn btn-danger btn-sm float-end mx-auto d-none"  id="cancel_btn">Cancel</button>
                            </div>
                        @endif
                    @endforeach
                        @else
                        <div class="p-2 bg-light mb-2">
                            <a href="{{ route('homepage') }}" class="btn btn-info btn-sm mb-2 text-dark mt-2">Explore Course!</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-0 rounded-0 cws-shadow bg-white">
                    <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                        Payments History
                    </div>
                    <div class="card-body border-top">
                        @php
                            $payments = payments();
                            $p_amount = 0;
                        @endphp
                        @if (count($payments) > 0)
                        @foreach ($payments as $payment)
                        <div class="d-flex p-2 bg-light mb-2">
                            @php
                                $time = strtotime($payment->created_at);
                                $date = date("d M Y",$time );

                                $p = paid_amount($payment->enroll_id);
                                foreach ($p as $paid) {
                                   $p_amount += $paid->fee;
                                }

                            @endphp
                            <span class="">{{ $payment->enrolled_course->course->title }} <br> <p class="small text-success">₹ {{ $payment->fee }} paid</p></span>
                            <span class="ms-4">{{ $date }} <br>  </span>
                            {{-- <p class="small text-success">{{ $payment->fee }} paid</p> --}}
                        </div>
                        @endforeach
                        @else
                        <div class="p-2 bg-light mb-2">
                            <p class="small text-dark mt-2">No Records!</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4 mb-4">
                <div class="card border-0 rounded-0 cws-shadow bg-white">
                    <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                        Group ( Php & MySqli )
                    </div>
                    <div class="card-body border-top">
                        <div class="d-flex p-2 bg-light mb-2">
                            <span>Today <br>  <p class="small text-success">7:30 am</p></span>
                            <span class=" ms-3">Mysqli Database <br> <p class="small text-danger">pdf</p></span>
                        </div>
                        <div class="d-flex p-2 bg-light mb-2">
                            <span>10.12.2021 <br>  <p class="small text-success">10:30 am</p></span>
                            <span class=" ms-3">Php Laravel Routes <br> <p class="small text-danger">pdf</p></span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
          $("#pay_btn").click(function(){
            $("#pay_btn").addClass('d-none');
            $("#cancel_btn").removeClass('d-none');
            $("#payment").show();

            $("#cancel_btn").show();
          });
          $("#cancel_btn").click(function(){
            $("#payment").hide();
            $("#pay_btn").removeClass('d-none');
            $("#cancel_btn").addClass('d-none');
          });
        });
    </script>

<script type="text/javascript">

    $(".payment_type").change(function(){
        var x = $(this).val();
        var x = $(this).val();
        var splitid = x.split("_");
        var type = splitid[0];
        var amount = splitid[1];

        if(type == 'custom'){
            $("#custom_pay").removeClass('d-none');
            $('#custom_pay').val('');
        }else if(type == 'full'){
            $('#custom_pay').val(amount);
            $("#custom_pay").addClass('d-none');
        }
        // $("#submit_btn").prop("value", 'Pay '+'( ₹ '+ 'djkhdjhj' + ' )');
    });

</script>
@endsection
