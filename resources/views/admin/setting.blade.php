@extends('layouts.newBase')
@section('page_title','Admin Settings ')
@section('setting_select','mm-active')
@section('content')
        <div class="container my-5 mb-3">
            <h5>Settings</h5>
            <div class="card border-0 cws-shadow-md rounded-10">
                <div class="card-header border-0 bg-transparent">
                </div>
                <div class="card-body">
                    {{-- <h5 class="text-center">Logo </h5>
                    <div class="d-flex">
                        <img src="{{ asset('storage/logo/'.site()->logo) }}" class="img-fluid mx-auto" style="height: 150px; width:200px;" alt="logo">
                    </div>
                    <div class="mb-3">
                        <button data-toggle="modal" data-target="#updateLogo" class="btn border-0 shadow-none d-flex mx-auto text-muted"><i class="fa fa-edit"></i> Change</button>
                    </div> --}}
                    <form action="{{ route('update.site.favicon') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-lg-3 mb-3">
                                <img src="{{ asset('storage/favicon/'.site()->favicon) }}" alt="favicon" class="img-fluid border blah" style="height: 80px; width:80px;">
                            </div>
                            <div class="mb-3 col-lg-6 ">
                                <label for="">Favicon</label>
                                <div class="input-group">
                                    <input type="file" name="favicon" onchange="readURL(this);" class="form-control shadow-none">
                                    <button class="btn btn-dark btn-sm">upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                   <form action="{{ route('update.site.details') }}" method="post">
                        @csrf
                        <div>
                            <div class="mb-3">
                                <label for="contact" class="fw-bold">Contact</label>
                                <input type="number" value="{{ site()->contact }}" name="contact" class="form-control rounded-10 ">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="fw-bold">Address</label>
                                <textarea name="address" class="rounded-10 form-control shadow-none" id="address" cols="30" rows="3">{{ site()->address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">About us :</label>
                                <textarea name="about_us" class="rounded-10 form-control shadow-none" id="" cols="30" rows="5">{{ site()->about_us }}</textarea>
                            </div>
                            <div class="mb-3">
                                <h5>Social Links :</h5>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="facebook" class="fw-bold">Facebook</label>
                                        <input type="text" name="facebook" value="{{ site()->facebook }}" class="form-control rounded-10">
                                    </div>
                                    <div class="col">
                                        <label for="facebook" class="fw-bold">Twitter</label>
                                        <input type="text" name="twitter" value="{{ site()->twitter }}" class="form-control rounded-10">
                                    </div>
                                    <div class="col">
                                        <label for="facebook" class="fw-bold">Linkedin</label>
                                        <input type="text" name="linkedin" value="{{ site()->linkedin }}" class="form-control rounded-10">
                                    </div>
                                    <div class="col">
                                        <label for="facebook" class="fw-bold">Google</label>
                                        <input type="text" name="google" value="{{ site()->google }}" class="form-control rounded-10">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn-dark btn btn-sm float-end">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <h5>Account Settings</h5>
            <div class="card border-0 cws-shadow-md rounded-10">
                <div class="card-body">
                    <form action="{{ route('update.admin.details') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col">
                                <label class="fw-bold">Name</label>
                                <input type="text" name="name" value="{{ Auth()->user()->name }}" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="fw-bold">Email</label>
                            <input type="email" name="email" value="{{ Auth()->user()->email }}" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-sm float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container mb-5">
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
        {{-- profile photo modal --}}
        <div class="modal fade" id="updateLogo" tabindex="-1" aria-labelledby="updateImage" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content rounded-10">
                <div class="modal-header py-2">
                <h5 class="modal-title" id="updateImage">Update Profile Image</h5>
                <button type="button" class="close bg-white border-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <img src="
                        @if (site()->logo != null)
                        {{ logo() }}
                        @endif
                    " class="img-fluid rounded-10 w-100 blah" style="height: 300px; width:300px;object-fit:cover;" alt="">
                    <form action="{{ route('update.site.logo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3 col-lg-8">
                            <label class="small" for="image">Upload Logo</label>
                            <input type="file" name="logo" onchange="readURL(this);" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-sm float-end" type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm rounded-0 py-1" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>

@endsection

@section('js')
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
