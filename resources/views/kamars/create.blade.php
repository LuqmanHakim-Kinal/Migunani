@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Kamar</h4>
                        <h9><span class="text-danger">* </span> wajib diisi</h9>
                        <form action="{{ route('kamars.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nomor_kamar">Nomor Kamar: <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_kamar" class="form-control" required pattern="[A-Za-z0-9]+" minlength="2" placeholder="Minimal 2 anggka">
                            </div>
                            <div class="form-group">
                                <label for="harga_kamar">Harga: <span class="text-danger">*</span></label>
                                <input type="number" name="harga_kamar" class="form-control" required min="100000">
                            </div>
                            <div class="form-group">
                                <label for="panjang_kamar">Luas Kamar: <span class="text-danger">*</span></label>
                                <input type="number" name="panjang_kamar" class="form-control" required min="2" placeholder="Panjang">
                                <input type="number" name="lebar_kamar" class="form-control" required min="2" placeholder="Lebar">
                            </div>
                            <div class="form-group">
                                <label for="penyewa_id">Penyewa:</label>
                                <select name="penyewa_id" class="form-control">
                                    <option value="" selected>Kamar Kosong (Isi Jika Ada Yang Sewa)</option>
                                    @foreach ($penyewas as $penyewa)
                                        <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="files">Gambar Kamar: <span class="text-danger">*</span></label>
                                <input type="file" name="files[]" class="form-control-file" multiple required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Kamar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
