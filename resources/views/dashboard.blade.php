@extends('layouts.admin')
@section('content')

<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Admin Panel</h3>
        </div>
        <div class="card-header">
            <p>Welcome to,{{ Auth::user()->name }}</p>
        </div>
    </div>
</div>
@endsection();
