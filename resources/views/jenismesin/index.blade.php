@extends('adminlte.master')

@push('csstambahan')
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('header-content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jenis Mesin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Mesin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
<div class="row">
<div class="col-md-7">
    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Jenis Mesin</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <!-- <div class="card-body"> -->
                <table class="table table-hover text-nowrap table-striped">
                  <thead class="thead-info"> 
                    <tr>
                      <th scope="col" style="width: 10px">No</th>
                      <th scope="col" class="text-center">Jenis Mesin</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $no = 0
                    ?>
                    @forelse($jenismesin as $key => $jm)
                        <tr>
                            <td> {{  $no+=1 }}</td>
                            <td class="text-center" style="width: 70%"> {{ strtoupper($jm->jenis_mesin) }}</td>
                            <td style="display: flex; width: 10px; padding-top:6px; padding-bottom: 0px;" >
                                <!-- <center> -->
                              <a href="/jenismesin/{{ $jm->id }}/edit" class="btn btn-sm btn-success">Edit</a> | 
                              <form action="/jenismesin/{{ $jm->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                              </form>
                              <!-- </center> -->
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>
    
    <div class="col-md-5">
    <!-- /.card-start -->
   
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Jenis Mesin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form"  action="/jenismesin" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="jenis_mesin">Jenis Mesin</label>
                    <input name="jenis_mesin" class="form-control" id="jenis_mesin" value=" {{ old('jenis_mesin', '')}}"  placeholder="Masukkan Jenis Mesin">
                </div>
                @error('jenis_mesin')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
            <!-- /.card -->
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- <script src="{{ asset('/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush

