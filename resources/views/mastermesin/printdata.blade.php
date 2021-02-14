<title>PRINT DATA MERK MESIN</title>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding : 5px;
}
</style>
<center>
<h2>
    @foreach($perusahaan as $key => $pt)
          {{ $pt->nama_perusahaan }}
        @endforeach
<br>DATA MASTER MESIN</h2>
</center>
<br><br>
<table border="1px solid black" style="width:100%" >
      <thead>
        <tr>
          <th align="center"><b>No</th>
          <th class="text-center">Jenis Mesin</th>
          <th class="text-center">Merk Mesin</th>
          <th class="text-center">Type</th>
          <th class="text-center">No Seri</th>
          <th class="text-center">Kepemilikan</th>
          <th class="text-center">Barcode Mesin</th>
          <th class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($data as $key => $mesin)
            <tr>
                <td align="center"  > {{  $no+=1 }}</td>
                <td align="center" > {{ strtoupper($mesin->jenismesin->jenis_mesin) }}</td>
                <td align="center" > {{ strtoupper($mesin->merkmesin->merk_mesin) }}</td>
                <td align="center" > {{ strtoupper($mesin->type) }}</td>
                <td align="center" > {{ strtoupper($mesin->no_seri) }}</td>
                <td align="center" > {{ strtoupper($mesin->vendor->nama_vendor) }}</td>
                <td align="center" > {{ strtoupper($mesin->barcode_mesin) }}</td>
                <td align="center" > {{ strtoupper($mesin->status) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>
<script type="text/javascript">window.print();</script>