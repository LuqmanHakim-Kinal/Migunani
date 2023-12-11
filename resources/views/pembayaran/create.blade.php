<!-- resources/views/pembayarans/create.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Pembayaran</h2>
        <form action="{{ route('pembayaran.store') }}" method="post">
            @csrf

            <!-- Nama Pembayar -->
            <div class="form-group">
                <label for="penyewa_id">Penyewa:</label>
                <select name="penyewa_id" class="form-control">
                    <option value="" selected>penyewa</option>
                    @foreach ($penyewas as $penyewa)
                        <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Tanggal Bayar -->
            <div class="form-group">
                <label for="tanggal_bayar">Tanggal Bayar:</label>
                <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control datepicker" >
            </div>
            <!-- Harga -->
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" name="harga" id="harga" class="form-control" >
            </div>
            <div class="form-group">
                <label for="files">Foto Nota:</label>
                <input type="file" name="files[]" class="form-control-file" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        flatpickr('.datepicker', {
            enableTime: false,
            dateFormat: 'Y-m-d',
        });
    </script>
@endsection
