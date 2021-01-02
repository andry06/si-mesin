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
          <th align="center"><b>Nama</b></th>
          <th align="center"><b>NIK</b></th>
          <th align="center"><b>Email</b></th>
          <th align="center"><b>Level</b></th>
          <th align="center"><b>Barcode User</b></th>
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
               
            </tr>
        @empty
           <tr>
                <td colspan="5" align="center">No Post</td>
           </tr>  
        @endforelse
      </tbody>
</table>
<script type="text/javascript">window.print();</script>