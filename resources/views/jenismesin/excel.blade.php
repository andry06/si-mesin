<table border="1px solid black">
      <thead>
        <tr>
            <th></th>
        </tr> 
        <tr>
            <th colspan="7" align="center" valign="middle"><strong>DATA JENIS MESIN</strong></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>Kode Number</b></th>
          <th align="center"><b>Jenis Mesin</b></th>
          <th align="center"><b>Tanggal Buat</b></th>
          <th align="center"><b>Terakhir Diedit</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($jenismesin as $key => $jm)
            <tr>
                <td> {{  $no+=1 }}</td>
                <td class="text-center" > {{ strtoupper($jm->kode_number) }}</td>
                <td class="text-center" > {{ strtoupper($jm->jenis_mesin) }}</td>
                <td class="text-center" > {{ strtoupper($jm->created_at) }}</td>
                <td class="text-center" > {{ strtoupper($jm->updated_at) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>