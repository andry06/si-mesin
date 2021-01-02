<table border="1px solid black">
      <thead>
        <tr>
            <th></th>
        </tr> 
        <tr>
            <th colspan="7" align="center" valign="middle"><strong>DATA USERS PENGGUNA APLIKASI</strong></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
          <th align="center"><b>No</b></th>
          <th align="center"><b>Nama</b></th>
          <th align="center"><b>NIK</b></th>
          <th align="center"><b>Email</b></th>
          <th align="center"><b>Level</b></th>
          <th align="center"><b>Barcode User</b></th>
          <th align="center"><b>Tanggal Buat</b></th>
          <th align="center"><b>Terakhir Diedit</b></th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = 0
        ?>
        @forelse($users as $key => $user)
            <tr>
                <td> {{  $no+=1 }}</td>
                <td class="text-center" > {{ strtoupper($user->name) }}</td>
                <td class="text-center" > {{ strtoupper($user->nik) }}</td>
                <td class="text-center" > {{ strtolower($user->email) }}</td>
                <td class="text-center" > {{ strtoupper($user->level) }}</td>
                <td class="text-center" > {{ strtoupper($user->barcode_user) }}</td>
                <td class="text-center" > {{ strtoupper($user->created_at) }}</td>
                <td class="text-center" > {{ strtoupper($user->updated_at) }}</td>
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>