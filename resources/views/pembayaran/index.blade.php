@extends('layouts.master')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>Daftar Pembayaran</h2>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Pembayar</th>
                    <th>Status Bayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Batas Bayar</th>
                    <th>Harga</th>
                    <th>Nota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->nama_pembayar }}</td>
                        <td>{{ $pembayaran->status_bayar }}</td>
                        <td>{{ $pembayaran->tanggal_bayar }}</td>
                        <td>{{ $pembayaran->batas_bayar }}</td>
                        <td>Rp.{{ $pembayaran->harga }}</td>
                        <td>
                            @if ($pembayaran->pictures->isNotEmpty() && file_exists(public_path('uploads/nota/' . $pembayaran->pictures->first()->filename)))
                                <a href="{{ route('pembayaran.show', $pembayaran->id) }}">
                                    <img class="img-thumbnail" width="100" src="/uploads/nota/{{ $pembayaran->pictures()->first()->filename }}" alt="Nota Image">
                                </a>
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="btn mb-1 btn-primary">Bayar</a>
                            <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
