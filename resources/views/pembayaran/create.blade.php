<!-- resources/views/pembayarans/create.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <h2>Tambah Pembayaran</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('pembayaran.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Pembayar -->
                    <div class="form-group" >
                        <label for="penyewa_id">Penyewa:</label>
                        <select name="penyewa_id" class="form-control" >
                            <option value="" selected>Penyewa</option>
                            @foreach ($penyewas as $penyewa)
                                <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Tanggal Bayar -->
                    <div class="form-group">
                        <label for="tanggal_bayar">Tanggal Bayar:</label>
                        <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control datepicker">
                    </div>
                    
                    <div class="form-group">
                        <label for="jumlah_bulan">Lama Sewa:</label>
                        <input type="number" name="jumlah_bulan" id="jumlah_bulan" class="form-control" min="1">
                    </div>
                    <!-- Harga -->
                    <div class="form-group" hidden>
                        <label for="harga">Harga:</label>
                        <input type="text" name="harga" id="harga" class="form-control" readonly>
                    </div>

                    <!-- File Upload -->
                    <div class="form-group">
                        <label for="files">Foto Nota:</label>
                        <input type="file" name="files[]" class="form-control-file">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        flatpickr('.datepicker', {
            enableTime: false,
            dateFormat: 'Y-m-d',
        });

        // Update harga based on the selected penyewa
        document.querySelector('select[name="penyewa_id"]').addEventListener('change', function () {
            var penyewaId = this.value;
            var hargaElement = document.getElementById('harga');
            var selectedPenyewa = @json($penyewas->first()); // Change this to the default penyewa

            if (selectedPenyewa) {
                // Change this line according to your data structure
                var harga = selectedPenyewa.kamars.find(kamar => kamar.penyewa_id == penyewaId)?.harga_kamar;
                hargaElement.value = harga || '';
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function{
            alert('test');
        });
    </script>
@endsection
