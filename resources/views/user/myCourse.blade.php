@extends('layouts.user_base')
@section('page_title','user | codeWithSadiQ')
@section('course_select','active')
@section('content')
<div class="container px-lg-5">
    <h4>My Course</h4>
    <div class="card mt-4 border-0 rounded-0 cws-shadow bg-white">
        {{-- <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                Php & Mysqli
            </div> --}}
        <div class="card-body">
            @foreach ($enrolls as $item)
                            @php
                                $paid_amount = 0;
                            @endphp
                            @if (count($item->InCart) > 0)
                            @foreach ($item->InCart as $enroll)
                            <div class="d-flex p-2 bg-light rounded-10">
                                <span><img src="{{ asset('assets/images/course/'.$enroll->course->image) }}" alt="{{ $enroll->course->image }}" style="width: 150px;" class="img-fluid rounded-10"></span>
                                <div>
                                    <span class="mt-1 ms-3 h5">{{ $enroll->course->title }} <br>
                                    </span>
                                    <p class="small text-success fw-bold ms-3">Course Fee : ₹ {{ $enroll->course->discount_price }}
                                    @php

                                        $discount_price = 0;
                                        $paid_amount = 0;

                                    // foreach ($enrolls as $item) {
                                        foreach($item->inCart as $enroll){
                                            $discount_price += $enroll->course->discount_price;
                                        }

                                        foreach ($item->paytm_payments as $paid) {
                                            $paid_amount += $paid->fee;
                                        }
                                        // }


                                    @endphp

                                    @if ($paid_amount == $discount_price)
                                    <p class="small ms-3 text-success mt-n5" style="margin-top: -10px;">full paid</p]>
                                    @endif
                                </div>
                                </div>
                            @endforeach
                            @else
                            <div class="p-2 bg-light mb-2">
                                <a href="{{ route('homepage') }}" class="btn btn-info btn-sm mb-2 text-dark mt-2">Explore Course!</a>
                            </div>
                            @endif

                            {{-- pay --}}

                        @if ($paid_amount != $discount_price)
                        <h5 class="my-3">Total Dues Fee : ₹ {{ $discount_price  - $paid_amount }}</h5>
                        <div class="card-footer">
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
                                                <input type="text" name="enroll_id" value="{{ $item->id }}" hidden>
                                                <input type="text" name="custom_payment" id="custom_pay" placeholder=" enter amount" class="form-control d-none rounded-0 shadow-none" style="height: 33px;">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input payment_type" type="radio" value="full_{{ $discount_price  - $paid_amount }}" name="payment_type" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                Pay Rest amount ( ₹ {{ $discount_price  - $paid_amount }} )
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
                            </div>
                        @else
                        <div class="card-footer">
                            {{-- <p class="text-white badge bg-success">Fully Paid!</p> --}}
                        </div>
                        @endif
                        @endforeach
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $("#pay_btn").click(function () {
            $("#pay_btn").addClass('d-none');
            $("#cancel_btn").removeClass('d-none');
            $("#payment").show();

            $("#cancel_btn").show();
        });
        $("#cancel_btn").click(function () {
            $("#payment").hide();
            $("#pay_btn").removeClass('d-none');
            $("#cancel_btn").addClass('d-none');
        });
    });

</script>

<script type="text/javascript">
    $(".payment_type").change(function () {
        var x = $(this).val();
        var x = $(this).val();
        var splitid = x.split("_");
        var type = splitid[0];
        var amount = splitid[1];

        if (type == 'custom') {
            $("#custom_pay").removeClass('d-none');
            $('#custom_pay').val('');
        } else if (type == 'full') {
            $('#custom_pay').val(amount);
            $("#custom_pay").addClass('d-none');
        }
        // $("#submit_btn").prop("value", 'Pay '+'( ₹ '+ 'djkhdjhj' + ' )');
    });

</script>
@endsection
