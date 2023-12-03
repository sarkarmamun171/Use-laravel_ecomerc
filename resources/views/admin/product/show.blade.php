
@extends('layouts.admin');
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>Product Details</h3>
            <a href="{{ route('product.list') }}" class="btn btn-primary"><i class="fa fa-list mr-2"></i>Product List</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Product Name</td>
                    <td>{{ $product->product_name }}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <td>Short Description</td>
                    <td>{{ $product->short_des }}</td>
                </tr>
                <tr>
                    <td>Long Dscription</td>
                    <td>{!! $product->long_description !!}</td>
                </tr>
                <tr>
                    <td>Additional Information</td>
                    <td>{!! $product->add_info !!}</td>
                </tr>
                <tr>
                    <td>Preview Image</td>
                    <td><img width="100" src="{{ asset('uploads/product/preview') }}/{{ $product->pre_image }}" alt=""></td>
                </tr>
                <tr>
                    <td>Image Gallery</td>
                    <td>
                        @foreach ($galleries as $gallery)
                            <img width="100" src="{{ asset('uploads/product/gallery') }}/{{ $gallery->gallery }}" alt="">
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
