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
<br>DATA KONTRAK</h2>
</center>
<br><br>
<table border="1px solid black" style="width:100%" >
      <thead>
        <tr>
          <th align="center"><b>No</th>
          <th class="text-center">No Kontrak</th>
          <th class="text-center">Nama Vendor</th>
          <th class="text-center">Tgl Awal Kontrak</th>
          <th class="text-center">Tgl Jatuh Tempo</th>
          <th class="text-center">Keterangan </th>
          <th class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($data as $key => $kontrak)
            <tr>
                <td align="center"  > {{  $no+=1 }}</td>
                <td align="center" > {{ strtoupper($kontrak->no_kontrak) }}</td>
                <td align="center" > {{ strtoupper($kontrak->nama_vendor) }}</td>
                <td align="center" > {{ $kontrak->tgl_awal_kontrak }}</td>
                <td align="center" > {{ $kontrak->tgl_jatuh_tempo }}</td>
                <td align="center" > {{ strtoupper($kontrak->keterangan) }}</td>
                <td align="center" > {{ strtoupper($kontrak->status) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>
<script type="text/javascript">window.print();</script>