@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h2>Daftar Keluhan</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Pelapor</th>
                                    <th>Status</th>
                                    <th>Tanggal Pelaporan</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keluhans as $keluhan)
                                    <tr>
                                        <td>{{ $keluhan->judul }}</td>
                                        <td>{{ $keluhan->penyewa->nama }}</td>
                                        <td>{{ $keluhan->status }}</td>
                                        <td>{{ $keluhan->tanggal_pelaporan }}</td>
                                        <td>{{ $keluhan->tanggal_selesai }}</td>
                                        <td>
                                            <a href="{{ route('keluhans.show', $keluhan->id) }}" class="btn btn-primary">Detail</a>
                                            <form action="{{route('keluhans.destroy', $keluhan->id) }}" method="POST">
                                                @method("DELETE")
                                                @csrf
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection