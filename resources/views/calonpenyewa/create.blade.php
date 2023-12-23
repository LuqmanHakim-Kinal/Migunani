@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Tambah Data</h6>
        </div>
        <div class="card-body px-2 pt-0 pb-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="/calonpenyewa" enctype="multipart/form-data">
                @csrf   
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nomor Handphone</label>
                  <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Handphone">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tanggal Masuk</label>
                  <input type="date" name="tanggal_masuk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tanggal Masuk">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Jumlah DP</label>
                  <input type="text" name="dp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="dp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Foto dp</label>
                  <input name="files[]" multiple type="file" class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>  
      </div>
    </div>
</div>
@endsection