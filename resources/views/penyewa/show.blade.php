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
                        <p>No payment history available.</p>
                    @endif
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
                <div class="bootstrap-modal">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalpopover">Bayar</button>
                    <!-- Modal -->
                    <div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="bayarModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bayarModalLabel">Bayar Sewa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Your payment form goes here -->
                                    <form action="{{ route('payment.store', $penyewa->id) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="waktu_sewa">Waktu Sewa (bulan)</label>
                                            <input type="number" class="form-control" id="waktu_sewa" name="waktu_sewa" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Bayar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
