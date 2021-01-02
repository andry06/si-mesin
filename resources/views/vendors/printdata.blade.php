<title>PRINT DATA USERS PENGGUNA</title>
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
<br>DATA USERS PENGGUNA APLIKASI</h2>
</center>
<br><br>
<table border="1px solid black" style="width:100%" >
      <thead>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>Nama Vendor</b></th>
          <th align="center"><b>Alamat</b></th>
          <th align="center"><b>Negara</b></th>
          <th align="center"><b>No Telp</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($vendors as $key => $vendor)
            <tr>
                <td> {{  $no+=1 }}</td>
                <td class="text-center" > {{ strtoupper($vendor->nama_vendor) }}</td>
                <td class="text-center" > {{ strtoupper($vendor->alamat) }}</td>
                <td class="text-center" > {{ strtoupper($vendor->negara) }}</td>
                <td class="text-center" > {{ strtoupper($vendor->no_telp) }}</td>
               
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>
<script type="text/javascript">window.print();</script>