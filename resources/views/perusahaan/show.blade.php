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
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Perusahaan</h3>
              </div>
              <!-- /.card-header -->
              <br>
              <div class="card-body">
                    <center><h2>{{ $perusahaan->nama_perusahaan }}</h2></center>
                    Alamat : {{ $perusahaan->alamat }} <br>
                    Email : {{ $perusahaan->email }}<br>
                    No_telp : {{ $perusahaan->no_telp }}<br>
              </div>
            </div>
@endsection