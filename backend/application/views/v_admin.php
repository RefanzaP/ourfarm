
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Admin</h3>
               <div class="panel-heading">
            <br>
            <a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span>Add</a><br>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Nama Admin</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                              $no=0;
                              foreach ($data_admin as $dt_adm) {
                                $no++;
                                echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$dt_adm->username.'</td>
                                <td>'.$dt_adm->nama.'</td>
                                <td>'.$dt_adm->tlpn.'</td>
                                <td>'.$dt_adm->email.'</td>
                                <td>'.$dt_adm->nama_level.'</td>
                                <td>
                                <a href="#update_admin" class="btn btn-warning" data-toggle="modal" onclick="tm_detail('.$dt_adm->id_user.')"><span class="fa fa-pencil"></span></a> 
                                <a href="'.base_url('index.php/Admin/hapus_admin/'.$dt_adm->id_user).'" class="btn btn-danger" data-toggle="modal" onclick="return confirm(\'anda yakin?\')"><span class="fa fa-trash"></span></a>
                               
                                </td>
            
                                </tr>';
                              }
                      ?>
                </tbody>
                <tfoot>
                <tr>
                   <th>No</th>
                  <th>Username</th>
                  <th>Nama Admin</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->     
           <?php 
         $pesan =$this->session->flashdata('pesan');
         if($pesan != NULL){
           echo '
           <div class="alert alert-success">'.$pesan.'</div>
           ';
         }
         
         ?>  

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


   <div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Admin</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Admin/tambah_admin')?>" method="post">
             Username
             <input type="text" name="username" class="form-control"><br>
             Password
             <input type="password" name="password" class="form-control"><br>
             Nama Admin
             <input type="text" name="nama" class="form-control"><br>
             Telepon
             <input type="text" name="tlpn" class="form-control"><br>
             Email
             <input type="text" name="email" class="form-control"><br>
             Level
             <select name="id_level" class="form-control">
        <?php
        foreach ($data_level as $lvl) {
          echo "<option value= '".$lvl->id_level."'>
          ".$lvl->nama_level."
          </option>";
        }
         ?>
       </select><br>
             <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update_admin">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Admin</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Admin/update_admin')?>" method="post">
                <input type="hidden" name="id_user" id="id_user">  
                Username
                <input type="text" id="username" name="username" class="form-control"><br>
                Password
                <input type="password" id="password" name="password" class="form-control"><br>
                Nama Admin
                <input type="text" id="nama" name="nama" class="form-control"><br>
                Telepon
                <input type="text" name="tlpn" id="tlpn" class="form-control"><br>
                Email
                <input type="text" name="email" id="email" class="form-control"><br>
                Level
                <select name="id_level" id="id_level" class="form-control">
                   <?php
                   foreach ($data_level as $lvl) {
                       echo "<option value= '".$lvl->id_level."'>
                       ".$lvl->nama_level."
                       </option>";
                   }
                    ?>
                </select><br>

                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
           
<script>

function tm_detail(id_lev) {
  $.getJSON("<?=base_url()?>index.php/Admin/get_detail_admin/"+id_lev,function(data){
    $("#id_user").val(data['id_user']);
    $("#username").val(data['username']);
    $("#password").val(data['password']);
    $("#nama").val(data['nama']);
    $("#tlpn").val(data['tlpn']);
    $("#email").val(data['email']);
    $("#id_level").val(data['id_level']);

  });
}
</script>
