@extends('adminlte.master')

@section('tittle')
DATA MASTER MESIN
@endsection

@push('csstambahan')
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.css/') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('header-content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Mesin</h1>
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
<div class="col-md-12">
    <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Daftar Mesin</h3>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3" >
              <center>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                  Tambah Data
                </button>
              </center>
              <!-- <div class="card-body"> -->
              <form method="post" target="_blank" action="/users/print" id="form-kirim">
              @csrf
              
                <table id="example2"  class="table table-hover text-nowrap table-striped table-bordered">
                  <thead class="thead-info"> 
                    <tr>
                      <th width="5px"><input type="checkbox" id="check-all"></th>
                      <th scope="col" style="width: 10px">No</th>
                      <th scope="col" class="text-center">Jenis Mesin</th>
                      <th scope="col" class="text-center">Merk Mesin</th>
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">No Seri</th>
                      <th scope="col" class="text-center">Barcode Mesin</th>
                      <th scope="col" class="text-center">Kepemilikan</th>
                      <th scope="col" class="text-center">Status</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $no = 0
                    ?>
                    @forelse($master as $key => $mesin)
                        <tr>
                            <td class="text-center"><input type="checkbox" class="check-item" name="id[]" value="{{ $mesin->id }}"></td>
                            <td> {{  $no+=1 }}</td>
                            <td class="text-center" > {{ strtoupper($mesin->jenismesin->jenis_mesin) }}</td>
                            <td class="text-center" > {{ strtoupper($mesin->merkmesin->merk_mesin) }}</td>
                            <td class="text-center" > {{ strtoupper($mesin->type) }}</td>
                            <td class="text-center" > {{ strtoupper($mesin->no_seri) }}</td>
                            <td class="text-center" > {{ strtoupper($mesin->barcode_mesin) }}</td>
                            <td class="text-center" > {{ strtoupper($mesin->vendor->nama_vendor) }}</td>
                            <td class="text-center" > {{ strtoupper($mesin->status) }}</td>
                            <td style="width:10px; padding-top:6px; padding-bottom: 0px;" >
                                 <a data-id="{{ $mesin->id }}" data-toggle="modal" data-target="#myEdit" class="edit btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                              |  <a data-id="{{ $mesin->id }}" data-toggle="modal" data-target="#myShow" class="tampil btn btn-sm btn-warning"><i class="fa fa-eye"></i></a> 
                              |  <a href="/mastermesin/hapus/{{ $mesin->id }}" class="tombol-hapus btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 
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
                <a href="/users/excel" class="btn btn-sm btn-success"><i class="fa fa-file" aria-hidden="true"></i> EXPORT EXCEL</a> 
                </div>
               
              <!-- /.card-body -->
            </div>
             
            <!-- /.card -->

<!-- ===================================== // MODAL TAMBAH // ===================================== -->
<div class="modal fade" id="modal-default" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">TAMBAH DATA MESIN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" role="form"  action="/mastermesin" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                  <label for="jenismesin_id2">{{ __('Jenis Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                    </div>
                    <select name="jenismesin_id" id="jenismesin_id2" class="form-control select2bs4 @error('jenismesin_id') is-invalid @enderror" >
                      <option selected="">Tentukan Jenis Mesin</option>
                        @foreach($jenismesin as $key => $jm) 
                          <option value="{{ $jm->id }}" @if (old('jenismesin_id') == '{{ $jm->id }}') selected @endif>{{ strtoupper($jm->jenismesin) }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="merkmesin_id2">{{ __('Merk Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <select name="merkmesin_id" id="merkmesin_id2" class="form-control select2bs4 @error('merkmesin_id') is-invalid @enderror" id="merkmesin_id2" >
                      <option selected="">Tentukan Merk Mesin</option>
                        @foreach($merkmesin as $key => $mm) 
                          <option value="{{ $mm->id }}" @if (old('merkmesin_id') == '{{ $mm->id }}') selected @endif>{{ strtoupper($mm->merk_mesin) }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="type2">{{ __('Type Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                    </div>
                    <input id="type2" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" placeholder="{{ __('Type Mesin') }}" required autocomplete="type">
                  </div>
                        
                  </div>

                <div class="form-group">
                  <label for="noseri2">{{ __('No Seri') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tags"></i></span>
                    </div>
                    <input id="noseri2" type="text" class="form-control @error('no_seri') is-invalid @enderror" name="no_seri" placeholder="{{ __('No Seri') }}" required autocomplete="no_seri">
                  </div>
                  </div>

                  <div class="form-group">
                  <label for="vendor_id2">{{ __('Kepemilikan') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <select name="vendor_id" id="vendor_id2" class="form-control select2bs4 @error('vendor_id') is-invalid @enderror" required autocomplete="vendor_id">
                      <!-- <option selected="">--Kepemilikan -- </option> -->
                        @foreach($vendors as $key => $vendor) 
                          <option value="{{ $mm->id }}" @if (old('merkmesin_id') == '{{ $vendor->id }}') selected  @endif>{{ strtoupper($vendor->nama_vendor) }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="status2">{{ __('Status') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                      <select id="status2" name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="">== Pilih Status ==</option>
                        <option value="inhouse" @if (old('status') == 'inhouse') selected @endif >Inhouse</option>
                        <option value="dipinjamkan" @if (old('status') == 'dipinjamkan') selected @endif >Di Sewakan</option>
                        <option value="diservis" @if (old('status') == 'diservis') selected @endif>Di Servis</option>
                        <option value="rusak" @if (old('status') == 'rusak') selected @endif>Rusak</option>
                        <option value="rental" @if (old('status') == 'rental') selected @endif>Sewa</option>
                        <option value="dikembalikan" @if (old('status') == 'dikembalikan') selected @endif>Di Kembalikan</option>
                      </select>
                  </div>
                </div>
                
                <input id="barcodeuser2" type="hidden" class="form-control @error('barcode_user') is-invalid @enderror" name="barcode_user" value="{{ old('barcodeuser') }}" placeholder="Barcode User" autocomplete="barcodeuser" autofocus>
                  
                <div class="form-group">
                  <label for="photo">File Photo</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <!-- <label for="formFileSm" class="form-label">Small file input example</label> -->
                    <input class="form-control form-control" name="photo" id="formFileSm" type="file">
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
              </button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('#example2').DataTable( {
        
    } );
} );
</script>

<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
  });
 </script> 

 <script>
   $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
   });

 </script>
@endpush