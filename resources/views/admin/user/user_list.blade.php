@extends('layouts.admin')

@section('content')
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card_header">
                <h3>User List</h3>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Photo</th>
                            <th>Action</th>

                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->photo == null)
                                        <img src="{{ Avatar::create($user->name)->toBase64() }}" width="50" />
                                    @else
                                        <img src="{{ asset('uploads/users/') }}/{{ $user->photo }}" width="50">
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button data-link="{{ route('user.remove',$user->id) }}" class="btn btn-danger shadow btn-xs sharp del_btn"><i
                                                class="fa fa-trash"></i></button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_script')
    <script>
        $('.del_btn').click(function() {
            var link=$(this).attr('data-llink') ;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href=link
                }
            })
        })
    </script>
@endsection
