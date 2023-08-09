@extends('layouts.admin');
@section('content')
    <div class="col-lg-8">
        <div class="card bg-light">
            <div class="card-header">
                <h3>SubCategory List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-6">
                            <div class="card-header">
                                <h3>{{ $category->category_name }}</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>SubCategory Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                        <tr>
                                            <td>{{ $subcategory->Subcategory_name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a title="Edit" href="{{ route('category.subcategory.edit', $subcategory->id) }}"
                                                        class="btn btn-primary shadow btn-xs sharp del_btn"><i
                                                            class="fa fa-pencil"></i></a>&nbsp;
                                                    <a title="Delete"
                                                        href=""
                                                        class="btn btn-danger shadow btn-xs sharp del_btn"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>SubCategory</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <strong class="text-primary">{{ session('success') }}</strong>
                @endif
                @if (session('exit'))
                    <strong class="text-primary">{{ session('exit') }}</strong>
                @endif
                <form action="{{ route('subcategory.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <select name="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-level">Subcategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name">
                        @error('subcategory_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">Add SubCategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
