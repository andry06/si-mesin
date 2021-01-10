@extends('adminlte.master')

@section('tittle')
DATA MERK MESIN
@endsection

@push('csstambahan')
<link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.css/') }}">
@endpush

@section('header-content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Merk Mesin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Merk Mesin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

@error('nama_vendor')
  <?php Alert::error('Problem Nama Vendor', $message); ?>
@enderror

@error('negara')
  <?php Alert::error('Problem Negara', $message); ?>
@enderror

@error('no_telp')
    <?php Alert::error('Problem No-Telp', $message); ?>
@enderror

<div class="col-md-12">
    <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Daftar Merk Mesin</h3>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3" >
              <center>
                <button type="button" class="btn btn-success" id="tambah" data-toggle="modal" data-target="#modal-default">
                  Tambah Data
                </button>
              </center>
              <!-- <div class="card-body"> -->
                <table id="example2"  class="table table-hover text-nowrap table-striped table-bordered">
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
                    @forelse($merkmesin as $key => $mm)
                        <tr>
                            <td class="text-center" > {{  $no+=1 }}</td>
                            <td class="text-center" > {{ strtoupper($mm->merk_mesin) }}</td>
                            <td style="width:10px; padding-top:6px; padding-bottom: 0px;" >
                                 <a data-id="{{ $mm->id }}" data-toggle="modal" data-target="#myEdit" class="edit btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                              |  <a href="/merkmesin/hapus/{{ $mm->id }}" class="tombol-hapus btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 
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
                <br>
                <a href="/merkmesin/excel" class="btn btn-sm btn-success"><i class="fa fa-file" aria-hidden="true"></i> EXPORT EXCEL</a> 
                | 
                 <a href="/merkmesin/printdata" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file" aria-hidden="true"></i> PRINT DATA</a>
                </div>
               
              <!-- /.card-body -->
            </div>
             
            <!-- /.card -->

<!-- Modal Edit Data data -->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">EDIT DATA USER</h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
              <form method="POST" role="form"  id="editform" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                <div class="form-group">
                  <label for="merk_mesin">{{ __('Merk Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="merk_mesin" type="text" class="form-control @error('merk_mesin') is-invalid @enderror" name="merk_mesin" value="{{ old('merk_mesin') }}" placeholder="{{ __('Merk Mesin') }}" required autocomplete="merk_mesin" autofocus>
                  </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
              </button>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
</div>
<!-- Modal Edit data -->


<!-- ===================================== // MODAL TAMBAH // ===================================== -->
<div class="modal fade" id="modal-default" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">TAMBAH MERK MESIN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" role="form"  action="/merkmesin" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                  <label for="merk_mesin2">{{ __('MERK Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="merk_mesin2" type="text" class="form-control @error('merk_mesin') is-invalid @enderror" name="merk_mesin" value="{{ old('merk_mesin') }}" placeholder="{{ __('Merk Mesin') }}" required autocomplete="merk_mesin">
                  </div> 
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
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
<script src="{{ asset('/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('#example2').DataTable( {
        
    } );
} );
</script>

<script>
$(document).ready(function () {
$('body').on('click', '.edit', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.get('merkmesin/' + id + '/edit', function (data) {
         $('#merk_mesin').val(data.data.merk_mesin);
         $("#editform").attr("action","merkmesin/"+id);
     })
});
}); 
</script>

<!-- fungsi SweetAlert -->
<script>
      $(document).ready(function(){
        $('.tombol-hapus').on('click', function (e){
          e.preventDefault();
          var href =  $(this).attr('href');
          Swal.fire({
              title: 'Apakah Yakin Ingin Menghapus?',
              text: "Data User Ini!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus Ini!'
            }).then((result) => {
              if (result.isConfirmed) {
                document.location.href = href;
              }
            })
          })
      })
    </script>

@endpush