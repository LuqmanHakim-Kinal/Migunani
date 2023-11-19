<!-- resources/views/kamars/create.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
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
                        <form action="{{ route('kamars.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nomor_kamar">Nomor Kamar:</label>
                                <input type="text" name="nomor_kamar" class="form-control" required pattern="[A-Za-z0-9]+">
                                <!-- Add a pattern attribute to enforce alphanumeric characters -->
                            </div>
                            <!-- Remove the status_kamar input field -->
                            <div class="form-group">
                                <label for="harga_kamar">Harga:</label>
                                <input type="number" name="harga_kamar" class="form-control" required min="0">
                                <!-- Add a min attribute to enforce a non-negative value -->
                            </div>
                            <div class="form-group">
                                <label for="penyewa_id">Penyewa:</label>
                                <select name="penyewa_id" class="form-control">
                                    <option value="" selected>Kamar Kosong(Isi Jika Ada Yang Sewa)</option>
                                    @foreach ($penyewas as $penyewa)
                                        <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="files">Gambar Kamar:</label>
                                <input type="file" name="files[]" class="form-control-file" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Kamar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
