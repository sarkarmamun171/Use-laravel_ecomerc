@extends('layouts.admin')

@section('content')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Size List</h3>
            </div>
            <div class="card-body">
               <div class="row">
                 @foreach ($categories as $category)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>{{ $category->category_name }}</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Size</td>
                                        <td>Action</td>
                                    </tr>
                                  @foreach (App\Models\Size::where('category_id',$category->id)->get() as $size)
                                    <tr>

                                        <td>{{ $size->size_name }}</td>
                                        {{-- <td><i style="width: 50px; height:50px; background-color:{{ $color->color_code }}; color:transparent"></i></td> --}}
                                        <td>
                                            <a title="Delete" href="{{ route('size.remove',$size->id) }}" class="btn btn-danger shadow btn-xs sharp del_btn"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                 @endforeach
               </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Color List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Color Name</td>
                        <td>Color Code</td>
                        <td>Action</td>
                    </tr>
                  @foreach ($colors as $color)
                    <tr>
                        <td>{{ $color->color_name }}</td>
                        <td>{{ $color->color_code }}</td>
                        {{-- <td><i style="width: 50px; height:50px; background-color:{{ $color->color_code }}; color:transparent"></i></td> --}}
                        <td>
                            <a title="Delete" href="{{ route('color.remove',$color->id) }}" class="btn btn-danger shadow btn-xs sharp del_btn"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-haeader">
                <h3  class="m-auto">Add Color</h3>
            </div>
            <div class="card-body">
                @if (session('color'))
                    <div class="alert alert-info">{{ session('color') }}</div>
                @endif
                <form action="{{ route('color.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" name="color_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="text" name="color_code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-haeader">
                <h3  class="m-auto">Add Size</h3>
            </div>
            <div class="card-body">
                @if (session('size'))
                    <div class="alert alert-info">{{ session('size') }}</div>
                @endif
                <form action="{{ route('size.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Selected Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Size Name</label>
                        <input type="text" name="size_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
