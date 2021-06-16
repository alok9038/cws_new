@extends('layouts.user_base')
@section('page_title',"User | CodeWithSadiQ")
@section('dashboard_select','active')
@section('content')
    <div class="container px-lg-5">
        <h4>Dashboard</h4>
        <div class="row mt-4">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 rounded-0 cws-shadow bg-white">
                    <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                        My Courses
                    </div>
                    <div class="card-body border-top">
                        <div class="d-flex p-2 bg-light">
                            <span><img src="https://www.codewithsadiq.com/images/php.jpg" alt="" style="width: 150px;" class="img-fluid"></span>
                            <span class="mt-2 ms-3">Php & Mysqli <br> <p class="small text-danger">rs. 400 dues</p></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 rounded-0 cws-shadow bg-white">
                    <div class="card-header border-0 rounded-0 bg-white border-start border-3 border-success">
                        My Payments
                    </div>
                    <div class="card-body border-top">
                        <div class="d-flex p-2 bg-light mb-2">
                            <span>12th April <br>  <p class="small text-success">700 paid</p></span>
                            <span class=" ms-3">Php & Mysqli <br> <p class="small text-danger">rs. 400 dues</p></span>
                        </div>
                        <div class="d-flex p-2 bg-light mb-2">
                            <span>30th May <br>  <p class="small text-success">300 paid</p></span>
                            <span class=" ms-3">Php & Mysqli <br> <p class="small text-danger">rs. 100 dues</p></span>
                        </div>
                        <div class="d-flex p-2 bg-light mb-2">
                            <span>1st june <br>  <p class="small text-success">100 paid</p></span>
                            <span class=" ms-3">Php & Mysqli <br> <p class="small text-info">No dues</p></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
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
            </div>
        </div>
    </div>
@endsection
