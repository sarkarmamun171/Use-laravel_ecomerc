@extends('layouts.admin')
@section('content')
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-header">
            <h3>Edit Category</h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="category_id" value="{{ $category_information->id }}">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="">Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="{{ $category_information->category_name }}">
                    @error('category_name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Category Iamge</label>
                    <input type="file" name="category_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    @error('category_image')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="my-3">
                    <img id="blah" width="50" src="{{ asset('/uploads/category/') }}/{{ $category_information->category_image }}" alt="">
                </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
