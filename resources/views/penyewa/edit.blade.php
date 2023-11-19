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
            <form method="POST" action="/penyewa/{{$penyewa->id  }}" enctype="multipart/form-data">
                @method('put')
                @csrf   
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama"value="{{$penyewa->nama}}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nomor Handphone</label>
                  <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Handphone" value ="{{$penyewa->no_hp}}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Alamat</label>
                  <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat" value="{{$penyewa->alamat}}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tanggal Masuk</label>
                  <input type="date" name="tanggal_masuk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tanggal Masuk"value="{{$penyewa->tanggal_masuk}}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tanggal Habis</label>
                  <input type="date" name="tanggal_selesai" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tanggal Habis" value="{{$penyewa->tanggal_selesai}}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Foto KTP</label>
                  <input name="files[]" multiple type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>  
      </div>
    </div>
</div>
@endsection