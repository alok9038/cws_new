@extends('layouts.user_base')
@section('page_title','user | codeWithSadiQ')
@section('setting_select','active')
@section('content')
<style>
    <style>
@import url(https://fonts.googleapis.com/css?family=Montserrat:500);

.heading {
	font-family: "Montserrat", Arial, sans-serif;
	font-size: 3rem;
	font-weight: 500;
	line-height: 1.5;
	text-align: center;
	/* padding: 3.5rem 0; */
	color: #1a1a1a;
}

.gallery-item {
	box-shadow: 0.3rem 0.4rem 0.4rem rgba(0, 0, 0, 0.4);
	overflow: hidden;
    width: 100%;
	height: 100%;
    border-radius: 10px;
}

.gallery-image {
	display: block;
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform 400ms ease-out;
}

.gallery-image:hover {
	transform: scale(1.15);
}

</style>
</style>
<div class="container me-auto px-lg-5">
    <h4>Setting</h4>
    <div class="row">
        <div class="card mt-4 p-0 border-0 rounded-10 cws-shadow bg-white pt-5">
            <div class="col-lg-3  col-10 mx-auto">
                <div>
                    <div class="gallery-item">
                        <img class="gallery-image" src="{{ asset('assets/images/students/'.Auth()->user()->image) }}" class="img-fluid" alt="" style="height: 293px;">
                    </div>
                    <a href="#updateProfileImage" data-bs-toggle="modal" data-bs-target="#updateProfileImage">
                        <div style="height: 50px; width:50px;position: relative;bottom:30px; left:75%;" class="bg-white rounded-circle cws-shadow-lg d-flex justify-content-center align-items-center">
                            <i class="fa fa-edit text-info"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body text-center">
                <h6 class="h5">{{ Auth()->user()->name }}</h6>
                <h4 class="h6 mt-2"><strong>Father's name :</strong> {{ Auth()->user()->father_name }}</h4>
                <h4 class="h6 mt-2"><strong>Mother's name : </strong>{{ Auth()->user()->mother_name }}</h4>
                <h4 class="small mt-2"><strong>Date Of birth :</strong> {{ Auth()->user()->dob }}</h4>
                <h4 class="small mt-2"><strong>Address :</strong> {{ Auth()->user()->address }}</h4>
            </div>
        </div>
    </div>


</div>
{{-- update basic details --}}
<div class="container mt-5 px-lg-5">
    <h5>Basic Details</h5>
    <div class="card border-0 cws-shadow-md rounded-10">
        <div class="card-body">
            <form action="{{ route('update.details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col">
                        <label class="fw-bold">Name</label>
                        <input type="text" name="name" value="{{ Auth()->user()->name }}" class="form-control shadow-none">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="mother_name" class="fw-bold">Mother's Name</label>
                        <input type="text" name="mother_name" value="{{ Auth()->user()->mother_name }}" class="form-control shadow-none">
                    </div>
                    <div class="mb-3 col">
                        <label for="father_name" class="fw-bold">Father's Name</label>
                        <input type="phone" name="father_name" value="{{ Auth()->user()->father_name }}" class="form-control shadow-none">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="email" class="fw-bold">Email</label>
                        <input type="email" name="email" value="{{ Auth()->user()->email }}" class="form-control shadow-none">
                    </div>
                    <div class="mb-3 col">
                        <label for="phone" class="fw-bold">Phone</label>
                        <input type="phone" name="phone" value="{{ Auth()->user()->contact }}" class="form-control shadow-none">
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-dark btn-sm float-end">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- change password --}}
<div class="container my-5 px-lg-5">
    <h5>Change Password</h5>
    <div class="card border-0 cws-shadow-md rounded-10">
        <div class="card-body">
            <form action="{{ route('change.password') }}" method="POST">
                @csrf
                <div class="mb-3 col">
                    <label class="fw-bold">Current Password</label>
                    <input type="password" name="current_password" class="form-control shadow-none">
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label class="fw-bold" for="email">New Password</label>
                        <input type="password" name="password" class="form-control shadow-none">
                        @error('password')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 col">
                        <label class="fw-bold">Confirm Passoword</label>
                        <input type="password" name="password_confirmation" class="form-control shadow-none">
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-dark btn-sm float-end">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- update profile image --}}
<div class="modal fade" id="updateProfileImage" tabindex="-1" aria-labelledby="updateImage" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-10">
        <div class="modal-header py-2">
          <h5 class="modal-title" id="updateImage">Update Profile Image</h5>
          <button type="button" class="close bg-white border-0" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{ asset('assets/images/students/'.Auth::user()->image) }}" class="img-fluid rounded-10 w-100 blah" id="blah" style="height: 300px; width:300px;object-fit:cover;" alt="">
            <form action="{{ route('update.dp') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-3 col-lg-8">
                    <label class="small" for="image">Upload Image</label>
                    <input type="file" name="image" onchange="readURL(this);" class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <button class="btn btn-dark btn-sm float-end" type="submit">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endsection
