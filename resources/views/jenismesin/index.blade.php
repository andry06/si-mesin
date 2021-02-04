@extends('adminlte.master')

@section('tittle')
DATA JENIS MESIN
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
              <li class="breadcrumb-item active">Jenis Mesin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

@error('kode_number')
  <?php Alert::error('Problem Kode Number', $message); ?>
@enderror

@error('jenis_mesin')
  <?php Alert::error('Problem Jenis Mesin', $message); ?>
@enderror


<div class="col-md-12">
    <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Daftar Jenis Mesin</h3>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3" >
              <center>
                <button type="button" class="btn btn-success" id="tambah" data-toggle="modal" data-target="#modal-default">
                  Tambah Data
                </button>
              </center>
                <table id="example2"  class="table table-hover text-nowrap table-striped table-bordered">
                  <thead class="thead-info"> 
                    <tr>
                      <th scope="col" style="width: 10px">No</th>
                      <th scope="col" class="text-center">Kode Number</th>
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
                            <td class="text-center" > {{ strtoupper($jm->kode_number) }}</td>
                            <td class="text-center" > {{ strtoupper($jm->jenis_mesin) }}</td>
                            <td style="width:10px; padding-top:6px; padding-bottom: 0px;" >
                                 <a data-id="{{ $jm->id }}" data-toggle="modal" data-target="#myEdit" class="edit btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                              |  <a href="/jenismesin/hapus/{{ $jm->id }}" class="tombol-hapus btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 
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
                <a href="/jenismesin/excel" class="btn btn-sm btn-success"><i class="fa fa-file" aria-hidden="true"></i> EXPORT EXCEL</a> 
                | 
                 <a href="/jenismesin/printdata" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file" aria-hidden="true"></i> PRINT DATA</a>
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
                  <label for="kode_number">{{ __('Kode Number') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-info"></i></span>
                    </div>
                    <input id="kode_number" type="text" class="form-control @error('kode_number') is-invalid @enderror" value="{{ old('kode_number') }}" placeholder="{{ __('Kode Number') }}" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label for="jenis_mesin">{{ __('Jenis Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="jenis_mesin" type="text" class="form-control @error('jenis_mesin') is-invalid @enderror" name="jenis_mesin" value="{{ old('jenis_mesin') }}" placeholder="{{ __('Jenis Mesin') }}" required autocomplete="jenis_mesin" autofocus>
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
              <h4 class="modal-title">TAMBAH JENIS MESIN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" role="form"  action="/jenismesin" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                  <label for="kode_number2">{{ __('Kode Number') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-info"></i></span>
                    </div>
                    <input id="kode_number2" disabled type="text" class="form-control @error('kode_number') is-invalid @enderror"  value="{{ old('kode_number') }}" placeholder="{{ __('Kode Number') }}" >
                    <input type="hidden" name="kode_number" id="kode_number3">
                  </div> 
                  </div>

                <div class="form-group">
                  <label for="jenis_mesin2">{{ __('Jenis Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="jenis_mesin2" type="text" class="form-control @error('jenis_mesin') is-invalid @enderror" name="jenis_mesin" value="{{ old('jenis_mesin') }}" placeholder="{{ __('Jenis Mesin') }}" required autocomplete="jenis_mesin">
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
    $.get('jenismesin/' + id + '/edit', function (data) {
        var jenismesinbesar = data.data.jenis_mesin;
        var kode_number = data.data.kode_number;
         $('#kode_number').val(kode_number);
         $('#jenis_mesin').val(jenismesinbesar);
         $("#editform").attr("action","jenismesin/"+id);
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

<script type="text/javascript">
  $('#tambah').click(function(){ 
    $.get('jenismesin/number', function (data) {
        var kodenumber = data.data;
        $('#kode_number2').val(kodenumber);
        $('#kode_number3').val(kodenumber);
     });
    
    });
 </script>
@endpush