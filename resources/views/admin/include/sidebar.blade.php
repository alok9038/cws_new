<!--navigation-->
<ul class="metismenu" id="menu">
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <div class="parent-icon"><i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li class="@yield('course_select')">
        <a href="{{ route('view.courses') }}">
            <div class="parent-icon"><i class='bx bx-copyright'></i>
            </div>
            <div class="menu-title">Manage Course</div>
        </a>
    </li>
    <li class="@yield('create_course_select')">
        <a href="{{ route('add.course.view') }}">
            <div class="parent-icon"><i class='bx bx-plus-circle'></i>
            </div>
            <div class="menu-title">Create Course</div>
        </a>
    </li>
    <li class="@yield('user_select')">
        <a href="{{ route('admin.students') }}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">Students</div>
        </a>
    </li>
    <li class="@yield('workshop_select')">
        <a href="{{ route('admin.workshop.view') }}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">Workshop</div>
        </a>
    </li>
    <li class="@yield('workshop_enrolled_select')">
        <a href="{{ route('admin.workshop.enrolled') }}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">Workshop Enrolled</div>
        </a>
    </li>
    <li class="@yield('earning_select')">
        <a href="{{ route('admin.due.payments') }}">
            <div class="parent-icon"><i class='bx bx-dollar'></i>
            </div>
            <div class="menu-title">Payments</div>
        </a>
    </li>
    <hr>
    <li class="@yield('payment_setting')">
        <a href="{{ route('payment.setting.view') }}">
            <div class="parent-icon"><i class='bx bx-plus-circle'></i>
            </div>
            <div class="menu-title">Payment Setting</div>
        </a>
    </li>
    <li class="@yield('setting_select')">
        <a href="{{ route('setting.view') }}">
            <div class="parent-icon"><i class='bx bx-cog'></i>
            </div>
            <div class="menu-title">Setting</div>
        </a>
    </li>
    <li class="@yield('logout')">
        <form action="{{ route('logout') }}" id="logout_form1" method="POST">
            @csrf
        </form>
        <a onclick="document.getElementById('logout_form1').submit();" href="#">
            <div class="parent-icon"><i class='bx bx-power-off'></i>
            </div>
            <div class="menu-title">Logout</div>
        </a>
    </li>
</ul>
<!--end navigation-->

