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
<br>DATA MERK MESIN</h2>
</center>
<br><br>
<table border="1px solid black" style="width:100%" >
      <thead>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>MERK MESIN</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($merkmesin as $key => $mm)
            <tr>
                <td align="center"  > {{  $no+=1 }}</td>
                <td align="center" > {{ strtoupper($mm->merk_mesin) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>
<script type="text/javascript">window.print();</script>