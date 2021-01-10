<title>PRINT DATA JENIS MESIN</title>
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
<br>DATA JENIS MESIN</h2>
</center>
<br><br>
<table border="1px solid black" style="width:100%" >
      <thead>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>KODE NUMBER</b></th>
          <th align="center"><b>JENIS MESIN</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($jenismesin as $key => $jm)
            <tr>
                <td> {{  $no+=1 }}</td>
                <td align="center" > {{ $jm->kode_number }}</td>
                <td align="center" > {{ strtoupper($jm->jenis_mesin) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>
<script type="text/javascript">window.print();</script>