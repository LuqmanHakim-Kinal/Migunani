<!-- resources/views/penyewas/show.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi Penyewa</h4>   
                <p><strong>Nama:</strong> {{ $penyewa->nama }}</p>
                <p><strong>Nomor Handphone:</strong> {{ $penyewa->no_hp }}</p>
                <p><strong>Alamat:</strong> {{ $penyewa->alamat }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $penyewa->tanggal_masuk }}</p>
                <p><strong>Tanggal Habis:</strong> {{ $penyewa->tanggal_selesai }}</p>

                <p><strong>Foto KTP:</strong></p>
                <div class="row">
                    @foreach ($penyewa->pictures as $picture)
                        <div class="col-md-6 mb-3">
                            <img class="img-thumbnail" width="100" src="/uploads/ktp/{{$penyewa->pictures()->first()->filename}}" alt="">
                        </div>
                    @endforeach
                </div>
                <a href="/penyewa.index" class="btn btn-primary">Kembali ke Daftar</a>
                <a href="/penyewa/{{$penyewa->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                <a href="#" class="btn btn-primary">Bayar</a>
            </div>
        </div>
    </div>
</div>
@endsection
