@extends('adminlte.master')

@section('tittle')
DATA USERS PENGGUNA
@endsection

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
            <h1>Data Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <center>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
          CREATE USERS
        </button>
      </center>
    </section>
@endsection


@section('content')
<div class="row">
<div class="col-md-12">
    <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Daftar Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="margin-top: 14px">
              <!-- <div class="card-body"> -->
                <table id="example1" class="table table-hover text-nowrap table-striped table-bordered">
                  <thead class="thead-info"> 
                    <tr>
                      <th scope="col" style="width: 10px">No</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">NIK</th>
                      <th scope="col" class="text-center">Email</th>
                      <th scope="col" class="text-center">Level</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $no = 0
                    ?>
                    @forelse($users as $key => $user)
                        <tr>
                            <td> {{  $no+=1 }}</td>
                            <td class="text-center" > {{ strtoupper($user->name) }}</td>
                            <td class="text-center" > {{ strtoupper($user->nik) }}</td>
                            <td class="text-center" > {{ strtolower($user->email) }}</td>
                            <td class="text-center" > {{ strtoupper($user->level) }}</td>
                            <td style="width:10px; padding-top:6px; padding-bottom: 0px;" >
                                <!-- <center> -->
                                <!-- <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" ><i class="fa fa-edit"></i></button> -->
                              <a data-id="{{ $user->id }}" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a> 
                              | <form style="display: inline-block" action="/users/{{ $user->id }}" method="POST">
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
    </div>

<!-- Modal Edit Data data kelas-->
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
                  <label for="nama">{{ __('Full Name') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Full Name') }}" required autocomplete="name" autofocus>
                  </div>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="nik">{{ __('NIK') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Nomer Induk Karyawan" autocomplete="nik" autofocus>
                  </div>
                    @error('nik')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="email">{{ __('Email Address') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email">
                  </div>
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>

      
                <div class="form-group">
                  <label for="level">{{ __('Level') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                      <select id="level" name="level" class="form-control @error('level') is-invalid @enderror">
                        <option value="">== Pilih Level ==</option>
                        <option value="administrator" @if (old('level') == 'administrator') selected @endif >Adminstrator</option>
                        <option value="adm mekanik" @if (old('level') == 'adm mekanik') selected @endif >Adm Mekanik</option>
                        <option value="mekanik" @if (old('level') == 'mekanik') selected @endif>Mekanik</option>
                        <option value="supervisor" @if (old('level') == 'supervisor') selected @endif>Supervisor</option>
                        <option value="security" @if (old('level') == 'sucurity') selected @endif>Security</option>
                      </select>
                  </div>
                      @error('level')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>
                
                <input id="barcodeuser" type="hidden" class="form-control @error('barcode_user') is-invalid @enderror" name="barcode_user" value="{{ old('barcodeuser') }}" placeholder="Barcode User" autocomplete="barcodeuser" autofocus>
                  
                <div class="form-group">
                  <label for="photo">File Photo (Isi jika Anda ingin Mengganti Foto)</label>
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
        </div>
    </div>
</div>
</div>
<!-- Modal Edit data kelas-->
<!-- ===================================== // MODAL TAMBAH // ===================================== -->
<div class="modal fade" id="modal-default" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">TAMBAH DATA USER</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" role="form"  action="/users" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                  <label for="nama">{{ __('Full Name') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Full Name') }}" required autocomplete="name" autofocus>
                  </div>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="nik">{{ __('NIK') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Nomer Induk Karyawan" autocomplete="nik" autofocus>
                  </div>
                    @error('nik')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="email">{{ __('Email Address') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email">
                  </div>
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                  </div>

                <div class="form-group">
                  <label for="password">{{ __('Password') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
                  </div>
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>

                <div class="form-group">
                  <label for="password-confirm">{{ __('Password Confirm') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Password Confirm') }}" required autocomplete="new-password">
                  </div>
                  </div>

                <div class="form-group">
                  <label for="level">{{ __('Level') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                      <select id="level" name="level" class="form-control @error('level') is-invalid @enderror">
                        <option value="">== Pilih Level ==</option>
                        <option value="administrator" @if (old('level') == 'administrator') selected @endif >Adminstrator</option>
                        <option value="adm mekanik" @if (old('level') == 'adm mekanik') selected @endif >Adm Mekanik</option>
                        <option value="mekanik" @if (old('level') == 'mekanik') selected @endif>Mekanik</option>
                        <option value="supervisor" @if (old('level') == 'supervisor') selected @endif>Supervisor</option>
                        <option value="security" @if (old('level') == 'sucurity') selected @endif>Security</option>
                      </select>
                  </div>
                      @error('level')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>
                
                <input id="barcodeuser" type="hidden" class="form-control @error('barcode_user') is-invalid @enderror" name="barcode_user" value="{{ old('barcodeuser') }}" placeholder="Barcode User" autocomplete="barcodeuser" autofocus>
                  
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
<script src="{{ asset('/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

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

<script type="text/javascript">
  $('#name').keyup(function(){ 
    var name = $("#name").val();
    var nik = $("#nik").val();
    var namepot = name.substring(0, 2);
    var namepotbes = namepot.toUpperCase();
    var gabungan = namepotbes.concat(nik);
    $('#barcodeuser').val(gabungan);

    })

    $('#nik').keyup(function(){ 
    var name = $("#name").val();
    var nik = $("#nik").val();
    var namepot = name.substring(0, 2);
    var namepotbes = namepot.toUpperCase();
    var gabungan = namepotbes.concat(nik);
    $('#barcodeuser').val(gabungan);
    })
 </script>   
 
<script>
$(document).ready(function () {

$('body').on('click', '#edit', function (event) {

    event.preventDefault();
    var id = $(this).data('id');
    console.log(id)
    $.get('users/' + id + '/edit', function (data) {
         $('#id').val(data.data.id);
         $('#name').val(data.data.name);
         $('#nik').val(data.data.nik);
         $('#email').val(data.data.email);
         $('#barcodeuser').val(data.data.barcode_user);
         $('#level').val(data.data.level);
         $("#editform").attr("action","users/"+id);
     })
});

}); 
</script>
@endpush

