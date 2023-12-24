@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Calon Penyewa</h4>
                    <div class="table-responsive">
                        <a href="/calonpenyewa/create" class="btn btn-primary">Tambah Calon Penyewa</a>
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Hp</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Masuk</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">dp</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">dp</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Isian table akan ditampilkan di sini -->
                                @foreach ($calonpenyewas as $calonpenyewa)
                                    <tr>
                                        <td>{{ $calonpenyewa->nama }}</td>
                                        <td>{{ $calonpenyewa->no_hp }}</td>
                                        <td>{{ $calonpenyewa->tanggal_masuk }}</td>
                                        <td>Rp.{{ $calonpenyewa->dp }}</td>
                                        <td>
                                            @if ($calonpenyewa->pictures->isNotEmpty())
                                              <img class="img-thumbnail" width="100" src="/uploads/calonpenyewa/{{$calonpenyewa->pictures()->first()->filename}}" alt="">
                                            @endif                      
                                          </td>
                                        <td>
                                            <a href="/calonpenyewa/{{$calonpenyewa->id}}/edit" class="btn btn-sm btn-warning">Sewa</a>
                                            <form action="/calonpenyewa/{{ $calonpenyewa->id }}" method="POST">
                                                @method("DELETE")
                                                @csrf
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</button>
                                            </form>
                                            <form action="{{ route('transferCalonPenyewaToPenyewa') }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Transfer Data</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <!-- Tambahan footer jika diperlukan -->
                            </tfoot>
                        </table>

                        <!-- Pagination links -->
                        <div class="d-flex justify-content-center" style="margin-top: 10px; font-size: 0.75rem;">
                            {{ $calonpenyewas->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
