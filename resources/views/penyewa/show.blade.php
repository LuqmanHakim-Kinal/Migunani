<!-- resources/views/penyewa/show.blade.php -->
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
                    <p><strong>Kamar Di Tempati:</strong> {{ $penyewa->nomor_kamar }}</p>
                    <h4 class="mt-4">Histori Pembayaran</h4>
                    @if ($pembayarans->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Jumlah Bulan</th>
                                    <th>Status Bayar</th>
                                    <!-- Add more columns as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayarans as $index => $pembayaran)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pembayaran->tanggal_bayar }}</td>
                                        <td>{{ $pembayaran->jumlah_bulan }}</td>
                                        <td>{{ $pembayaran->status_bayar }}</td>
                                        <!-- Add more cells with data as needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center" style="margin-top: 10px; font-size: 0.75rem;">
                            {{ $pembayarans->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        <p>Tidak ada jejak pembayaran.</p>
                    @endif
                    <p><strong>Foto KTP:</strong></p>
                    <div class="row">
                        @foreach ($penyewa->pictures as $picture)
                            <div class="col-md-6 mb-3">
                                <img class="img-thumbnail" width="100" src="/uploads/ktp/{{ $picture->filename }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="/penyewa" class="btn mb-1 btn-secondary">Kembali ke Daftar</a>
                        <div>
                        <a href="/penyewa/{{$penyewa->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Bayar Sewa</a>
                        </div>
                    </div>
                    <div class="mt-3">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
