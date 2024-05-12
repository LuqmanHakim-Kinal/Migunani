@extends('layouts.master')

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <h2>Tambah Data</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="/penyewa" enctype="multipart/form-data" onsubmit="return checkDates()">
                @csrf   
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama" required minlength="8">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nomor Handphone</label>
                  <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Handphone" required minlength="10">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Alamat Asal</label>
                  <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tanggal Masuk</label>
                  <input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" aria-describedby="emailHelp" placeholder="Tanggal Masuk" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tanggal Habis</label>
                  <input type="date" name="tanggal_selesai" class="form-control" id="tanggal_selesai" aria-describedby="emailHelp" placeholder="Tanggal Habis" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="form-label">Foto KTP</label>
                  <input name="files[]" multiple type="file" class="form-control-file" >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>  
      </div>
    </div>
</div>
</div>
<script>
  function checkDates() {
      var tanggalMasuk = document.getElementById("tanggal_masuk").value;
      var tanggalSelesai = document.getElementById("tanggal_selesai").value;

      if (tanggalMasuk > tanggalSelesai) {
          alert("Tanggal Masuk tidak boleh lebih besar dari Tanggal Habis");
          document.getElementById("tanggal_masuk").value = "";
          document.getElementById("tanggal_selesai").value = "";
          return false;
      }

      if (tanggalSelesai < tanggalMasuk) {
          alert("Tanggal Selesai tidak boleh kurang dari Tanggal Masuk");
          document.getElementById("tanggal_masuk").value = "";
          document.getElementById("tanggal_selesai").value = "";
          return false;
      }

      return true;
  }
</script>
@endsection
