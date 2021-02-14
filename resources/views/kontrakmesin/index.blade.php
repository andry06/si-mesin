@extends('adminlte.master')

@section('tittle')
DATA KONTRAK
@endsection

@push('csstambahan')
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.css/') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.css/') }}">
@endpush

@section('header-content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kontrak</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Transaction</a></li>
              <li class="breadcrumb-item active">Kontrak</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

@error('no_kontrak')
  <?php Alert::error('Problem No Kontrak', $message); ?>
@enderror

@error('vendor_id')
    <?php Alert::error('Problem Vendor', $message); ?>
@enderror

@error('tgl_awal_kontrak')
  <?php Alert::error('Problem Tgl Awal Kontrak', $message); ?>
@enderror

@error('tgl_jatuh_tempo')
    <?php Alert::error('Problem Tgl Jatuh Tempo', $message); ?>
@enderror

@error('keterangan')
    <?php Alert::error('Problem Keterangan', $message); ?>
@enderror

@error('status')
    <?php Alert::error('Problem Status', $message); ?>
@enderror


<div class="col-md-12">
    <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Daftar Kontrak</h3>
              </div>
              <br>
              <center>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">
                  Tambah Data
                </button>
              </center>
            <div style="padding: 20px">
              <h5><b>Filter Data : </b></h5>
                <div class="row">
                <div class="col-sm-3">
                <label for="filtertahun">Tahun Kontrak</label>
                  <div class="input-group">
                  <select id="filtertahun" class="filter form-control select2bs4" >
                        <Option value="">Tahun Kontrak</Option>
                        @foreach($tahunkontrak as $key => $tk) 
                          <option value="{{ $tk->tahun }}" >{{ strtoupper($tk->tahun) }}</option>
                        @endforeach
                    </select>
                  </select>
                  </div>
                </div>
                <div class="col-sm-3">
                <label for="filterketerangan">Keterangan</label>
                  <div class="input-group">
                  <select id="filterketerangan" class="filter form-control">
                    <option value="">Pilih Keterangan</option>
                    <option value="menyewakan">Menyewakan </option>
                    <option value="rental">Rental</option>
                  </select>
                  </div>
                </div>
                <div class="col-sm-3">
                <label for="filtervendor_id">Vendor</label>
                  <div class="input-group">
                      <select id="filtervendor_id" class="filter form-control select2bs4 @error('vendor_id') is-invalid @enderror" autocomplete="vendor_id">
                        <option value="">Semua Vendor</option>
                          @foreach($vendors as $key => $vendor) 
                            <option value="{{ $vendor->id }}" >{{ strtoupper($vendor->nama_vendor) }}</option>
                          @endforeach
                      </select>
                  </select>
                  </div>
                </div>
                <div class="col-sm-3">
                <label for="filterstatus">Status</label>
                  <div class="input-group">
                        <select id="filterstatus" class="filter form-control @error('status') is-invalid @enderror">
                        <option value="">Semua Status Kontrak</option>
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                      </select>
                  </select>
                  </div>
                </div>
              </div>
              </div>
            <div class="card-body table-responsive p-3" >  
              <!-- <div class="card-body"> -->
             
                <table id="table" width="100%" style="font-size: 0.9rem" class="table table-hover text-nowrap table-striped table-bordered">
                  <thead class="thead-info"> 
                    <tr>
                      <th scope="col" class="text-center">No Kontrak</th>
                      <th scope="col" class="text-center">Nama Vendor</th>
                      <th scope="col" class="text-center">Tgl Awal Kontrak</th>
                      <th scope="col" class="text-center">Tgl Jatuh Tempo</th>
                      <th scope="col" class="text-center">Keterangan </th>
                      <th scope="col" class="text-center">Status</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>

                <table>
                  <tr>
                      <form method="post" id="form-excel">
                        @csrf
                        <input type="hidden" name="filtertahun" id="hasiltahun">
                        <input type="hidden" name="filterketerangan" id="hasilketerangan">
                        <input type="hidden" name="filtervendor_id" id="hasilvendor_id">
                        <input type="hidden" name="filterstatus" id="hasilstatus">
                    <td><button id="btn-print" type="submit" class="btn btn-sm btn-info"><i class="fa fa-print" aria-hidden="true"></i> PRINT DATA</button> </td>
                    <td> | </td>
                    <td><button id="btn-excel" type="submit" class="btn btn-sm btn-success"><i class="fa fa-file" aria-hidden="true"></i> EXPORT EXCEL</button>
                    </form>
                    </td>
                  </tr>
                </table> 
              </div>
              
              <!-- /.card-body -->
            </div>
          </div> 
            <!-- /.card -->
      </div>

<!-- Modal tambah Data  -->
<div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">CREATE DATA KONTRAK</h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
              <form method="POST" role="form"  action="/kontrakmesin"  enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                  <label for="no_kontrak">{{ __('No Kontrak') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                    </div>
                    <input id="no_kontrak" type="text" class="form-control @error('type') is-invalid @enderror" name="no_kontrak" value="{{ old('no_kontrak') }}" placeholder="{{ __('No Kontrak') }}" required autocomplete="no_kontrak">
                  </div>
                </div>

                <div class="form-group">
                  <label for="vendor_id">{{ __('Nama Vendor') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-university"></i></span>
                    </div>
                    <select name="vendor_id" id="vendor_id" class="form-control select2bs4 @error('vendor_id') is-invalid @enderror" required autocomplete="vendor_id">
                      <option selected="">Nama Vendor</option>
                        @foreach($vendors as $key => $vendor) 
                          <option value="{{ $vendor->id }}" @if (old('vendor_id') == '{{ $vendor->id }}') selected  @endif>{{ strtoupper($vendor->nama_vendor) }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tgl_awal_kontrak">{{ __('Tgl Awal Kontrak') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                    </div>
                    <input id="tgl_awal_kontrak" type="date" class="form-control @error('type') is-invalid @enderror" name="tgl_awal_kontrak" value="{{ old('tgl_awal_kontrak') }}" placeholder="{{ __('Tanggal Awal Kontrak') }}" required autocomplete="tgl_awal_kontrak">
                  </div>
                </div>

                <div class="form-group">
                  <label for="tgl_jatuh_tempo">{{ __('Tgl Jatuh Tempo') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                    </div>
                    <input id="tgl_jatuh_tempo" type="date" class="form-control @error('tgl_jatuh_tempo') is-invalid @enderror" name="tgl_jatuh_tempo" value="{{ old('tgl_jatuh_tempo') }}" placeholder="{{ __('Tanggal Jatuh Tempo') }}" required autocomplete="tgl_awal_kontrak">
                  </div>
                </div>

                <div class="form-group">
                  <label for="keterangan">{{ __('Keterangan') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                    </div>
                    <select id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                        <option value="">Keterangan</option>
                        <option value="menyewakan" @if (old('status') == 'menyewakan') selected @endif >Menyewakan</option>
                        <option value="rental" @if (old('status') == 'rental') selected @endif >Rental</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="status">{{ __('Status') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                      <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="open" @if (old('status') == 'open') selected @endif >Open</option>
                        <option value="close" @if (old('status') == 'close') selected @endif >Close</option>
                      </select>
                  </div>
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
<!-- Modal tambah data -->


<!-- Modal Edit Data data -->
<div id="myEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">EDIT DATA MESIN</h4>
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
                  <label for="no_kontrak2">{{ __('No Kontrak') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                    </div>
                    <input id="no_kontrak2" type="text" class="form-control @error('type') is-invalid @enderror" name="no_kontrak" value="{{ old('no_kontrak') }}" placeholder="{{ __('No Kontrak') }}" required autocomplete="no_kontrak">
                  </div>
                </div>

                <div class="form-group">
                  <label for="vendor_id2">{{ __('Nama Vendor') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-university"></i></span>
                    </div>
                    <select name="vendor_id" id="vendor_id2" class="form-control select2bs4 @error('vendor_id') is-invalid @enderror" required autocomplete="vendor_id">
                      <option selected="">Nama Vendor</option>
                        @foreach($vendors as $key => $vendor) 
                          <option value="{{ $vendor->id }}" @if (old('vendor_id') == '{{ $vendor->id }}') selected  @endif>{{ strtoupper($vendor->nama_vendor) }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tgl_awal_kontrak2">{{ __('Tgl Awal Kontrak') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                    </div>
                    <input id="tgl_awal_kontrak2" type="date" class="form-control @error('type') is-invalid @enderror" name="tgl_awal_kontrak" value="{{ old('tgl_awal_kontrak') }}" placeholder="{{ __('Tanggal Awal Kontrak') }}" required autocomplete="tgl_awal_kontrak">
                  </div>
                </div>

                <div class="form-group">
                  <label for="tgl_jatuh_tempo2">{{ __('Tgl Jatuh Tempo') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                    </div>
                    <input id="tgl_jatuh_tempo2" type="date" class="form-control @error('tgl_jatuh_tempo') is-invalid @enderror" name="tgl_jatuh_tempo" value="{{ old('tgl_jatuh_tempo') }}" placeholder="{{ __('Tanggal Jatuh Tempo') }}" required autocomplete="tgl_awal_kontrak">
                  </div>
                </div>

                <div class="form-group">
                  <label for="keterangan2">{{ __('Keterangan') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                    </div>
                    <select id="keterangan2" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                        <option value="menyewakan" @if (old('status') == 'menyewakan') selected @endif >Menyewakan</option>
                        <option value="rental" @if (old('status') == 'rental') selected @endif >Rental</option>
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
                        <option value="open" @if (old('status') == 'open') selected @endif >Open</option>
                        <option value="close" @if (old('status') == 'close') selected @endif >Close</option>
                      </select>
                  </div>
                </div>
                </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
        </div>

      </div>
    </div>
  </div>
  </div>
</div>
<!-- Modal Edit data -->
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
<script src="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
  let list_kontrak = []; // untuk menampung json array 
  let filtertahun = $("#filtertahun").val();
  let filterketerangan = $("#filterketerangan").val();
  let filtervendor = $("#filtervendor_id").val();
  let filterstatus = $("#filterstatus").val();

  const table = $('#table').DataTable({
      "PageLength" : 100,
      "lengthMenu" : [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Semua']],
      "bLengthChange" : true,
      "bFilter" : true,
      "bInfo" : true,
      "processing" : true,
      "bServerSide" : true,
      "order":[[1, "desc" ]],
      ajax:{
        url : "{{url('')}}/kontrakmesin/data",
        type : "POST",
        data : function(d){
          d.filtertahun = filtertahun;
          d.filterketerangan = filterketerangan;
          d.filtervendor = filtervendor;
          d.filterstatus = filterstatus;
         return d;
         console.log(d);
        }
      },
      columnDefs: [ 
        { targets: '_all', visible: true },
        {
          "targets" : 0,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            list_kontrak[row.id] = row;
            return row.no_kontrak.toUpperCase();
          }
        },
        {
          "targets" : 1,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.nama_vendor.toUpperCase();
          }
        },
        {
          "targets" : 2,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.tgl_awal_kontrak;
          }
        },
        {
          "targets" : 3,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.tgl_jatuh_tempo;
          }
        },
        {
          "targets" : 4,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.keterangan.toUpperCase();
          }
        },
        {
          "targets" : 5,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.status.toUpperCase();
          }
        },
        {
          "targets" : 6,
          "sortable" : false,
          "render" : function(data, type, row, meta){
            return `
            <a data-id=`+row.id+` data-toggle="modal" data-target="#myEdit" class="edit btn btn-sm btn-success" style="padding: 1px 5px"><i class="fa fa-edit"></i></a>
            |  <a data-id=`+row.id+` data-toggle="modal" data-target="#myShow" class="tampil btn btn-sm btn-warning" style="padding: 1px 5px"><i class="fa fa-eye"></i></a> 
            |  <a href="/kontrakmesin/hapus/`+row.id+`" class="tombol-hapus btn btn-sm btn-danger" style="padding: 1px 5px"><i class="fa fa-trash"></i></a> 
            `;
          }
        },
      ]
  });

  $(".filter").on('change', function(){
     filtertahun = $("#filtertahun").val();
     filterketerangan = $("#filterketerangan").val();
     filtervendor = $("#filtervendor_id").val();
     filterstatus = $("#filterstatus").val();
     
     $("#hasiltahun").val(filtertahun);
     $("#hasilketerangan").val(filterketerangan);
     $("#hasilvendor_id").val(filtervendor);
     $("#hasilstatus").val(filterstatus);

    table.ajax.reload(null,false);
  });

  setTimeout(function() {
    console.log(list_kontrak);
  }, 1000);

  // modal edit
  $('body').on('click', '.edit', function (event) {
      event.preventDefault();
      var id = $(this).data('id');  
      const kontrak = list_kontrak[id];
      console.log(list_kontrak);  
         $("#no_kontrak2").val(kontrak.no_kontrak);
         $("#vendor_id2").val(kontrak.vendor_id).trigger('change');
         $("#tgl_awal_kontrak2").val(kontrak.tgl_awal_kontrak);
         $("#tgl_jatuh_tempo2").val(kontrak.tgl_jatuh_tempo);
         $("#keterangan2").val(kontrak.keterangan);
         $("#status2").val(kontrak.status);
         $("#editform").attr("action","kontrakmesin/"+id);
    });

    //tombol hapus 
    $('body').on('click', '.tombol-hapus', function (event) {
          event.preventDefault();
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
      });

      $('body').on('click', '#btn-print', function (event) {
        event.preventDefault();
        $("#form-excel").attr("action","/kontrakmesin/printdata");
        $("#form-excel").attr("target","_blank");
        $('#form-excel').submit();
      });

      $('body').on('click', '#btn-excel', function (event) {
        event.preventDefault();
        $("#form-excel").attr("action","/kontrakmesin/excel");
        $("#form-excel").attr("target","_blank");
        $('#form-excel').submit();
      });

  </script>

 
@endpush