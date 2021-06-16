@extends('layouts.base')
@section('page_title','Register | CodeWithSadiQ ')

@section('content')
<div class="container-fluid bg-light" style="margin-top: -20px;">
    <div class="container d-flex align-items-center justify-content-center py-5" style="height: auto">
        <div class="col-lg-8 px-lg-4 mx-auto col-12">
            <div class="card border-0 py-2 pt-3 rounded-15 cws-shadow">
                <div class="card-body">
                    <h5 class="text-center">Join Now!</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input id="name" class="form-control shadow-none @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}"  autofocus />
                            @error('name') <p class="text-danger small">{{ $message }}</p> @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="mother_name">Mother's name</label>
                                <input id="mother_name" class="form-control shadow-none @error('mother_name') is-invalid @enderror" type="text" name="mother_name" value="{{ old('mother_name') }}"  autofocus />
                                @error('mother_name') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="father_name">Father's name</label>
                                <input id="father_name" class="form-control shadow-none @error('father_name') is-invalid @enderror" type="text" name="father_name" value="{{ old('father_name') }}"  autofocus />
                                @error('father_name') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="email">Email</label>
                                <input id="email" class="form-control shadow-none @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}"  autofocus />
                                @error('email') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="contact">Contact</label>
                                <input id="contact" class="form-control shadow-none @error('contact') is-invalid @enderror" type="number" name="contact" value="{{ old('contact') }}"  autofocus />
                                @error('contact') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="education" >Education</label>
                            <input id="education" class="form-control shadow-none @error('education') is-invalid @enderror" type="text" name="education"  autocomplete="current-password" />
                            @error('education') <p class="text-danger small">{{ $message }}</p> @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control shadow-none @error('gender') is-invalid @enderror" id="gender">
                                    <option value="" selected hidden disabled>Select Gender</option>
                                    <option value="0">Male</option>
                                    <option value="1">FeMale</option>
                                    <option value="2">Other</option>
                                </select>
                                @error('gender') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="dob">Date Of Birth</label>
                                <input id="dob" class="form-control shadow-none @error('dob') is-invalid @enderror" type="date" name="dob" value="{{ old('dob') }}"  autofocus />
                                @error('dob') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea rows="5" name="address" class="form-control shadow-none @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                            @error('address') <p class="text-danger small">{{ $message }}</p> @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="password" >Password</label>
                                <input id="password" class="form-control shadow-none @error('password') is-invalid @enderror" type="password" name="password"  autocomplete="current-password" />
                                @error('password') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-3 col">
                                <label for="password_confirmation" >Confirm Password</label>
                                <input id="password_confirmation" class="form-control shadow-none @error('password_confirmation') is-invalid @enderror"
                                                type="password"
                                                name="password_confirmation"  />
                                @error('password_confirmation') <p class="text-danger small">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="">Already Register?</a>
                        <div class="clearfix"></div>
                        <div class="mb-3 mt-3">
                            <button class="ml-3 btn btn-dark float-end ms-auto">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
