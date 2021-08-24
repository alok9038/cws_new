@extends('layouts.user_base')
@section('page_title',"User | CodeWithSadiQ")
@section('dashboard_select','active')
@section('content')

    <div class="container px-lg-5">
        @if ($back_dues)
            <div href="" class="alert bg-light-danger text-light-danger d-flex  align-items-center">You Have ₹ {{ $back_dues->amount }} /- Dues From Previous Month
                <form action="{{ route('workshop.paytm.payment') }}" class="justify-content-end d-flex ms-auto" method="post">
                    @csrf
                    <input type="text" name="back_due_id" value="{{ $back_dues->id }}" hidden>
                    <input type="text" name="amount" value="{{ $back_dues->amount }}" hidden>
                    <button type="submit" class="btn btn-danger">Pay now</button>
                </form>
            </div>
        @endif
        <h4>Dashboard</h4>
        @php
            $discount_price = 0;
            $paid_amount = 0;

            foreach($total_amounts as $enroll){
                $discount_price += $enroll->course->discount_price;
            }

            foreach ($payments as $paid) {
                $paid_amount += $paid->fee;
            }
        @endphp

        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 rounded-0 cws-shadow bg-white">
                    <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                        My Courses  @if ($paid_amount != $discount_price) ( <span class="text-danger">₹  @if($back_dues) {{ $discount_price  - $paid_amount + $back_dues->amount }} @else {{ $discount_price  - $paid_amount   }} @endif dues</span>) @endif
                    </div>
                    <div class="card-body border-top">
                        @php
                            $t = 0;
                            $dt = 0;
                        @endphp
                        @if (count($enrolls) > 0)
                        @foreach ($enrolls as $item)
                            @if (count($item->InCart) > 1)
                                <div class="my-3 rounded-10">
                                    @foreach ($item->InCart as $enroll)
                                    <div class="d-flex p-2 col-lg-12 bg-light">
                                        <span><img src="{{ asset('assets/images/course/'.$enroll->course->image) }}" alt="{{ $enroll->course->image }}" style="width: 150px;" class="img-fluid rounded-10"></span>
                                        <div class="ps-3">
                                            <span class="mt-1">{{ $enroll->course->title }} <br>
                                            </span>
                                            <p class="small text-success">₹ {{ $enroll->course->discount_price }}</p>
                                        </div>
                                        @php
                                            $dt += $enroll->course->discount_price;
                                        @endphp
                                    </div>
                                    @endforeach

                                    <div class="col-12 bg-light p-2">
                                        @php
                                            $dt;
                                            $tt = 0;
                                            foreach (pp($enroll->order_id) as $try) {
                                                $tt += $try->fee;
                                            }
                                        @endphp
                                        <p class="small text-center mb-3 {{ ($dt - $tt == 0)?"text-success fw-bold":"text-danger fw-bold" }}">{{ ($dt - $tt == 0)?"Full Paid":"₹ $dt - $tt dues" }}
                                    </div>
                                    <div class="card-footer {{ ($dt - $tt == 0)?"d-none":"" }}">
                                        <button class="btn btn-info btn-sm  mx-auto pay_btn d-flex" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{ $item->id }}">Pay Dues</button>
                                        <div class="modal fade" id="staticBackdrop_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
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
                                                            <input type="text" name="custom_payment" id="custom_pay" placeholder=" enter amount" class="form-control custom_pay d-none rounded-0 shadow-none" style="height: 33px;">
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input payment_type" type="radio" value="full_{{ $dt - $tt}}" name="payment_type" id="flexRadioDefault2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                            Pay Rest amount ( ₹ {{ $dt - $tt}} )
                                                            </label>
                                                        </div>
                                                        <div class="mb-3 d-flex justify-content-center">
                                                            <input type="submit" id="submit_btn" class="btn btn-info mt-4 btn-sm " value="Pay ">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else

                                @foreach ($item->InCart as $enroll)
                                <div class="d-flex p-2 bg-light rounded-10 mb-3">
                                    <span><img src="{{ asset('assets/images/course/'.$enroll->course->image) }}" alt="{{ $enroll->course->image }}" style="width: 150px;" class="img-fluid rounded-10"></span>

                                    @php
                                        $tt = 0;
                                        foreach (pp($enroll->order_id) as $try) {
                                            $tt += $try->fee;
                                        }
                                    @endphp
                                    <div class="ps-4">
                                        <span class="mt-1">{{ $enroll->course->title }} <br>
                                        </span>
                                        <p class="m text-success">₹ {{ $enroll->course->discount_price }}</p><br>
                                        <p class="small {{ ($enroll->course->discount_price - $tt == 0)?"text-success fw-bold":"text-danger fw-bold" }}" style="margin-top: -30px;">₹ {{ ($enroll->course->discount_price - $tt == 0)?"Full Paid":"".($enroll->course->discount_price - $tt)." dues"}}
                                    </div>
                                </div>
                                @endforeach
                                <div class="card-footer {{ ($enroll->course->discount_price - $tt == 0)?"d-none":"" }}">
                                    <button class="btn btn-info btn-sm  mx-auto pay_btn d-flex" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{ $item->id }}">Pay Dues</button>
                                    <div class="modal fade" id="staticBackdrop_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
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
                                                        <input type="text" name="custom_payment" id="custom_pay" placeholder=" enter amount" class="form-control custom_pay d-none rounded-0 shadow-none" style="height: 33px;">
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input payment_type" type="radio" value="full_{{ $enroll->course->discount_price - $tt}}" name="payment_type" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                        Pay Rest amount ( ₹ {{ $enroll->course->discount_price - $tt}} )
                                                        </label>
                                                    </div>
                                                    <div class="mb-3 d-flex justify-content-center">
                                                        <input type="submit" id="submit_btn" class="btn btn-info mt-4 btn-sm " value="Pay ">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
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
                            // $payments = payments();
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
                        @if ($payment->enrolled_course->InCart->count() > 1)
                        <div class="col-6">
                        @foreach ($payment->enrolled_course->InCart as $item)
                            <div class="me-4 text-capitalize mb-3"> {{ $item->course->title }}</div>
                        @endforeach
                        </div>
                            <span class="me-4">{{ $date }} <br>  </span>
                        @else
                            @foreach ($payment->enrolled_course->InCart as $item)
                                <span class=""> {{ $item->course->title }}</span>
                                <span class="ms-4">{{ $date }} <br>  </span>
                            @endforeach
                        @endif
                            <p class="small text-success">₹ {{ $payment->fee }} paid</p>
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

    {{-- <script>
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
    </script> --}}

<script type="text/javascript">

    $(".payment_type").change(function(){
        var x = $(this).val();
        var x = $(this).val();
        var splitid = x.split("_");
        var type = splitid[0];
        var amount = splitid[1];

        if(type == 'custom'){
            $(".custom_pay").removeClass('d-none');
            $('.custom_pay').val('');
        }else if(type == 'full'){
            $('.custom_pay').val(amount);
            $(".custom_pay").addClass('d-none');
        }
    });

</script>
@endsection
