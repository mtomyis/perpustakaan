@extends('layout.v_layout')
@section('content')
<!--begin::Container-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            Hi {{ auth()->user()->name }}, Selamat datang di sistem informasi perpustakaan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $katalog_buku }}</h3>
                    <p>Jumlah Katalog Buku</p>
                </div>
                <!-- Book icon -->
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 4a2 2 0 0 0-2 2v13a1 1 0 0 0 1.555.832L10 17.118l4.445 2.714A1 1 0 0 0 16 19V6a2 2 0 0 0-2-2H6z"/>
                </svg>
            </div>
            <!--end::Small Box Widget 1-->
        </div>

        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 2-->
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $buku_dipinjam }}</h3>
                    <p>Jumlah Buku dipinjam</p>
                </div>
                <!-- Download/borrow icon -->
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 16l4-5h-3V4h-2v7H8l4 5zm-8 4h16v2H4v-2z"/>
                </svg>
            </div>
            <!--end::Small Box Widget 2-->
        </div>

        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 3-->
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $pengembalian }}</h3>
                    <p>Jumlah Pengembalian</p>
                </div>
                <!-- Upload/return icon -->
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 8l-4 5h3v7h2v-7h3l-4-5zM4 4h16v2H4V4z"/>
                </svg>
            </div>
            <!--end::Small Box Widget 3-->
        </div>

        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 4-->
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ $yang_meminjam }}</h3>
                    <p>Jumlah yang Meminjam Buku</p>
                </div>
                <!-- User/multiple people icon -->
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 2.01 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                </svg>
            </div>
            <!--end::Small Box Widget 4-->
        </div>
    </div>

</div>
<!--end::Container-->
@endsection