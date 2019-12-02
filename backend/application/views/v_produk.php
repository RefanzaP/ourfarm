
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Produk</h3>
               <div class="panel-heading">
            <br>
            <a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span>Add</a><br>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" id="datatables">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Nama Petani</th>
                  <th>Foto Produk</th>
                  <th>Stok</th>
                  <th>Kode Produk</th>
                  <th>Harga Produk</th>
                  <th>Keterangan Produk</th>
                  <th>Kategori</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                 <tbody>
                <?php $no=0; foreach($tampil_produk as $prd):
                $no++; ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $prd->nama_produk ?></td>
                  <td><?= $prd->nama_petani ?></td>
                  <td><img src="<?=base_url('assets/produk/'.$prd->foto_cover )?>" style="width: 100px"></td>
                  <td><?= $prd->stok ?></td>
                  <td><?= $prd->kode_pesanan ?></td>
                  <td><?= $prd->biaya ?></td>
                  <td><?= $prd->keterangan_produk ?></td>
                  <td><?= $prd->nama_kategori ?></td>
                  <td><a href="#edit" onclick="edit('<?= $prd->id_produk ?>')" data-toggle="modal" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                  <a href="<?=base_url('index.php/Produk/hapus/'.$prd->id_produk)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger"><span class="fa fa-trash"></a></td>
                </tr>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Nama Petani</th>
                  <th>Foto Produk</th>
                  <th>Stok</th>
                  <th>Kode Produk</th>
                  <th>Harga Produk</th>
                  <th>Keterangan Produk</th>
                  <th>Kategori</th>
                  <th>AKSI</th>
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
        <h4 class="modal-title" id="myModalLabel">Add Produk</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Produk/tambah')?>" method="post" enctype="multipart/form-data">
             Nama Produk
             <input type="text" name="nama_produk" class="form-control"><br>
             Nama Petani
             <input type="text" name="nama_petani" class="form-control"><br>
             Foto Cover
             <input type="file" name="foto_cover" class="form-control"><br>
             Stok
             <input type="text" name="stok" class="form-control"><br>
             Kode Produk
             <input type="text" name="kode_pesanan" class="form-control"><br>
             Harga Produk
             <input type="text" name="biaya" class="form-control"><br>
             Keterangan Produk
             <input type="text" name="keterangan_produk" class="form-control"><br>
             Kategori
             <select name="id_kategori" class="form-control">
             <?php foreach($kategori as $kat): ?>
             <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
             <?php endforeach ?>
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

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Produk</h4>
      </div>
      <div class="modal-body">
         <form action="<?=base_url('index.php/Produk/produk_update')?>" method="post" enctype="multipart/form-data">
               <input type="hidden" name="id_produk_lama" id="id_produk_lama">
                <tr>
                  <td><input type="hidden" name="id_produk" id="id_produk" class="form-control"></td>
                </tr>
                <tr>
                  <td>Nama Produk</td>
                  <td><input type="text" id="nama_produk" name="nama_produk" class="form-control"></td>
                </tr><br>
                 <tr>
                  <td>Nama Petani</td>
                  <td><input type="text" id="nama_petani" name="nama_petani" class="form-control"></td>
                </tr><br>
                <tr>
                  <td>Foto Cover</td>
                  <td><input type="file" name="foto_cover" id="foto_cover" class="form-control"></td>
                </tr><br>
                 <tr>
                  <td>Stok</td>
                  <td><input type="text" id="stok" name="stok" class="form-control"></td>
                </tr><br>
                 <tr>
                  <td>Kode Produk</td>
                  <td><input type="text" id="kode_pesanan" name="kode_pesanan" class="form-control"></td>
                </tr><br>
                <tr>
                  <td>Harga Produk</td>
                  <td><input type="text" id="biaya" name="biaya" class="form-control"></td>
                </tr><br>
                <tr>
                  <td>Keterangan Produk</td>
                  <td><input type="text" id="keterangan_produk" name="keterangan_produk" class="form-control"></td>
                </tr><br>
                <tr>
                  <td>Kategori</td>
                  <td> 
                  <select name="id_kategori" class="form-control" id="id_kategori">
                  <?php foreach($kategori as $kat): ?>
                  <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                  <?php endforeach ?>
                  </select></td>
                </tr><br>
                
               
                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
           
<script type="text/javascript">
      function edit(a){
        $.ajax({
          type:"post",
          url:"<?=base_url()?>index.php/Produk/edit_produk/"+a,
          dataType:"json",
          success:function(data){
            $("#id_produk").val(data.id_produk);
            $("#nama_produk").val(data.nama_produk);
            $("#stok").val(data.stok);
            $("#kode_pesanan").val(data.kode_pesanan);
            $("#nama_petani").val(data.nama_petani);
            $("#id_kategori").val(data.id_kategori);
            $("#biaya").val(data.biaya);
            $("#keterangan_produk").val(data.keterangan_produk);
            $("#id_produk_lama").val(data.id_produk);
          }
        })
      }
    </script>
