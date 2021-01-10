<table border="1px solid black">
      <thead>
        <tr>
            <th></th>
        </tr> 
        <tr>
            <th colspan="7" align="center" valign="middle"><strong>DATA MERK MESIN</strong></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>Merk Mesin</b></th>
          <th align="center"><b>Tanggal Buat</b></th>
          <th align="center"><b>Terakhir Diedit</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($merkmesin as $key => $mm)
            <tr>
                <td> {{  $no+=1 }}</td>
                <td class="text-center" > {{ strtoupper($mm->merk_mesin) }}</td>
                <td class="text-center" > {{ strtoupper($mm->created_at) }}</td>
                <td class="text-center" > {{ strtoupper($mm->updated_at) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>