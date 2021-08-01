@extends('layouts.base')
@section('page_title','Forget Password | CodeWithSadiQ ')

@section('content')
<div class="container-fluid bg-light" style="margin-top: -20px;">
    <div class="container d-flex align-items-center justify-content-center" style="height: 70vh">
        <div class="col-lg-5 px-lg-4 mx-auto col-11">
            <div class="card border-0 py-2 pt-3 rounded-15 cws-shadow">
                <div class="card-body">
                    <h5 class="text-center">Forgot Password!</h5>
                    <form method="POST" class="mt-3" action="{{ route('login') }}">
                        @csrf
                        <div class="form-check mb-3">
                            <input class="form-check-input payment_type" type="radio" value="phone" name="forget_password_type"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                By Phone :
                            </label>
                        </div>
                        <div class="mb-3">
                            <input type="number" name="data_phone" id="data_phone" placeholder=" enter phone number"
                                class="form-control d-none shadow-none" style="height: 33px;">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input payment_type" type="radio"
                                value="email" name="forget_password_type"
                                id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                By Email :
                            </label>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="data_email" id="data_email" placeholder=" enter email"
                                class="form-control d-none shadow-none" style="height: 33px;">
                        </div>
                        <div class="mb-3 d-flex mt-3">
                            <button class="ml-3 btn btn-dark float-end ms-auto">Send OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".payment_type").change(function () {
        var x = $(this).val();

        if (x == 'phone') {
            $("#data_phone").removeClass('d-none');
            $("#data_email").addClass('d-none');
        } else if (x == 'email') {
            $('#data_phone').addClass('d-none');
            $("#data_email").removeClass('d-none');
        }
    });

</script>
@endsection


1. Connect to other users : https://uipropitome.com/socialStudy/api/connect
body{
    follow_to : id of user whom you want to follow
}

2. Get Connections : https://uipropitome.com/socialStudy/api/connections
method:get;
