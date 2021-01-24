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
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.min.css/') }}">
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

@error('jenismesin_id')
  <?php Alert::error('Problem Jenis Mesin', $message); ?>
@enderror

@error('merkmesin_id')
  <?php Alert::error('Problem Merk Mesin', $message); ?>
@enderror

@error('type')
    <?php Alert::error('Problem Type', $message); ?>
@enderror

@error('no_seri')
    <?php Alert::error('Problem No Seri', $message); ?>
@enderror

@error('vendor_id')
    <?php Alert::error('Problem Vendor', $message); ?>
@enderror

@error('status')
    <?php Alert::error('Kepemilikan', $message); ?>
@enderror

@error('barcode_mesin')
    <?php Alert::error('Barcode Mesin', $message); ?>
@enderror

<div class="col-md-12">
    <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Daftar Mesin</h3>
              </div>
              <br>
              <center>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">
                  Tambah Data
                </button>
              </center>
              
              <div style="margin: 2%">
                <h5><b>Filter Data : </b></h5>
                <div class="row">
                <div class="col-sm-3">
                <label for="filterjenismesin_id">Jenis Mesin</label>
                  <div class="input-group">
                  <select name="filterjenismesin_id" id="filterjenismesin_id" class="filter form-control select2bs4 @error('jenismesin_id') is-invalid @enderror" >
                        <Option value="">Semua Jenis Mesin</Option>
                        @foreach($jenismesin as $key => $jm) 
                          <option value="{{ $jm->id }}" @if (old('jenismesin_id') == '{{ $jm->id }}') selected @endif>{{ strtoupper($jm->jenismesin) }}</option>
                        @endforeach
                    </select>
                  </select>
                  </div>
                </div>
                <div class="col-sm-3">
                <label for="filtermerkmesin_id">Merk Mesin</label>
                  <div class="input-group">
                  <select name="filtermerkmesin_id" id="filtermerkmesin_id" class="filter form-control select2bs4 @error('merkmesin_id') is-invalid @enderror" id="merkmesin_id2" >
                  <Option value="">Semua Merk Mesin</Option>
                    @foreach($merkmesin as $key => $mm) 
                      <option value="{{ $mm->id }}">{{ strtoupper($mm->merk_mesin) }}</option>
                    @endforeach
                  </select>
                  </div>
                </div>
                <div class="col-sm-3">
                <label for="filtervendor_id">Kepemilikan</label>
                  <div class="input-group">
                      <select name="filtervendor_id" id="filtervendor_id" class="filter form-control select2bs4 @error('vendor_id') is-invalid @enderror" autocomplete="vendor_id">
                        <option value="">Semua Perusahaan</option>
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
                        <select id="filter_status" name="filterstatus" class="filter form-control @error('status') is-invalid @enderror">
                        <option value="">Semua Status Mesin</option>
                        <option value="inhouse" @if (old('status') == 'inhouse') selected @endif >Inhouse</option>
                        <option value="dipinjamkan" @if (old('status') == 'dipinjamkan') selected @endif >Di Sewakan</option>
                        <option value="diservis" @if (old('status') == 'diservis') selected @endif>Di Servis</option>
                        <option value="rusak" @if (old('status') == 'rusak') selected @endif>Rusak</option>
                        <option value="rental" @if (old('status') == 'rental') selected @endif>Sewa</option>
                        <option value="dikembalikan" @if (old('status') == 'dikembalikan') selected @endif>Di Kembalikan</option>
                      </select>
                      </select>
                  </select>
                  </div>
                </div>
              </div>
		    </div>        
        <div class="devider"></div>
              <!-- /.card-header -->
            <div class="card-body table-responsive p-3" >  
              <!-- <div class="card-body"> -->
             
              <form method="post"  id="form-kirim">
              @csrf
                <table id="table" width="100%" style="font-size: 0.9rem" class="table table-hover text-nowrap table-striped table-bordered">
                  <thead class="thead-info"> 
                    <tr>
                      <th width="5px"><input type="checkbox" id="check-all"></th>
                      <th scope="col" class="text-center">Jenis Mesin</th>
                      <th scope="col" class="text-center">Merk Mesin</th>
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">No Seri</th>
                      <th scope="col" class="text-center">Kepemilikan</th>
                      <th scope="col" class="text-center">Barcode Mesin</th>
                      <th scope="col" class="text-center">Status</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table> 
                <a href="/mastermesin/excel" class="btn btn-sm btn-success"><i class="fa fa-file" aria-hidden="true"></i> EXPORT EXCEL</a> 
                | <a href="/users/printdata" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file" aria-hidden="true"></i> PRINT DATA</a>
                 | 
                <button type="submit" class="btn btn-sm btn-warning" id="btn-kirim" disabled><i class="fa fa-print"></i> PRINT BARCODE</button>
                </form>
              </div>
               
              <!-- /.card-body -->
            </div>
             
            <!-- /.card -->



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
            <label for="jenismesin_id">{{ __('Jenis Mesin') }}</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
              </div>
              <select name="jenismesin_id" id="jenismesin_id" class="form-control select2bs4 @error('jenismesin_id') is-invalid @enderror" >
                @foreach($jenismesin as $key => $jm) 
                  <option value="{{ $jm->id }}" @if (old('jenismesin_id') == '{{ $jm->id }}') selected @endif>{{ strtoupper($jm->jenismesin) }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="merkmesin_id">{{ __('Merk Mesin') }}</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
              </div>
              <select name="merkmesin_id" id="merkmesin_id" class="form-control select2bs4 @error('merkmesin_id') is-invalid @enderror" id="merkmesin_id2" >
                @foreach($merkmesin as $key => $mm) 
                  <option value="{{ $mm->id }}" @if (old('merkmesin_id') == '{{ $mm->id }}') selected @endif>{{ strtoupper($mm->merk_mesin) }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="type">{{ __('Type Mesin') }}</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-edit"></i></span>
              </div>
              <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" placeholder="{{ __('Type Mesin') }}" required autocomplete="type">
            </div>      
          </div>

          <div class="form-group">
            <label for="no_seri">{{ __('No Seri') }}</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
              </div>
              <input id="no_seri" type="text" class="form-control @error('no_seri') is-invalid @enderror" name="no_seri" placeholder="{{ __('No Seri') }}" required autocomplete="no_seri">
            </div>
          </div>

          <div class="form-group">
            <label for="vendor_id">{{ __('Kepemilikan') }}</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-university"></i></span>
              </div>
                <select name="vendor_id" id="vendor_id" class="form-control select2bs4 @error('vendor_id') is-invalid @enderror" required autocomplete="vendor_id">
                  <!-- <option selected="">--Kepemilikan -- </option> -->
                  @foreach($vendors as $key => $vendor) 
                    <option value="{{ $vendor->id }}" @if (old('vendor_id') == '{{ $vendor->id }}') selected  @endif>{{ strtoupper($vendor->nama_vendor) }}</option>
                  @endforeach
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

          <div class="form-group">
            <label for="barcode_mesin">{{ __('NO BARCODE') }}</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tags"></i></span>
              </div>
              <input id="barcode_mesin" type="text" class="form-control @error('barcode_mesin') is-invalid @enderror" placeholder="{{ __('Barcode Mesin') }}" disabled autocomplete="barcode_mesin" >
              <input type="hidden" name="barcode_mesin"  id="barcode_mesin1">
            </div>
          </div>
                
          <div class="form-group">
            <label for="photo">File Photo</label>
            <div class="input-group">
              <div class="custom-file">
              <input class="form-control form-control" name="photo" id="formFileSm" type="file" accept="image/*">
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

<!-- Modal Edit Data data -->
<div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">TAMBAH DATA MESIN</h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
              <form method="POST" role="form"  action="/mastermesin"  enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                  <label for="jenismesin_id2">{{ __('Jenis Mesin') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                    </div>
                    <select name="jenismesin_id" id="jenismesin_id2" class="form-control select2bs4 @error('jenismesin_id') is-invalid @enderror" >
                      <option value="">Tentukan Jenis Mesin</option>
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
                      <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                    </div>
                    <select name="merkmesin_id" id="merkmesin_id2" class="form-control select2bs4 @error('merkmesin_id') is-invalid @enderror" >
                      <option value="">Tentukan Merk Mesin</option>
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
                      <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input id="type2" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" placeholder="{{ __('Type Mesin') }}" required autocomplete="type">
                  </div>
                </div>

                <div class="form-group">
                  <label for="no_seri2">{{ __('No Seri') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                    </div>
                    <input id="no_seri2" type="text" class="form-control @error('no_seri') is-invalid @enderror" name="no_seri" placeholder="{{ __('No Seri') }}" required autocomplete="no_seri">
                  </div>
                  </div>

                  <div class="form-group">
                  <label for="vendor_id2">{{ __('Kepemilikan') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-university"></i></span>
                    </div>
                    <select name="vendor_id" id="vendor_id2" class="form-control select2bs4 @error('vendor_id') is-invalid @enderror" required autocomplete="vendor_id">
                      <!-- <option selected="">--Kepemilikan -- </option> -->
                        @foreach($vendors as $key => $vendor) 
                          <option value="{{ $vendor->id }}" @if (old('vendor_id') == '{{ $vendor->id }}') selected  @endif>{{ strtoupper($vendor->nama_vendor) }}</option>
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

                <div class="form-group">
                  <label for="barcode_mesin2">{{ __('NO BARCODE') }}</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tags"></i></span>
                    </div>
                    <input id="barcode_mesin2" type="text" class="form-control @error('barcode_mesin') is-invalid @enderror" placeholder="{{ __('Barcode Mesin') }}" disabled autocomplete="barcode_mesin" >
                    <input type="hidden" name="barcode_mesin"  id="barcode_mesin3">
                  </div>
                </div>
                  
                <div class="form-group">
                  <label for="photo">File Photo</label>
                  <div class="input-group">
                    <div class="custom-file">
                    <!-- <label for="formFileSm" class="form-label">Small file input example</label> -->
                    <input class="form-control form-control" name="photo" id="formFileSm2" accept="image/*" type="file">
                    </div>
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
<!-- Modal Edit data -->


<!-- Modal Show Data data-->
<div id="myShow" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">TAMPIL DATA Mesin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
                <div class="card text-center">
                  <div class="card-header">
                    <b>
                    <table>
                      <tr>
                        <td width="40%" align="left"><span style="margin-left: 30%">JENIS MESIN</span></td>
                        <td width="1%"> : </td>
                        <td width="59%" align="left"><span id="tampiljenis" style="margin-left: 10%"></span></td>
                      </tr>
                      <tr>
                        <td align="left"><span style="margin-left: 30%">MERK MESIN</span></td>
                        <td> : </td>
                        <td align="left"><span id="tampilmerk" style="margin-left: 10%"></span></td>
                      </tr>
                      <tr>
                        <td align="left"><span style="margin-left: 30%">TYPE MESIN</span></td>
                        <td> : </td>
                        <td align="left"><span id="tampiltype" style="margin-left: 10%"></span></td>
                      </tr>
                      <tr>
                        <td align="left"><span style="margin-left: 30%">NO SERI</span></td>
                        <td> : </td>
                        <td align="left"><span id="tampilnoseri" style="margin-left: 10%"></span></td>
                      </tr>
                    </table>
                  </div>
                  <div class="card-body">
                    <img id="tampilphoto" width="130px" height="200px" class="img-thumbnail" alt="...">
                    <br><br>
                    KEPEMILIKAN <span id="tampilmilik"></span>
                    <br>
                    STATUS MESIN <span id="tampilstatus" ></span>
                    <br>
                  
                  </div>
                  <div class="card-footer text-muted">
                  <center>
                 
                  <img id="tampilbarcode" src="data:image/png;base64,{{DNS1D::getBarcodePNG('212122', 'C128A')}}" alt="barcode" />
                  <br>
                  <span id="tampilnobarcode" style="font-weight: bold"></span>
                  </center> 
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <a id="printidcard" class="btn btn-sm btn-warning"><i class="fa fa-print"></i> PRINT</a> -->
                </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>
<!-- Modal tampil data -->


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

<script type="text/javascript">
  $('#jenismesin_id, #vendor_id').change(function(){ 
      var idvendor = $("#vendor_id").val();
      var idjm = $("#jenismesin_id").val();

    $.get('/mastermesin/' + idvendor + '/' + idjm + '/barcode', function (data) {
        var barcode = data.data;
          $('#barcode_mesin, #barcode_mesin1').val(barcode);
          
     });
    
    });
 </script>

<script type="text/javascript">
  $('#jenismesin_id2, #vendor_id2').change(function(){ 
      var idvendor = $("#vendor_id2").val();
      var idjm = $("#jenismesin_id2").val();

    $.get('/mastermesin/' + idvendor + '/' + idjm + '/barcode', function (data) {
        var barcode = data.data;
          $('#barcode_mesin2, #barcode_mesin3').val(barcode);
          
     });

  });

 </script>

<script>
  let list_mesin = []; // untuk menampung json array 
  let yangDiCheck = 0;
  let filter_jenismesin = $("#filterjenismesin_id").val();
  let filter_merkmesin = $("#filtermerkmesin_id").val();
  let filter_vendor = $("#filtervendor_id").val();
  let filter_status = $("#filter_status").val();
  
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
        url : "{{url('')}}/mastermesin/data",
        type : "POST",
        data : function(d){
          d.filter_jenismesin = filter_jenismesin;
          d.filter_merkmesin = filter_merkmesin;
          d.filter_vendor = filter_vendor;
          d.filter_status = filter_status;
         return d;
        }
      },
      columnDefs: [ // looping datatables
        { targets: '_all', visible: true },
        {
          "targets" : 0,
          "sortable" : false,
          "render" : function(data, type, row, meta){
            list_mesin[row.id] = row;
            return `
            <input type="checkbox" class="check-item" name="id[]" value=`+row.id+`>
            `;
          }
        },
        {
          "targets" : 1,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.jenis_mesin.toUpperCase();
          }
        },
        {
          "targets" : 2,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.merk_mesin.toUpperCase();
          }
        },
        {
          "targets" : 3,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.type.toUpperCase();
          }
        },
        {
          "targets" : 4,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.no_seri.toUpperCase();
          }
        },
        {
          "targets" : 5,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.nama_vendor.toUpperCase();
          }
        },
        {
          "targets" : 6,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.barcode_mesin.toUpperCase();
          }
        },
        {
          "targets" : 7,
          "class" : "text-nowrap",
          "render" : function(data, type, row, meta){
            return row.status.toUpperCase();
          }
        },
        {
          "targets" : 8,
          "sortable" : false,
          "render" : function(data, type, row, meta){
            return `
            <a data-id=`+row.id+` data-toggle="modal" data-target="#myEdit" class="edit btn btn-sm btn-success" style="padding: 1px 5px"><i class="fa fa-edit"></i></a>
            |  <a data-id=`+row.id+` data-toggle="modal" data-target="#myShow" class="tampil btn btn-sm btn-warning" style="padding: 1px 5px"><i class="fa fa-eye"></i></a> 
            |  <a href="/mastermesin/hapus/`+row.id+`" class="tombol-hapus btn btn-sm btn-danger" style="padding: 1px 5px"><i class="fa fa-trash"></i></a> 
            `;
          }
        },
      ]
  });

  setTimeout(function() {
    console.log(list_mesin);
  }, 1000);

  
  // modal edit
    $('body').on('click', '.edit', function (event) {
      event.preventDefault();
      var id = $(this).data('id');  
      const mesin = list_mesin[id];  
        $("#jenismesin_id").val(mesin.jenismesin_id).trigger('change');
         $("#merkmesin_id").val(mesin.merkmesin_id).trigger('change');
         $("#type").val(mesin.type.toUpperCase());
         $("#no_seri").val(mesin.no_seri.toUpperCase());
         $("#vendor_id").val(mesin.vendor_id).trigger('change');
         $("#status").val(mesin.status);
         console.log(mesin.status);
         $("#barcode_mesin, #barcode_mesin1").val(mesin.barcode_mesin);
         $("#editform").attr("action","mastermesin/"+id);
    });

    // tampil
    $('body').on('click', '.tampil', function (event) {
      event.preventDefault();
      var id = $(this).data('id');
      const mesin = list_mesin[id];
      console.log(mesin); 
         $('#tampiljenis').html(mesin.jenis_mesin.toUpperCase());
         $('#tampilmerk').html(mesin.merk_mesin.toUpperCase());
         $('#tampiltype').html(mesin.type.toUpperCase());
         $('#tampilnoseri').html(mesin.no_seri.toUpperCase());
         $('#tampilmilik').html(mesin.nama_vendor.toUpperCase());
         $('#tampilstatus').html(mesin.status.toUpperCase());
         $('#tampilnobarcode').html(mesin.barcode_mesin.toUpperCase());
         $("#tampilphoto").attr("src","/img/mesin/"+mesin.photo);
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

          $('body').on('click', '#btn-kirim', function (event) {
              event.preventDefault();
              $("#form-kirim").attr("action","/mastermesin/print");
              $("#form-kirim").attr("target","_blank");
              $('#form-kirim').submit();
          });

          
  $("#check-all").on('click', function(){
    var isChecked = $("#check-all").prop('checked');
    $('.check-item').prop('checked', isChecked);
    $('#btn-kirim').prop('disabled', !isChecked);
   
  });
  
  $("#table tbody").on('click', '.check-item', function(){
    if($(this).prop('checked')!=true){
      $("#check-all").prop('checked', false)
    }
    let semua_checkbox = $("#table tbody .check-item:checked")
    let btn_kirim_status = (semua_checkbox.length>0)
    $('#btn-kirim').prop('disabled', !btn_kirim_status)
  });

  $(".filter").on('change', function(){
     filter_jenismesin = $("#filterjenismesin_id").val();
     filter_merkmesin = $("#filtermerkmesin_id").val();
     filter_vendor = $("#filtervendor_id").val();
     filter_status = $("#filter_status").val();
     
    table.ajax.reload(null,false);
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