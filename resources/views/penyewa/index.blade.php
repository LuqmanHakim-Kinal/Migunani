@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Penyewa</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Hp</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Masuk-Selesai</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto KTP</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Isian table akan ditampilkan di sini -->
                                @foreach ($penyewas as $penyewa)
                                    <tr>
                                        <td>{{ $penyewa->nama }}</td>
                                        <td>{{ $penyewa->no_hp }}</td>
                                        <td>{{ $penyewa->alamat }}</td>
                                        <td>{{ $penyewa->tanggal_masuk }} - {{ $penyewa->tanggal_selesai }}</td>
                                        <td>
                                            @if ($penyewa->pictures->isNotEmpty())
                                              <img class="img-thumbnail" width="100" src="/uploads/ktp/{{$penyewa->pictures()->first()->filename}}" alt="">
                                            @endif                      
                                          </td>
                                        <td>
                                            <a href="{{ route('penyewa.show', $penyewa->id) }}" class="btn btn-info">View</a>
                                            <form action="/penyewa/{{ $penyewa->id }}" method="POST">
                                                @method("DELETE")
                                                @csrf
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Habis</button>
                                            </form>
                                            

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <!-- Tambahan footer jika diperlukan -->
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
