@extends('adminlte.master')

@section('tittle')
DATA VENDOR
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
            <h1>Data Vendor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Vendor</li>
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
                <h3 class="card-title">Daftar Vendor</h3>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3" >
              <center>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                  Tambah Data
                </button>
              </center>
              <!-- <div class="card-body"> -->
                <table id="example2"  class="table table-hover text-nowrap table-striped table-bordered">
                  <thead class="thead-info"> 
                    <tr>
                      <th scope="col" style="width: 10px">No</th>
                      <th scope="col" class="text-center">Nama Vendor</th>
                      <th scope="col" class="text-center">Alamat</th>
                      <th scope="col" class="text-center">Negara</th>
                      <th scope="col" class="text-center">No Telp</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $no = 0
                    ?>
                    @forelse($vendors as $key => $vendor)
                        <tr>
                            <td> {{  $no+=1 }}</td>
                            <td class="text-center" > {{ strtoupper($vendor->nama_vendor) }}</td>
                            <td class="text-center" > {{ strtoupper($vendor->alamat) }}</td>
                            <td class="text-center" > {{ strtoupper($vendor->negara) }}</td>
                            <td class="text-center" > {{ strtoupper($vendor->no_telp) }}</td>
                            <td style="width:10px; padding-top:6px; padding-bottom: 0px;" >
                                 <a data-id="{{ $vendor->id }}" data-toggle="modal" data-target="#myEdit" class="edit btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                              |  <a href="/vendors/hapus/{{ $vendor->id }}" class="tombol-hapus btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 
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
                <a href="/vendors/excel" class="btn btn-sm btn-success"><i class="fa fa-file" aria-hidden="true"></i> EXPORT EXCEL</a> 
                | 
                 <a href="/vendors/printdata" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file" aria-hidden="true"></i> PRINT DATA</a>
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
                  <label for="nama_vendor">{{ __('Nama Vendor') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="nama_vendor" type="text" class="form-control @error('nama_vendor') is-invalid @enderror" name="nama_vendor" value="{{ old('nama_vendor') }}" placeholder="{{ __('Nama Vendor') }}" required autocomplete="nama_vendor" autofocus>
                  </div>
                </div>

                <div class="form-group">
                  <label for="alamat">{{ __('Alamat') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat" autocomplete="alamat" autofocus>
                  </div>
                </div>

                <div class="form-group">
                  <label for="negara">{{ __('Negara') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-flag"></i></span>
                    </div>
                    <input id="negara" type="text" class="form-control @error('negara') is-invalid @enderror" name="negara" value="{{ old('negara') }}" placeholder="{{ __('Negara') }}" required autocomplete="negara">
                  </div>
                </div>

                <div class="form-group">
                  <label for="no_telp">{{ __('No Telp') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-flag"></i></span>
                    </div>
                    <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" placeholder="{{ __('No Telp') }}" required autocomplete="no_telp">
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
              <h4 class="modal-title">TAMBAH DATA VENDOR</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" role="form"  action="/vendors" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                  <label for="nama_vendor">{{ __('Nama Vendor') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="nama_vendor2" type="text" class="form-control @error('nama_vendor') is-invalid @enderror" name="nama_vendor" value="{{ old('nama_vendor') }}" placeholder="{{ __('Nama Vendor') }}" required autocomplete="nama_vendor">
                  </div> 
                  </div>

                <div class="form-group">
                  <label for="alamat2">{{ __('Alamat') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input id="alamat2" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="{{ __('Alamat') }}" required autocomplete="alamat">
                  </div>
                  </div>

                  <div class="form-group">
                  <label for="negara2">{{ __('Negara') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-flag"></i></span>
                    </div>
                    <input id="negara2" type="text" class="form-control @error('negara') is-invalid @enderror" name="negara" placeholder="{{ __('Negara') }}" required autocomplete="negara">
                  </div>
                  </div>

                  <div class="form-group">
                  <label for="no_telp2">{{ __('No Telp') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input id="no_telp2" type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" placeholder="{{ __('No Telp') }}" required autocomplete="no_telp">
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
    $.get('vendors/' + id + '/edit', function (data) {
        var nama = data.data.nama_vendor;
        var namabesar = nama.toUpperCase();
        var alamat = data.data.alamat;
        var alamatbesar = alamat.toUpperCase();
        var negara = data.data.negara;
        var negarabesar = negara.toUpperCase();
        var notelp = data.data.no_telp;
        var notelpbesar = notelp.toUpperCase();
         $('#id').val(data.data.id);
         $('#nama_vendor').val(namabesar);
         $('#alamat').val(alamatbesar);
         $('#negara').val(negarabesar);
         $('#no_telp').val(notelpbesar);
         $("#editform").attr("action","vendors/"+id);
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
          console.log(href);
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