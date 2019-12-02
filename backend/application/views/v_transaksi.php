<h3 class="page-title">Transaksi Pemesanan Produk</h3><br>

		<?php
			$pesan = $this->session->flashdata('pesan');
			if($pesan != NULL){
				echo '
					<div class="alert alert-danger">'.$pesan.'</div>
				';
			}
		?>

		<div class="row">
			<div class="col-md-12">
				<!-- TABLE STRIPED -->
				<div class="panel">
					<div class="panel-heading">CARI PRODUK</div>
					<div class="panel-body">
						<form action="<?php echo base_url('index.php/Transaksi/cari_produk') ?>" method="post">
							<div class="row">
								<div class="col-md-9">
									<input type="text" class="form-control input-lg" placeholder="kode" name="kode_pesanan" required>
								</div>
								<div class="col-md-3">
									<input type="submit" class="btn btn-info btn-lg btn-primary" name="submit" value="TAMBAH">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<!-- TABLE STRIPED -->
				<div class="panel">
					<div class="panel-heading">KERANJANG PESANAN</div>
					<div class="panel-body">

						<form action="<?php echo base_url('index.php/Transaksi/pesan'); ?>" method="post">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>kode</th>
										<th>Nama Produk</th>
										<th>Nama Petani</th>
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Sub Total</th>
										<th>AKSI</th>
									</tr>
								</thead>
								<tbody>
								
								<?php
									$no = 1;
									if($cart_transaksi != NULL){
										foreach ($cart_transaksi as $cart) {

											echo '
												<tr>
													<input type="hidden" name="id_produk[]" value="'.$cart->id_produk.'">
                                                    <td>'.$no.'</td>
                                                    <td>'.$cart->kode_pesanan.'</td>
                                                    <td>'.$cart->nama_produk.'</td>
													<td>'.$cart->nama_petani.'</td>
                                                    <td>'.$cart->biaya.'</td>
                                                  
													
													<td>
														<input type="number" min="1" max="5" name="jumlah[]" class="form-control" onchange="hitung_subtotal('.$cart->id.','.$cart->biaya.',this.value,'.$cart->id_produk.')" value="'.$cart->jumlah.'">
													</td>
													<td><span id="subtot_'.$cart->id.'">'.$cart->biaya*$cart->jumlah.'</span></td>
													<td>
														<a href="#" class="btn btn-info btn-danger" data-toggle="modal" data-target="#modal_hapus_cart" onclick="prepare_hapus_cart('.$cart->id.')">Hapus</a>
													</td>
												</tr>
											';
											$no++;
										}
									} else {
										echo '
											<tr>
												<td colspan="8">
													Keranjang pemesanan kosong.
												</td>
											</tr>
										';
									}
								?>
								</tbody>
							</table>
							<?php
								if($cart_transaksi != NULL)
								{
									echo '
											<div class="row">
											<div class="col-md-4">
												<h1 style="margin:0">Rp <span id="total_belanja">0</span>,-</h1>
											</div> 

											<div class="col-md-5">
												<input type="text" name="nama_pemesan" placeholder="NAMA PEMESAN" class="form-control input-lg" required>
											</div>
								
											<div class="col-md-3">
												<input type="submit" name="submit" value="PESAN" class="btn btn-lg btn-block btn-success">
											</div>

										';
								} 
							?>
						</form>

					</div>
				</div>
				<!-- END TABLE STRIPED -->
			</div>
		</div>
	</div>
</div>

<div id="modal_hapus_cart" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus Item Cart</h4>
      </div>
      <form action="<?php echo base_url('index.php/Transaksi/hapus_item_cart'); ?>" method="post">
	      <div class="modal-body">
	        	<input type="hidden" name="hapus_id"  id="hapus_id">
	        	<p>Apakah anda yakin menghapus produk ini di cart ?</p>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" class="btn btn-danger" name="submit" value="YA">
	        <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
	      </div>
      </form>
    </div>

  </div>
</div>

<script type="text/javascript" src="<?php echo base_url('./assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript">
	$.getJSON("<?php echo base_url('index.php/Transaksi/get_total_belanja') ?>", function(data){
        $("#total_belanja").text(data.total);
    });

	function prepare_hapus_cart(id)
	{
		$("#hapus_id").val(id);
	}

	function hitung_subtotal(id,biaya,qty,id_produk)
	{
		var price;
		price = biaya*qty;
		$("#subtot_"+id).text(price);
		//update qty ke tabel cart
		$.post("<?php echo base_url('index.php/Transaksi/ubah_jumlah_cart') ?>",
	    {
	    	id: id,
	    	id_produk: id_produk,
	        jumlah: qty
	    }, function(data, status){
	    	console.log(data);
	    	if(data == '0'){
	    		alert("Stok produk tidak mencukupi!");
	    	}
	    });
		//mengganti total belanja di cart
	    $.getJSON("<?php echo base_url('index.php/Transaksi/get_total_belanja') ?>", function(data){
	        $("#total_belanja").text(data.total);
	    });
	}
</script>
