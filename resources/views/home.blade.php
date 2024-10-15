@extends('layouts.templates')
@section('content')
    <div class="jumbotron py-4 px-5">
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif

        <h1 class="display-4">
            Selamat Datang, {{ Auth::user()->name }} !
        </h1>
        <hr class="my-4">
        <p>Aplikasi ini digunakan hanya oleh pegawai administrator APOTEK. Digunkan untuk mengelola data obat,penyetokan,
            juga pembelian (kasir)</p>
    </div>
@endsection
