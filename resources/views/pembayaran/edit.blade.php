<!-- resources/views/pembayarans/edit.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Edit Pembayaran</h2>
        <form action="{{ route('pembayarans.update', $pembayaran->id) }}" method="post">
            @csrf
            @method('PUT')

            <!-- Nama Pembayar -->
            <div class="form-group">
                <label for="nama_pembayar">Nama Pembayar:</label>
                <input type="text" name="nama_pembayar" id="nama_pembayar" class="form-control" value="{{ $pembayaran->nama_pembayar }}" required>
            </div>

            <!-- Status Bayar -->
            <div class="form-group">
                <label for="status_bayar">Status Bayar:</label>
                <select name="status_bayar" id="status_bayar" class="form-control" required>
                    <option value="Belum Bayar" {{ $pembayaran->status_bayar == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="Lunas" {{ $pembayaran->status_bayar == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <!-- Add other status options if needed -->
                </select>
            </div>

            <!-- Tanggal Bayar -->
            <div class="form-group">
                <label for="tanggal_bayar">Tanggal Bayar:</label>
                <input type="text" name="tanggal_bayar" id="tanggal_bayar" class="form-control datepicker" value="{{ $pembayaran->tanggal_bayar }}" required>
            </div>

            <!-- Batas Bayar -->
            <div class="form-group">
                <label for="batas_bayar">Batas Bayar:</label>
                <input type="text" name="batas_bayar" id="batas_bayar" class="form-control datepicker" value="{{ $pembayaran->batas_bayar }}" required>
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" name="harga" id="harga" class="form-control" value="{{ $pembayaran->harga }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        flatpickr('.datepicker', {
            enableTime: false,
            dateFormat: 'Y-m-d',
        });
    </script>
@endsection
