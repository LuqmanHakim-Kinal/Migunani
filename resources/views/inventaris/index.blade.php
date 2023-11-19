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
                    <h4 class="card-title">Data Inventaris</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Beli</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Letak</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kondisi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto Barang</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->nama }}</td>
                        <td>{{ $inventory->tanggal_pembelian }}</td>
                        <td>{{ $inventory->nomor_kamar }}</td>
                        <td>{{ $inventory->kondisi }}</td>
                        <td>
                            @if ($inventory->pictures->isNotEmpty())
                                <img class="img-thumbnail" width="100" src="/uploads/inventory/{{ $inventory->pictures()->first()->filename }}" alt="">
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('inventaris.destroy', $inventory->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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