<table border="1px solid black">
      <thead>
        <tr>
            <th></th>
        </tr> 
        <tr>
            <th colspan="7" align="center" valign="middle"><strong>DATA KONTRAK</strong></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>Kontrak Mesin</b></th>
          <th align="center"><b>Nama Vendor</b></th>
          <th align="center"><b>Tgl Awal Kontrak</b></th>
          <th align="center"><b>Tgl Jatuh Tempo</b></th>
          <th align="center"><b>Keterangan</b></th>
          <th align="center"><b>Status</b></th>
          <th align="center"><b>Tanggal Buat</b></th>
          <th align="center"><b>Terakhir Diedit</b></th>
          <th align="center"><b>Dibuat Oleh</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @foreach($data as $key => $kontrak)
            <tr>
                <td align="center"  > {{  $no+=1 }}</td>
                <td align="center" > {{ strtoupper($kontrak->no_kontrak) }}</td>
                <td align="center" > {{ strtoupper($kontrak->vendor->nama_vendor) }}</td>
                <td align="center" > {{ $kontrak->tgl_awal_kontrak }}</td>
                <td align="center" > {{ $kontrak->tgl_jatuh_tempo }}</td>
                <td align="center" > {{ strtoupper($kontrak->keterangan) }}</td>
                <td align="center" > {{ strtoupper($kontrak->status) }}</td>
                <td class="text-center" > {{ strtoupper($kontrak->created_at) }}</td>
                <td class="text-center" > {{ strtoupper($kontrak->updated_at) }}</td>
                <td class="text-center" > {{ strtoupper($kontrak->name) }}</td>
            </tr>
            @endforeach
      </tbody>
</table>