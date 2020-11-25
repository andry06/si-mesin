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
              <center><a class="btn btn-primary" href="/perusahaan/create">Create New Data</a></center>
              <div class="card-body">
                    @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                    @endif
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Perusahaan</th>
                      <th>Alamat</th>
                      <th>No Telp</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($perusahaan as $key => $pt)
                        <tr>
                            <td> {{ $key + 1 }}</td>
                            <td> {{ $pt->nama_perusahaan }}</td>
                            <td> {{ $pt->alamat }}</td>
                            <td> {{ $pt->no_telp }}</td>
                            <td> {{ $pt->email }}</td>
                            <td style="display: flex">
                              <a href="/perusahaan/{{ $pt->id }}" class="btn btn-sm btn-info">Show</a> | 
                              <a href="/perusahaan/{{ $pt->id }}/edit" class="btn btn-sm btn-success">Edit</a> | 
                              <form action="/perusahaan/{{ $pt->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                              </form>
                            </td>
                        </tr>
                    @empty
                       <tr>
                            <td colspan="5" align="center">No Post</td>
                       </tr>  
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
@endsection