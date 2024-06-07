<!-- resources/views/keluhans/create.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <h2>Tambah Keluhan Baru</h2>
                <form action="{{ route('keluhans.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul Keluhan:</label>
                        <input type="text" name="judul" class="form-control" required minlength="4">
                    </div>
                    <div class="form-group">
                        <label for="penyewa_id">Pelapor: <span class="text-danger"> * </span></label>
                        <select name="penyewa_id" class="form-control" required>
                            <option value="" selected>Pilih Pelapor</option>
                            @foreach ($penyewas as $penyewa)
                                <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan: <span class="text-danger"> * </span></label>
                        <textarea name="keterangan" class="form-control" required minlength="8">{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pelaporan">Tanggal Pelaporan: <span class="text-danger"> * </span></label>
                        <input type="date" name="tanggal_pelaporan" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Keluhan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
