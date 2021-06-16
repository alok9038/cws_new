@extends('layouts.base')
@section('page_title','Enroll Course | CodeWithSadiQ')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 cws-shadow rounded-10">
                    <div class="card-body">
                        <h6>Course Title Here!</h6>
                        <hr>
                        <div class="row">
                            <div class="col-4"><img src="{{ asset('assets/images/course/1623662756-pillow.png') }}" class="img-fluid rounded-10" style="height: 133px; width:190px;" alt=""></div>
                            <div class="col-6">
                                <p class="h5 mt-3">Course ka naam yaha likhayega </p>
                                <p>$ 899</p>
                            </div>
                            <div class="col-2"><p class="h5 mt-3"><a href="" class="fa fa-trash text-danger"></a> </p></div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-info mt-4 rounded-10">Continue Hunting!</a>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 border-0 cws-shadow rounded-10">
                    <div class="card-body">
                        <h6>Checkout</h6>
                        <hr>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>Course Fee</th>
                                <td>₹ 1200</td>
                            </tr>
                            <tr>
                                <th>Dicount Amount</th>
                                <td>₹ 899</td>
                            </tr>
                            <tr>
                                <th class="text-success">Total Saving</th>
                                <td class="text-success">₹ 301</td>
                            </tr>
                            <tr class="border-top border-secondary">
                                <th>Total</th>
                                <td>₹ 899</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card border-0 cws-shadow rounded-10">
                    <div class="card-body">
                        <h6>Payment Type</h6>
                        <hr>
                        <div class="form-check">
                            <input class="form-check-input payment_type" type="radio" value="full" name="flexRadioDefault" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                              Full Payment ( ₹ 899 )
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input payment_type" type="radio" value="installment" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                              Installment
                            </label>
                        </div>
                        <div class="mb-3">
                            <input type="submit" id="submit_btn" class="btn btn-secondary mt-4 float-end" value="Pay ( ₹ 899 )">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(".payment_type").change(function(){
            var selValue = $("input[type='radio']:checked").val();
            $("#submit_btn").prop("value", selValue);
        });

    </script>
@endsection
