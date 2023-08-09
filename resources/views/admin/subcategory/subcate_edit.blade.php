@extends('layouts.admin')

@section('content')
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-header">
            <h3>Edit SubCategory</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <strong class="text-primary">{{ session('success') }}</strong>
            @endif
            <form action="{{ route('category.subcategory.update',$subcategory->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option {{ $category->id==$subcategory->category_id?'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-level">Subcategory Name</label>
                    <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategory->Subcategory_name }}">
                    @error('subcategory_name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-info">Update SubCategory</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
