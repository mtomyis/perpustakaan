@extends('layout.v_layout')
@section('content')
<!--begin::Container-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        Hi {{ auth()->user()->name }}, Selamat datang di sistem informasi perpustakaan
        </div>
    </div>
</div>
<!--end::Container-->
@endsection