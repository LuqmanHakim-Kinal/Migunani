<!-- resources/views/pembayarans/edit.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <h2>Edit Pembayaran</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Pembayar -->
                    <div class="form-group">
                        <label for="penyewa_id">Penyewa:</label>
                        <input type="text" name="penyewa_id" id="penyewa_id" class="form-control"
                               value="{{ $pembayaran->penyewa->nama }}" readonly>
                    </div>

                    <!-- Tanggal Bayar -->
                    <div class="form-group">
                        <label for="tanggal_bayar">Tanggal Bayar:</label>
                        <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control"
                            value="{{ $pembayaran->tanggal_bayar }}" readonly>
                    </div>

                    <!-- Harga -->
                    <div class="form-group" hidden>
                        <label for="harga">Harga:</label>
                        <input type="text" name="harga" id="harga" class="form-control"
                            value="{{ $pembayaran->harga }}" readonly>
                    </div>
                    <!-- Jumlah Bulan -->
                    <div class="form-group" hidden>
                        <label for="harga">Lama Sewa:</label>
                        <input type="text" name="jumlah_bulan" id="jumlah_bulan" class="form-control"
                            value="{{ $pembayaran->jumlah_bulan }}" readonly>
                    </div>
                    <!-- File Upload -->
                    <div class="form-group">
                        <label for="files">Foto Nota:</label>
                        <input type="file" name="files" class="form-control-file">
                    </div>

                    <!-- Other fields as needed -->

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
