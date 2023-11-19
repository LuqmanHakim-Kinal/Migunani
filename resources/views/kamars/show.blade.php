<!-- resources/views/kamars/show.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Room Details</h4>
                        <p><strong>Room Number:</strong> {{ $kamar->nomor_kamar }}</p>
                        <p><strong>Status:</strong> {{ $kamar->status }}</p>
                        <p><strong>Price:</strong> {{ $kamar->harga_kamar }}</p>
                        <p><strong>Tenant:</strong> {{ $kamar->penyewa ? $kamar->penyewa->nama : 'Not Assigned' }}</p>
                        <p><strong>Pictures:</strong></p>
                        <div class="row">
                            @foreach ($kamar->pictures as $picture)
                                <div class="col-md-6 mb-3">
                                    <img src="{{ asset('uploads/kamar/' . $picture->filename) }}" alt="Foto Penyewa" class="img-thumbnail">
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('kamars.index') }}" class="btn btn-primary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
