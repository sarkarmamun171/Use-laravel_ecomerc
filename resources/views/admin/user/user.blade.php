@extends('layouts.admin')
@section('content')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Update Profile Information</h3>
            </div>
            <div class="card-header">
                <form action="{{ route('user.profile.update') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name"
                                value="{{ Auth::user()->name }}">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Email"
                                value="{{ Auth::user()->email }}">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            @if (session('password_update'))
                <strong class="text text-danger"> {{ session('password_update') }}</strong>
            @endif
            <div class="card-header">
                <h3>Password Update Information</h3>
            </div>
            <div class="card-header">
                <form action="{{ route('user.password.update') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Old Password</label>
                        <input type="text" class="form-control" name="old_password">
                        @error('old_password')
                            <strong class="text text-danger"> {{ $message }}</strong>
                        @enderror
                        @if (session('current_pass'))
                            <strong class="text text-danger"> {{ session('current_pass') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control">
                        @error('password')
                            <strong class="text text-danger"> {{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="text" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <strong class="text text-danger"> {{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Update Image</h3>
            </div>
            @if (session('image_update'))
            <strong class="text text-primary"> {{ session('image_update') }}</strong>
            @endif
            <div class="card-header">
                <form action="{{ route('user.image.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="" class="form-label">Current Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection()
