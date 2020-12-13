@extends('adminlte.master')

@section('header-content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perusahaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Perusahaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
<!-- Horizontal Form -->
<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Input Data Nama Perusahaan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" class="form-horizontal" action="/perusahaan" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="nama_perusahaan" class="col-sm-2 col-form-label">Jenis Mesin</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama_perusahaan" value=" {{ old('jenis_mesin', '')}} " class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan">
                         @error('jenis_mesin')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat Perusahaan</label>
                    <div class="col-sm-10">
                      <input type="alamat" name="alamat" value=" {{ old('alamat', '')}} " class="form-control" id="alamat" placeholder="Alamat Perusahaan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_telp" class="col-sm-2 col-form-label">No Telp Perusahaan</label>
                    <div class="col-sm-10">
                      <input type="no_telp" name="no_telp" value=" {{ old('no_telp', '')}} " class="form-control" id="no_telp" placeholder="No Telp Perusahaan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email Perusahaan</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" value=" {{ old('email', '')}} " class="form-control" id="inputEmail3" placeholder="Email Perusahaan">
                       @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
@endsection