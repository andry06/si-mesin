  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/adminlte.min.css') }}">
  <title>Cetak Barcode Mesin</title>
<div class="row">
@foreach($master as $key => $mesin)

<div class="col-sm-3">                
    <div class="card text-center" style="width: 60mm; height: 25mm; border: 1px solid black;">
        <table style="border-top: 1px solid black; ">
            <tr>
                <td>
                    <center>
                    <img style="margin-bottom: 7px; padding-top: 7px " src="data:image/png;base64,{{DNS1D::getBarcodePNG('210101001000', 'EAN13')}}" alt="barcode" width="180px" height="55px" />
                    <div id="barcodeuser3">{{ $mesin->barcode_mesin }}</div>
                    </center>
                </td>      
            </tr>
        </table> 
    </div>
</div>
    
@endforeach    
</div>
<script type="text/javascript">window.print();</script>