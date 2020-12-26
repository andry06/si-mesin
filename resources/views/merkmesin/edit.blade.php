@extends('adminlte.master')

@push('csstambahan')
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('tittle')
DATA MERK MESIN
@endsection

@section('header-content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Merk Mesin</h1>
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
@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
<div class="row">

<div class="col-md-7">
    <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Daftar Merk Mesin</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="margin-top: 14px">
              <!-- <div class="card-body"> -->
                <table id="example2" class="table table-hover text-nowrap table-striped">
                  <thead class="thead-info"> 
                    <tr>
                      <th scope="col" style="width: 10px">No</th>
                      <th scope="col" class="text-center">Merk Mesin</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $no = 0
                    ?>
                    @forelse($merkmesin1 as $key => $mm)
                        <tr>
                            <td> {{  $no+=1 }}</td>
                            <td class="text-center" > {{ strtoupper($mm->merk_mesin) }}</td>
                            <td style="width:10px; padding-top:6px; padding-bottom: 0px;" >
                                <!-- <center> -->
                              <a href="/merkmesin/{{ $mm->id }}/edit" class="btn btn-sm btn-success">Edit</a> | 
                              <form style="display: inline-block" action="/merkmesin/{{ $mm->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input style="display: inline-block" type="submit" value="Delete" class="btn btn-sm btn-danger">
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
   
       
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">EDIT Data Merk Mesin </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form"  action="/merkmesin/{{ $merkmesin->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="merk_mesin">Merk Mesin</label>
                    <input name="merk_mesin" class="form-control" id="merk_mesin" value=" {{ old('merk_mesin', $merkmesin->merk_mesin)}}"  placeholder="Masukkan Merk Mesin">
                </div>
                @error('merk_mesin')
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
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<!-- <script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> -->

<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


@endpush

