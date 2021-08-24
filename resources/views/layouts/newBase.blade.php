<!doctype html>
<html lang="en" class="semi-dark">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
    <link rel="icon" href="{{ asset('storage/favicon/'.site()->favicon) }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('admin_assets/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin_assets/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin_assets/assets/plugins/highcharts/css/highcharts.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin_assets/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin_assets/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('admin_assets/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('admin_assets/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('admin_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('admin_assets/assets/css/dark-theme.css') }}" />
	{{-- <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/semi-dark.css') }}" /> --}}
	<link rel="stylesheet" href="{{ asset('admin_assets/assets/css/header-colors.css') }}" />

    @yield('css')

	<title>@yield('page_title') CodeWithSadiq | Admin Pannel</title>
</head>

<body>
    @include('sweetalert::alert')
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<h4 class="logo-text text-center">CodeWithSadiQ</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>

            @include('admin.include.sidebar')

		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class='bx bx-eye'></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="row row-cols-3 g-3 p-3">
                                        <div class="col text-center">
											<div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bxs-dashboard'></i>
											</div>
                                            <a href="{{ route('admin.dashboard') }}" class="stretched-link"></a>
											<div class="app-title">Dashboard</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
											</div>
                                            <a href="{{ route('admin.students') }}" class="stretched-link"></a>
											<div class="app-title">Students</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
											</div>
                                            <a href="{{ route('admin.workshop.view') }}" class="stretched-link"></a>
											<div class="app-title">Workshops</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-rupee'></i>
											</div>
                                            <a href="{{ route('admin.due.payments') }}" class="stretched-link"></a>
											<div class="app-title">Payments</div>
										</div>

										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-book-content'></i>
											</div>
                                            <a href="{{ route('view.courses') }}" class="stretched-link"></a>
											<div class="app-title">Course</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-cog'></i>
											</div>
											<div class="app-title">Settings</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="https://via.placeholder.com/110x110" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{ auth()->user()->name }}</p>
								<p class="designattion mb-0">Web Designer</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="{{ route('setting.view') }}"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item" href="{{ route('setting.view') }}"><i class="bx bx-cog"></i><span>Settings</span></a>
							<li><a class="dropdown-item" href="{{ route('admin.earning') }}"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
                            <form action="{{ route('logout') }}" id="logout_form" method="POST">
                                @csrf
                            </form>
							<li><a class="dropdown-item" onclick="document.getElementById('logout_form').submit();" href="#"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
                @yield('content')
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2021. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	{{-- <div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr/>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr/>
			<h6 class="mb-0">Header Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('admin_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('admin_assets/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/highcharts/js/highcharts.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/highcharts/js/exporting.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/highcharts/js/variable-pie.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/highcharts/js/export-data.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/highcharts/js/accessibility.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
	<script src="{{ asset('admin_assets/assets/js/index.js') }}"></script>
	<!--app JS-->
    @yield('js')
	<script src="{{ asset('admin_assets/assets/js/app.js') }}"></script>
	<script>
		new PerfectScrollbar('.customers-list');
		new PerfectScrollbar('.store-metrics');
		new PerfectScrollbar('.product-list');
	</script>
</body>

</html>
