    @extends('layouts.master')

    @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <h2>Tambah Barang Inventaris</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang:</label>
                            <input type="text" class="form-control"  name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_beli" class="form-label">Tanggal Beli:</label>
                            <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
                        </div>
                        <div class="mb-3">
                            <label for="tempat" class="form-label">Tempat/Letak:</label>
                            <select name="tempat" class="form-control" >
                                <option value="" selected>Pilih Tempat/Letak</option>
                                @foreach ($kamars as $kamar)
                                    <option value="{{ $kamar->nomor_kamar }}">{{ $kamar->nomor_kamar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi:</label>
                            <select class="form-control" id="kondisi" name="kondisi" required>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="files" class="form-label">Foto Barang:</label>
                            <input type="file" class="form-control-file" name="files[]" class="form-control-file" multiple">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
