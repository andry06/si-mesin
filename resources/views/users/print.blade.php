  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/adminlte.min.css') }}">
  <title>Cetak ID CARD</title>
<div class="row">
@foreach($users as $key => $user)

<div class="col-sm-4">                
  <div class="card text-center" style="width: 85mm; height: 125mm; border: 1px solid black;">
    <div class="card-header bg-info">
      <h5>
        @foreach($perusahaan as $key => $pt)
          {{ $pt->nama_perusahaan }}
        @endforeach
      </h5>
      <span id="tampillevel" style="font-weight: bold">{{ strtoupper($user->level) }}</span>
    </div>
    <div class="card-body" >
      <img id="tampilphoto" src="/img/users/{{ $user->photo }}" width="180px" height="300px" style="margin-bottom: 20px" class="img-thumbnail" alt="...">
      <br>
      <span id="tampilnama" style="font-weight: bold;" >{{ strtoupper($user->name) }}</span>
      <!-- <span id="tampilnik" style="font-weight: bold">NIK. {{ $user->nik }}</span> -->
    </div>
    <table style="border-top: 1px solid black; ">
      <tr>
          <td>
            <center>
            <img style="margin-bottom: 10px; padding-top: 10px " src="data:image/png;base64,{{DNS1D::getBarcodePNG($user->barcode_user, 'C128A')}}" alt="barcode" width="180px" height="40px" />
            <div id="barcodeuser3" style="font-weight: bold; margin-bottom: 10px">NIK. {{ $user->barcode_user }}</div>
            </center>
          </td>      
      </tr>
    </table> 
    </div>
    </div>
    
@endforeach    
</div>
<script type="text/javascript">window.print();</script>