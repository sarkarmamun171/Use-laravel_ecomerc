@extends('layouts.admin');
@section('content')
    <div class="col-lg-8">

        <form action="" method="post">
            @csrf
            <div class="card">

                <div class="card-header">
                    <h3>Brand List</h3>
                </div>
                <div class="card-body">
                    @if (session('delete'))
                        <div class="alert alert-info">{{ session('delete') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Brand Name</th>
                            <th>Brand Logo</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($brands as $sl => $brand)
                            <tr>
                                <td>{{ $brands->firstitem() + $sl }}</td>
                                <td>{{ $brand->brand_name }}</td>
                                <td><img width="50" src="{{ asset('uploads/brands/') }}/{{ $brand->brand_logo }}"></td>
                                <td>
                                    <div class="d-flex">
                                        <a title="Edit" href="{{ route('category.brand.edit', $brand->id) }}"
                                            class="btn btn-primary shadow btn-xs sharp del_btn"><i
                                                class="fa fa-pencil"></i></a>&nbsp;
                                        <a title="Delete" href="{{ route('category.brand.delete', $brand->id) }}"
                                            class="btn btn-danger shadow btn-xs sharp del_btn"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $brands->links() }}
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4">

        <div class="card">
            <div class="card-header">
                <h3>Add New Brand</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-info">{{ session('success') }}</div>
                @endif
                <form action="{{ route('category.brand.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control">
                        @error('brand_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Brand Logo</label>
                        <input type="file" name="brand_logo" class="form-control">
                        @error('brand_logo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info"> Add Barnd</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
