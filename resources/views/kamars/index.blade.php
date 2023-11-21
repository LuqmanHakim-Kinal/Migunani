<!-- resources/views/kamars/index.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Room Data</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Room Number</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Luas Kamar</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kamars as $kamar)
                                        <tr>
                                            <td>{{ $kamar->nomor_kamar }}</td>
                                            <td>{{ $kamar->status_kamar }}</td>
                                            <td>Rp.{{ $kamar->harga_kamar }}</td>
                                            <td>{{ $kamar->panjang_kamar }}M X {{ $kamar->lebar_kamar}}M</td> 
                                            <td>
                                                <a href="{{ route('kamars.show', $kamar->id) }}" class="btn btn-info">View</a>
                                                <a href="{{ route('kamars.edit', $kamar->id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('kamars.destroy', $kamar->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this room?')">Delete</button>
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
