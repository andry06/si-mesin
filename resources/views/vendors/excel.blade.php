<table border="1px solid black">
      <thead>
        <tr>
            <th></th>
        </tr> 
        <tr>
            <th colspan="7" align="center" valign="middle"><strong>DATA VENDOR</strong></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>Nama Vendor</b></th>
          <th align="center"><b>Alamat</b></th>
          <th align="center"><b>Negara</b></th>
          <th align="center"><b>No Telp</b></th>
          <th align="center"><b>Tanggal Buat</b></th>
          <th align="center"><b>Terakhir Diedit</b></th>
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
                <td class="text-center" > {{ strtoupper($vendor->created_at) }}</td>
                <td class="text-center" > {{ strtoupper($vendor->updated_at) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>