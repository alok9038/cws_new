
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('page_title')</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminSidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body class="bg-light">

        <!-- Sidebar  -->
        <nav id="sidebar">
            <ul class="list-unstyled components">
                <p class="text-center text-dark"><a href="{{ route('homepage') }}" class="text-decoration-none">CodeWithSadiQ</a></p>
                <li class="@yield('dashboard_select')">
                    <a href="{{ route('user.dashboard') }}"><img src="{{ asset('assets/images/icons/dashboard.svg') }}" style="height: 18px;" class="img-fluid me-3">My Dashboard</a>
                </li>
                <li class="@yield('course_select')">
                    <a href="{{ route('user.course') }}"><img src="{{ asset('assets/images/icons/book.svg') }}" style="height: 18px;" class="img-fluid me-3">My Courses</a>
                </li>
                <li class="@yield('payment_select')">
                    <a href="{{ route('user.payments') }}"><img src="{{ asset('assets/images/icons/dollar.svg') }}" style="height: 18px;" class="img-fluid me-3">Payments</a>
                </li>
                <li class="@yield('setting_select')">
                    <a  href="{{ route('user.setting') }}"><img src="{{ asset('assets/images/icons/settings.svg') }}" style="height: 18px;" class="img-fluid me-3">Setting</a>
                </li>
                <form action="{{ route('logout') }}" id="logout_form" method="POST">
                    @csrf
                </form>
                <li class="@yield('logout_select')">
                    <a href="#" onclick="document.getElementById('logout_form').submit();"><i class="fa fa-power-off me-3"></i>Logout</a>
                </li>
                {{-- <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-white p-2">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn bg-transparent shadow-none">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <ul class="navbar-nav navbar-links">
                        <li class="navbar-dropdown dropleft me-lg-5">
                            <a href="#" class="">
                                <img src="{{ asset('assets/images/students/'.Auth()->user()->image) }}" style="height: 30px;width:30px; object-position:center;" alt="" class="img-fluid rounded-circle cws-shadow">
                            </a>
                            <div class="dropdown  rounded-15" style="left: -180px;">
                              <h6 class="h6 ms-3 text-capitalize">{{ Auth::user()->name }}</h6>
                              <a href="#">My Profile</a>
                              <a href="#">Settings</a>
                              <a href="#" onclick="document.getElementById('form').submit();">Logout</a>
                                <form action="{{ route('logout') }}" id="form" method="POST">
                                    @csrf
                                </form>
                            </div>
                          </li>
                    </ul>
                </div>
            </nav>

            @yield('content')
            @include('include.messages')
        </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>
