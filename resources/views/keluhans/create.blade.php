<!-- resources/views/keluhans/create.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Tambah Keluhan Baru</h2>
        <form action="{{ route('keluhans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul">Judul Keluhan:</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="penyewa_id">Pelapor:</label>
                <select name="penyewa_id" class="form-control" required>
                    <option value="" selected>Pilih Pelapor</option>
                    @foreach ($penyewas as $penyewa)
                        <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
            </div>
            <div class="form-group">
                <label for="tanggal_pelaporan">Tanggal Pelaporan:</label>
                <input type="date" name="tanggal_pelaporan" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Keluhan</button>
        </form>
    </div>
@endsection
