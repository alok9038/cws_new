<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>

    <link rel="icon" href="{{ asset('storage/favicon/'.site()->favicon) }}" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/24429d851b.js" crossorigin="anonymous"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css"> --}}

    @yield('css')

    {{-- <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $("#news-slider").owlCarousel({
                items : 4,
                itemsDesktop:[1199,3],
                itemsDesktopSmall:[980,2],
                itemsMobile : [600,1],
                // navigation:true,
                // navigationText:["",""],
                pagination:true,
                autoPlay:true
            });
        });

        $(function() {
            $(window).on("scroll", function() {
                if($(window).scrollTop() > 50) {
                    $(".header").addClass("navbar-active");
                } else {
                    //remove the background property so it comes transparent again (defined in your css)
                $(".header").removeClass("navbar-active");
                }
            });
        });
    </script>
</head>
@php
    $url = Request::segment(1);
@endphp
<style>

    .header {
        position: fixed;
        z-index: 998;
        width: 100%;
        @if ($url !== null)
            height: 80px;
            background-color:white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
        @else
        height: 100px;
        background: rgba(34, 34, 34, 0);
        @endif
        /* color: black; */
        padding: 15px;
        -webkit-transition: all ease-out .5s;
        -moz-transition: all ease-out .5s;
        -o-transition: all ease-out .5s;
        transition: all ease-out .5s;
    }
    .navbar-active {
        background-color: rgba(0, 0, 0, 0.863);
        color: white!important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
        height: 70px;
    }
</style>
<body style="background-color: white;">
    @include('include.messages')
    @include('sweetalert::alert')

    <!-- Sidebar  -->
    <nav id="sidebar">
        @auth
            <div class="sidebar-header p-3">
                <div class="d-flex">
                    <div class="img-card rounded-circle bg-danger">
                        <img src="{{ asset('assets/images/students/'.Auth()->user()->image) }}" class="img-fluid" alt="">
                    </div>
                    <span class="d-flex ms-2 align-items-center">
                        Hi, {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        @endauth
        <ul class="list-unstyled components p m-0 border-0">
            {{-- <h5 class="h6 ps-2 heading">Learn</h5> --}}
            {{-- <li class="">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">My Course</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li >
                        <a href="#">Home 1</a>
                    </li>
                    <li>
                        <a href="#">Home 2</a>
                    </li>
                    <li>
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li> --}}
            <h5 class="h6 ps-2 heading">Popular Categories</h5>
            <li>
                <a href="{{ route('user.dashboard') }}"><img src="{{ asset('assets/images/icons/dashboard.svg') }}" style="height: 15px;" class="img-fluid me-3">My Dashboard</a>
            </li>
            {{-- <li class="@yield('category_select')">
                <a href="#"><img src="{{ asset('assets/images/icons/list.svg') }}" style="height: 18px;" class="img-fluid me-3">Category</a>
            </li> --}}
            <li>
                <a href="{{ route('view.courses') }}"><img src="{{ asset('assets/images/icons/book.svg') }}" style="height: 15px;" class="img-fluid me-3">My Course</a>
            </li>
            <li >
                <a href="{{ route('add.course.view') }}"><img src="{{ asset('assets/images/icons/dollar.svg') }}" style="height: 15px;" class="img-fluid me-3">Payments</a>
            </li>
            <li>
                <a href="{{ route('user.setting') }}"><i class="fa fa-cogs me-3"></i>Setting</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-power-off me-3"></i>Logout</a>
            </li>

        </ul>
    </nav>
    <div class="@if ($url == "") wave @endif ">
        <nav class="navbar navbar-expand-lg navbar-expand-md header navbar-expand-sm  m-0" >
            <div class="container">
                <a type="button" id="sidebarCollapse" class="p-3 ps-0 d-lg-none d-flex shadow-none">
                    <i class="fas fa-align-left"></i>
                    <span></span>
                </a>
                <a href="/" class="navbar-brand mx-lg-0 mx-auto ">{ Code<span class="text-success">With</span>SadiQ }</a>
                {{-- <form action="" class="d-flex ms-5 d-lg-flex d-none">
                    <div class="input-group">
                        <input type="search" size="50" class="form-control rounded-25 p-2 shadow-none" style="font-size: 13px;" placeholder="  search for anything">
                        <button class="btn bg-transparent shadow-none text-muted" style="margin-left:-47px; "><i class="fa fa-search"></i></button>
                    </div>
                </form> --}}
                <ul class="navbar-nav ms-auto d-lg-flex d-md-flex d-none navbar-links">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    @auth
                    <li class="navbar-dropdown">
                        {{-- <a href="#" class="">
                            <i class="far fa-bell" style="font-size: 20px;"></i>
                        </a> --}}
                        <div class="dropdown  rounded-15" style="left: -100px!important;">
                          <h6 class="h6 ms-3">Notifications</h6>
                          <a href="#">lorem ipsum emmet </a>
                          <a href="#">Laravel</a>
                          <a href="#">Django</a>
                        </div>
                      </li>
                    {{-- <li class="nav-item"><a href="" class="nav-link mx-2 ">
                        <i class="fa fa-shopping-cart" style=" font-size:20px;"></i>
                    </a></li> --}}
                    <li class="nav-item"><a href="#search" class="nav-link"><i class="fa fa-search px-3"></i></a></li>

                    <li class="nav-item navbar-dropdown" >
                        <a href="#" class="nav-link ms-2 border rounded-circle p-0" style="width: 40px; height:40px;">
                            <img src="{{ asset('assets/images/students/'.Auth::user()->image) }}" class="img-fluid rounded-circle" style="width: 40px; height:40px;" alt="{{ Auth::user()->image }}">
                        </a>
                        <div class="dropdown rounded-15" style="left: -150px!important;">
                            <div class="d-flex">
                                <div class="ms-3 rounded-circle bg-danger" style="width: 40px; height:40px;">
                                    <img src="{{ asset('assets/images/students/'.Auth::user()->image) }}" class="img-fluid rounded-circle" style="width: 40px; height:40px;" alt="{{ Auth::user()->image }}">
                                </div>
                                <span class="d-flex ms-2 align-items-center">
                                    Hi, {{ Auth::user()->name }}
                                </span>
                            </div>
                            <hr>
                          @if (Auth::user()->user_type == "admin")
                            <a href="{{ route('admin.dashboard') }}">My Dashboard</a>
                          @else
                            <a href="{{ route('user.dashboard') }}">My Dashboard</a>
                          @endif
                          <a href="{{ route('get.enroll') }}">My Cart</a>
                          <a href="{{ route('user.course') }}">My Course</a>
                          {{-- <a href="#">Messages</a> --}}
                          <a href="#" onclick="document.getElementById('form').submit();">Logout</a>
                            <form action="{{ route('logout') }}" id="form" method="POST">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endauth
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link px-3">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link border-start ps-3">Join</a></li>
                        <li class="nav-item"><a href="#search" class="nav-link"><i class="fa fa-search px-3"></i></a></li>
                    @endguest
                </ul>
                <div class="d-lg-none d-md-none d-flex">
                    <a href="#search" class="p-3 d-lg-none d-flex shadow-none">
                        <i class="fa fa-search"></i>
                    </a>
                    {{-- <a type="button" class="p-3 pe-0 d-lg-none ms-auto d-flex shadow-none">
                        <i class="fas fa-shopping-cart"></i>
                    </a> --}}
                </div>
            </div>
        </nav>
        @yield('banner')


        @if ($url == "")</div>@endif

        <div class="container-fluid px-0" style="padding-top: 100px;">
            @yield('content')
        </div>

    <div class="overlay">
    </div>
    <div id="search">
        <button type="button" class="close">×</button>
        <form method="get" action="">
            <input type="search" value="" placeholder="search Course :)" />
            <button type="submit" class="btn btn-outline-primary rounded-25 px-4">Search</button>
        </form>
    </div>


    <!-- footer -->
    <footer>
        <div class="container-fluid" style="padding-top:100px;">
            <div class="container" style="padding-bottom:100px">
                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                    <div class="col d-lg-flex align-items-center justify-content-center">
                        <div>
                            <div class="d-flex">
                                <span><img src="https://avatars.githubusercontent.com/u/32757358?v=4" class="img-fluid rounded-15" style="height:90px; width:90px;" alt=""></span>
                                <span class="mt-2 ms-2">SadiQue Hussain <br><p class="small">tutor</p></span>
                            </div>
                            <ul class="footer-ul mt-4">
                                <li class="footer-li mb-3"><a href="tel:+91 9546805580" class="footer-a"><i class="fa fa-phone-alt"></i> +91 9546805580</a></li>
                                <li class="footer-li mb-3"><a href="mailto:cwspurnea@gmail.com" class="footer-a"><i class="fa fa-envelope"></i> cwspurnea@gmail.com</a></li>
                                <li class="footer-li mb-3"><a href="" class="footer-a"><i class="fa fa-map-marker"></i> K. Haat Thana Chowk, Purnia
                                    Bihar 854301</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-lg-flex justify-content-center">
                        <div>
                            <h5 class="h5">Explore</h5>
                            <div class="section-borders" style="margin-top:-10px;">
                                <span class="bg-success" style="width:90px;"></span>
                            </div>
                            <span style="background-color: gray; width:40px; height:5px;"></span>
                            <ul class="footer-ul">
                                <li class="footer-li"><a href="" class="text-decoration-none footer-a">Start here</a></li>
                                <li class="footer-li"><a href="" class="text-decoration-none footer-a">About us</a></li>
                                <li class="footer-li"><a href="" class="text-decoration-none footer-a">Contact us</a></li>
                                <li class="footer-li"><a href="" class="text-decoration-none footer-a">Course</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-lg-flex justify-content-center">
                        <div>
                            <h5 class="h5">Connect With Us</h5>
                            <div class="section-borders" style="margin-top:-10px;">
                                <span class="bg-success" style="width:90px;"></span>
                            </div>
                            <ul class="footer-ul">
                                <li class="footer-li"><a href="{{ site()->facebook }}" class="text-decoration-none facebook"><i class="fa fa-facebook-square fa-2x me-2"></i> Facebook</a></li>
                                <li class="footer-li"><a href="{{ site()->linkedin }}" class="text-decoration-none linkedin"><i class="fa fa-linkedin-square fa-2x me-2"></i>Linkedin</a></li>
                                <li class="footer-li"><a href="{{ site()->github }}" class="text-decoration-none github"><i class="fa fa-github-square fa-2x me-2"></i>GitHub</a></li>
                                <li class="footer-li"><a href="{{ site()->twitter }}" class="text-decoration-none twitter"><i class="fa fa-twitter-square fa-2x me-2"></i>Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-lg-flex justify-content-center">
                        <div>
                            <h5 class="h5">Featured Course</h5>
                            <div class="section-borders" style="margin-top:-10px;">
                                <span class="bg-success" style="width:90px;"></span>
                            </div>
                            <ul class="footer-ul">
                                @php
                                    $featured_courses = footer_featured_course();
                                @endphp
                                @foreach ($featured_courses as $course)
                                <li class="footer-li">
                                    <a href="{{ route('home.course.view',['slug'=>$course->slug, 'id'=>$course->id]) }}" class="text-decoration-none d-flex">
                                        <span><img src="{{ asset('assets/images/course/'.$course->image) }}" class="img-fluid rounded-15 cws-shadow" style="height: 50px; width:50px!important;" alt=""></span>
                                        <span class="small mt-2 ms-2 text-truncate">{{ $course->title }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container py-3 border-top">
                <h6 class="text-center small"><span>© 2021 | CodeWithSadiQ. All Rights Reserved | Developed By : <a href="https://github.com/alok9038" target="_blank" class="text-decoration-none">alok</a></span></h6>
            </div>
        </div>
    </footer>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>

    <script type="text/javascript">
            $(function () {
            $('a[href="#search"]').on('click', function(event) {
                event.preventDefault();
                $('#search').addClass('open');
                $('#search > form > input[type="search"]').focus();
            });

            $('#search, #search button.close').on('click keyup', function(event) {
                if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                    $(this).removeClass('open');
                }
            });
        });
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });

        // slider
    </script>
</body>

</html>
