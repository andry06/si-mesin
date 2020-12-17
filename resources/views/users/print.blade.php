<table id="example1" class="table table-hover text-nowrap table-striped table-bordered">
                  <thead class="thead-info"> 
                    <tr>
                      <th width="5px"><input type="checkbox" id="check-all"></th>
                      <th scope="col" style="width: 10px">No</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">NIK</th>
                      <th scope="col" class="text-center">Email</th>
                      <th scope="col" class="text-center">Level</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $no = 0
                    ?>
                    @forelse($users as $key => $user)
                        <tr>
                            <td class="text-center"><input type="checkbox" class="check-item" name="id[]" value="{{ $user->id }}"></td>
                            <td> {{  $no+=1 }}</td>
                            <td class="text-center" > {{ strtoupper($user->name) }}</td>
                            <td class="text-center" > {{ strtoupper($user->nik) }}</td>
                            <td class="text-center" > {{ strtolower($user->email) }}</td>
                            <td class="text-center" > {{ strtoupper($user->level) }}</td>
                            <td style="width:10px; padding-top:6px; padding-bottom: 0px;" >
                                <!-- <center> -->
                                <!-- <button type="button" id="edit" data-toggle="modal" data-target="#myEdit" class="btn btn-success edit_komentar kecil" ><i class="fa fa-edit"></i></button> -->
                                <a data-id="{{ $user->id }}" data-toggle="modal" data-target="#myEdit" class="edit btn btn-sm btn-success"><i class="fa fa-edit"></i></a>  
                              |  <a data-id="{{ $user->id }}" id="show" data-toggle="modal" data-target="#myShow" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a> 
                              |  <a href="/users/hapus/{{ $user->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 
                              <!-- </center> -->
                            </td>
                        </tr>
                    @empty
                       <tr>
                            <td colspan="5" align="center">No Post</td>
                       </tr>  
                    @endforelse
                  </tbody>
                </table>