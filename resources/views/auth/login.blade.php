@extends('layouts.base')
@section('page_title','Login | CodeWithSadiQ ')

@section('content')
<div class="container-fluid bg-light" style="margin-top: -20px;">
    <div class="container d-flex align-items-center justify-content-center" style="height: 70vh">
        <div class="col-lg-5 px-lg-4 mx-auto col-11">
            <div class="card border-0 py-2 pt-3 rounded-15 cws-shadow">
                <div class="card-body">
                    <h5 class="text-center">Welcome Back!</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input id="email" class="form-control shadow-none" type="email" name="email" value="{{ old('email') }}" required autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="password" >Password</label>
                            <input id="password" class="form-control shadow-none" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-end ">
                            @if (Route::has('password.request'))
                                <a class="underline float-end text-sm text-muted small" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="clearfix"></div>

                        <div class="mb-3 d-flex mt-3">
                            <a href="{{ route('register') }}" class="">I'm new!</a>
                            <button class="ml-3 btn btn-dark float-end ms-auto">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
