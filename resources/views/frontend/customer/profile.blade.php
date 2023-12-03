@extends('frontend.master');
@section('content')
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="index.html">Home</a></li>
                            <li>Customer Profile</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card text-center my-3">
                    @if (Auth::guard('customer')->user()->photo == null)
                        <img width="70" class="m-auto"
                            src="{{ Avatar::create(Auth::guard('customer')->user()->fname)->toBase64() }}" alt="">
                    @else
                        <img src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}"
                            alt="">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ Auth::guard('customer')->user()->fname }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-info">Update Profile</li>
                        <li class="list-group-item">My Order</li>
                        <li class="list-group-item">Wishlist</li>
                        <li class="list-group-item"><a href="{{ route('customer.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card my-3">
                    <div class="card-header">
                        <h5>Update Profle Information</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Frist Name</label>
                                    <input type="text" class="form-control" name="fname" value="{{ Auth::guard('customer')->user()->fname }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="{{ Auth::guard('customer')->user()->lname }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::guard('customer')->user()->email }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{ Auth::guard('customer')->user()->country }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Phone</label>
                                    <input type="number" class="form-control" name="phone" value="{{ Auth::guard('customer')->user()->phone }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">City</label>
                                    <input type="text" class="form-control" name="City" value="{{ Auth::guard('customer')->user()->City }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ Auth::guard('customer')->user()->address }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Zip</label>
                                    <input type="text" class="form-control" name="zip" value="{{ Auth::guard('customer')->user()->zip }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="for-label">Image</label>
                                    <input type="file" class="form-control" name="photo" value="{{ Auth::guard('customer')->user()->photo }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
