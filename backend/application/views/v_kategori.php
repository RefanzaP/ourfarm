
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kategori</h3>
               <div class="panel-heading">
            <br>
            <a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span>Add</a><br>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                </tr>
                </thead>
                <tbody>
                <?php
                              $no=0;
                              foreach ($data_kategori as $dt_ktg) {
                                $no++;
                                echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$dt_ktg->nama_kategori.'</td>
                                <td>
                                <a href="#update_kategori" class="btn btn-warning" data-toggle="modal" onclick="tm_detail('.$dt_ktg->id_kategori.')"><span class="fa fa-pencil"></span></a> 
                                <a href="'.base_url('index.php/Kategori/hapus_kategori/'.$dt_ktg->id_kategori).'" class="btn btn-danger" data-toggle="modal" onclick="return confirm(\'anda yakin?\')"><span class="fa fa-trash"></span></a>
                               
                                </td>
            
                                </tr>';
                              }
                      ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
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
        <h4 class="modal-title" id="myModalLabel">Add Kategori</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Kategori/tambah_kategori')?>" method="post">
             Nama Kategori
             <input type="text" name="nama_kategori" class="form-control"><br>
             <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update_kategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Kategori</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Kategori/update_kategori')?>" method="post">
                <input type="hidden" name="id_kategori" id="id_kategori">  
                Nama Katgeori
                <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"><br>
               
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
  $.getJSON("<?=base_url()?>index.php/Kategori/get_detail_kategori/"+id_lev,function(data){
    $("#id_kategori").val(data['id_kategori']);
    $("#nama_kategori").val(data['nama_kategori']);
  

  });
}
</script>
