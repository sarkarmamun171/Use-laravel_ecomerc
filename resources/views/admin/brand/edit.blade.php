@extends('layouts.admin');
@section('content')
<div class="col-lg-6  m-auto">
    <div class="card">
        <div class="card-header">
            <h3>Edit Brand Product</h3>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="">Brand Name</label>
                    <input type="text" class="form-control" name="brand_name">
                </div>
                <div class="mb-3">
                    <label for="">Brand Logo</label>
                    <input type="file" class="form-control" name="brand_logo">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-info">Update Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
