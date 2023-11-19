@extends('layouts.master')

@section('content')
    <style>
        .checkbox-group 
        {
            display: flex;
            flex-wrap: wrap;
        }

        .checkbox-group .form-check 
        {
            margin-right: 20px; /* Jarak antar checkbox */
        }

        .checkbox-group .form-check img 
        {
            max-width: 100px; /* Lebar maksimum gambar */
            height: auto;
            margin-bottom: 5px; /* Jarak antara gambar dan checkbox */
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
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
                        <h4 class="card-title">Edit Kamar</h4>
                        <form action="{{ route('kamars.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="status_kamar">Status:</label>
                                <input type="text" class="form-control" value="{{ $kamar->status }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="harga_kamar">Harga:</label>
                                <input type="number" name="harga_kamar" class="form-control" value="{{ $kamar->harga_kamar }}" required>
                            </div>
                            <div class="form-group">
                                <label for="penyewa_id">Penyewa:</label>
                                <select name="penyewa_id" class="form-control">
                                    <option value="" selected>Kamar Kosong(Isi Jika Ada Yang Sewa)</option>
                                    @foreach ($penyewas as $penyewa)
                                        <option value="{{ $penyewa->id }}" @if($kamar->penyewa_id == $penyewa->id) selected @endif>{{ $penyewa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="files">Tambah Gambar Kamar:</label>
                                <input type="file" name="files[]" class="form-control-file" multiple>
                            </div>
                            <div class="form-group">
                                <label for="files">Hapus Gambar Kamar:</label>
                                @foreach ($kamar->pictures as $picture)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="delete_files[]" value="{{ $picture->id }}">
                                        <label class="form-check-label">
                                            <img src="{{ asset('uploads/kamar/' . $picture->filename) }}" alt="Foto Penyewa" class="img-thumbnail">
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Update Room</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
