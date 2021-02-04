<table border="1px solid black">
      <thead>
        <tr>
            <th></th>
        </tr> 
        <tr>
            <th colspan="7" align="center" valign="middle"><strong>DATA MESIN</strong></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>Jenis Mesin</b></th>
          <th align="center"><b>Merk Mesin</b></th>
          <th align="center"><b>Type Mesin</b></th>
          <th align="center"><b>No Seri</b></th>
          <th align="center"><b>Kepemilikan</b></th>
          <th align="center"><b>No Barcode Mesin</b></th>
          <th align="center"><b>Tanggal Buat</b></th>
          <th align="center"><b>Terakhir Diedit</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @foreach($data as $key => $mesin)
            <tr>
                <td> {{  $no+=1 }}</td>
                <td class="text-center" > {{ strtoupper($mesin->jenismesin->jenis_mesin) }}</td>
                <td class="text-center" > {{ strtoupper($mesin->merkmesin->merk_mesin) }}</td>
                <td class="text-center" > {{ strtoupper($mesin->type) }}</td>
                <td class="text-center" > {{ strtoupper($mesin->no_seri) }}</td>
                <td class="text-center" > {{ strtoupper($mesin->vendor->nama_vendor) }}</td>
                <td class="text-center" > {{ strtoupper($mesin->barcode_mesin) }}</td>
                <td class="text-center" > {{ strtoupper($mesin->created_at) }}</td>
                <td class="text-center" > {{ strtoupper($mesin->updated_at) }}</td>
            </tr>
            @endforeach
      </tbody>
</table>