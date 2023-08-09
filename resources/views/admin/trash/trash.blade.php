@extends('layouts.admin')

@section('content')
<div class="col-lg-8 m-auto">
  <form action="{{ route('restore.checked') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Trash Category List</h3>
        </div>
        @if (session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
        @endif
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkAll">
                            <label class="custom-control-label" for="checkAll">Check all</label>
                        </div>
                    </th>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Action</th>
                </tr>
                @forelse ($trash_category as $sl=>$category)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="custom-control-input" id="category{{ $category->id }}">
                            <label class="custom-control-label" for="category{{ $category->id }}"></label>
                        </div>
                    </td>
                    <td>{{ $sl+1 }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td><img  width="50" src="{{ asset('uploads/category/') }}/{{ $category->category_image }}"></td>
                    {{-- <td><img  width="50" src="{{ asset('uploads/caregory/'. $category->category_image)}}"></td> --}}
                    <td>
                        <div class="d-flex">
                            <a title="Replay" href="{{ route('category.restore',$category->id) }}" class="btn btn-primary shadow btn-xs sharp del_btn"><i class="fa fa-reply"></i></a>&nbsp;
                            <a title="Delete" href="{{ route('category.hard.delete',$category->id) }}" class="btn btn-danger shadow btn-xs sharp del_btn"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No Data Found</td>
                </tr>
                @endforelse
            </table>
            <button type="submit" class="btn btn-primary">Restore Checked</button>
            {{-- <a href="{{ route('category.restore.delete,$category_id') }}" type="submit" class="btn btn-danger">Restore Delete</a> --}}
            <a href=""type="submit" class="btn btn-danger">Restore Delete</i></a>
        </div>
    </div>
</form>
    </div>
@endsection

@section('footer_script')
<script>
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked',this.checked);
});
</script>
@endsection
