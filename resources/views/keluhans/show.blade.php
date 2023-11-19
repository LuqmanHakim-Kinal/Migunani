@extends('layouts.master')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>Detail Keluhan</h2>
        <p><strong>Judul:</strong> {{ $keluhan->judul }}</p>
        <p><strong>Pelapor:</strong> {{ $keluhan->penyewa->nama }}</p>
        <p><strong>Status:</strong> {{ $keluhan->status }}</p>
        <p><strong>Tanggal Pelaporan:</strong> {{ $keluhan->tanggal_pelaporan }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $keluhan->tanggal_selesai }}</p>
        <!-- Form untuk mengganti status dan tanggal selesai -->
        <form action="{{ route('keluhans.update', $keluhan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="Proses" {{ $keluhan->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ $keluhan->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ $keluhan->tanggal_selesai }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Keluhan</button>
        </form>

        <a href="{{ route('keluhans.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection