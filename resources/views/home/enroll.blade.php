@extends('layouts.base')
@section('page_title','Enroll Course | CodeWithSadiQ')
@section('content')
    <div class="container py-5">
        @if (count($enrolls->InCart) !== 0)
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 cws-shadow rounded-10">
                    <div class="card-body">
                        <h6>Course Title Here!</h6>
                        <hr>
                        @foreach ($enrolls->InCart as $enroll)
                        <div class="row mb-3">
                            <div class="col-4"><img src="{{ asset('assets/images/course/'.$enroll->course->image) }}" class="img-fluid rounded-10" style="height: 133px; width:190px;" alt=""></div>
                            <div class="col-6">
                                <p class="h5 mt-3">{{ $enroll->course->title }}</p>
                                <p>₹ {{ $enroll->course->discount_price }} <span class="ms-3 small"><del> ₹ {{ $enroll->course->price }}</del></span></p>
                            </div>
                            <div class="col-2">
                                <form action="{{ route('drop.enroll') }}" method="post">
                                    @csrf
                                    <input type="text" name="enroll_id" value="{{ $enroll->id }}" hidden>
                                    <p class="h5 mt-3">
                                        <button href="" class="fa fa-trash border-0 bg-transparent text-danger"></button>
                                    </p>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <a href="#" class="btn btn-info mt-4 rounded-10 cws-shadow">Keep Hunting!</a>
            </div>
            @php
                $total_price = 0;
                foreach($enrolls->inCart as $enroll){
                    $total_price += $enroll->course->price;
                }
                $total_price;

                $discount_price = 0;
                foreach($enrolls->inCart as $enroll){
                    $discount_price += $enroll->course->discount_price;
                }

                $discount_price;
            @endphp
            <div class="col-lg-4">
                <div class="card mb-4 border-0 cws-shadow rounded-10">
                    <div class="card-body">
                        <h6>Checkout</h6>
                        <hr>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>Course Fee</th>
                                <td>₹ {{ $total_price }}</td>
                            </tr>
                            <tr>
                                <th>Dicount Amount</th>
                                <td>₹ {{ $discount_price }}</td>
                            </tr>
                            <tr>
                                <th class="text-success">Total Saving</th>
                                <td class="text-success">₹ {{ $total_price - $discount_price }}</td>
                            </tr>
                            <tr class="border-top border-secondary">
                                <th>Total</th>
                                <td>₹ {{ $discount_price }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @php
                    $course_type = null;
                    foreach($enrolls->InCart as $enroll){
                        $course_type[] = $enroll->course->course_type;
                    }
                    $course_type;
                    $monthly = null;
                    if(in_array(0, $course_type) && in_array(1, $course_type)){
                        $monthly = true;
                    }

                @endphp
                <div class="card border-0 cws-shadow rounded-10">
                    <div class="card-body">
                        <h6>Payment Type</h6>
                        <hr>
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <div class="form-check mb-3">
                                <input class="form-check-input payment_type" type="radio" value="full_{{ $enrolls->id }}_{{ $discount_price*1884 }}" name="payment_type" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                  Full Payment ( ₹ {{ $discount_price }} )
                                </label>
                            </div>
                            @if ($monthly == true)
                            <div class="form-check mb-3">
                                <input class="form-check-input payment_type" type="radio" value="full_{{ $enrolls->id }}_{{ 1000*1884 }}" name="payment_type" id="monthly">
                                <label class="form-check-label" for="monthly">
                                  Monthly Payment ( ₹ 1000 )
                                </label>
                                <p class="small text-muted">pay ₹ 1000 /- for {{ round($discount_price / 1000) }} month!</p>
                            </div>
                            @endif
                            <div class="form-check">
                                @php
                                    $installment = $discount_price * (40 / 100)
                                @endphp
                                <input class="form-check-input payment_type" type="radio" value="installment_{{ $enrolls->id }}_{{ round($installment)*1884 }}" name="payment_type" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                  Installment
                                </label>
                                <p class="small text-muted">pay 40% of course ammount!</p>
                            </div>
                            <div class="mb-3">
                                <input type="submit" id="submit_btn" class="btn btn-secondary mt-4 float-end" value="Pay ( ₹ {{ $discount_price }} )">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
            <h4>Nothing to show</h4>
        @endif
    </div>
    <script type="text/javascript">

        $(".payment_type").change(function(){
            var x = $(this).val();
            var splitid = x.split("_");

            var type = splitid[0];
            var status = splitid[1];
            var price = splitid[2] / 1884;

            // var selValue = $("input[type='radio']:checked").val();
            $("#submit_btn").prop("value", 'Pay '+'( ₹ '+ price + ' )');
        });

    </script>
@endsection
