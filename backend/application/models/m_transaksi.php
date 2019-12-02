<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_transaksi extends CI_Model {

	public function cari_produk()
	{
		$data_cart = $this->db->where('produk.kode_pesanan', $this->input->post('kode_pesanan'))
							 
							  ->get('produk')
							  ->row();
		if($data_cart != NULL){

			//cek stok
			if($data_cart->stok > 0){
				$cart_array = array(
								'cart_id'	=> $this->session->userdata('username'),
								'id_produk' 	=> $data_cart->id_produk
							);						
				$this->db->insert('cart',$cart_array);

				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function get_data_produk_by_id($id)
	{
		return $this->db->where('id_produk', $id)
						->get('produk')
						->row();
	}

	public function get_cart()
	{
		return $this->db->join('produk', 'produk.id_produk = cart.id_produk')
                       
                        ->get('cart')
                        ->result();
					    
	}

	public function hapus_item_cart()
	{
		$this->db->where('id', $this->input->post('hapus_id'))
				 ->delete('cart');

		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function ubah_jumlah_cart()
	{
		$data = array(
				'jumlah' => $this->input->post('jumlah')
			);

		//cek stok awal dulu untuk memastikan stok lebih dari jumlah yang dibeli
		$stok_awal = $this->get_data_produk_by_id($this->input->post('id_produk'))->stok;
		if($stok_awal >= $this->input->post('jumlah')){
			$this->db->where('id', $this->input->post('id'))
					 ->update('cart', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_total_belanja()
	{
		return $this->db->select('SUM(produk.biaya*cart.jumlah) as total')
						->where('cart.cart_id', $this->session->userdata('username'))
						->join('produk', 'produk.id_produk = cart.id_produk')
						->get('cart')
						->row()->total;
	}

	public function tambah_transaksi()
	{
		$data_transaksi = array(
				'id_kasir'		=> $this->session->userdata('username'),
				'nama_pemesan'	=> $this->input->post('nama_pemesan')
			);
		$this->db->insert('transaksi', $data_transaksi);
		$last_insert_id = $this->db->insert_id();
		//insert detil transksi
		for($i = 0; $i < count($this->get_cart()); $i++)
		{
			$data_detil_transaksi = array(
				'id_transaksi'	=> $last_insert_id,
				'id_produk'		=> $this->input->post('id_produk')[$i],
				'jumlah'		=> $this->input->post('jumlah')[$i]
			);

			//memasukan ke tabel detil transaksi
			$this->db->insert('detil_transaksi', $data_detil_transaksi);

			//mengurangi stok produk
			$stok_awal = $this->get_data_produk_by_id($this->input->post('id_produk')[$i])->stok;
			$stok_akhir = $stok_awal-$this->input->post('jumlah')[$i];
			$stok = array('stok' => $stok_akhir);
			$this->db->where('id_produk', $this->input->post('id_produk')[$i])
					 ->update('produk', $stok);

		}


		//mengkosongkan cart berdasarkan kasir yang melakukan transaksi
		$this->db->where('cart_id', $this->session->userdata('username'))
				 ->delete('cart');

		return TRUE;

	}

	public function get_riwayat_transaksi()
	{
		return $this->db->select('transaksi.id_transaksi, transaksi.nama_pemesan, transaksi.id_kasir, 
		transaksi.tgl_pesan, (SELECT SUM(detil_transaksi.jumlah*produk.biaya) FROM detil_transaksi 
		JOIN produk ON produk.id_produk = detil_transaksi.id_produk WHERE id_transaksi = transaksi.id_transaksi )
		as total')
						->join('detil_transaksi','detil_transaksi.id_transaksi = transaksi.id_transaksi')
						->join('produk','produk.id_produk = detil_transaksi.id_produk')
						->group_by('id_transaksi')
						->get('transaksi')
						->result();
	}

	public function get_transaksi_by_id($id)
	{
		return $this->db->select('produk.kode_pesanan, produk.nama_produk, produk.nama_petani, 
		produk.biaya, detil_transaksi.jumlah')
						->where('id_transaksi', $id)
						->join('produk','produk.id_produk = detil_transaksi.id_produk')
						->get('detil_transaksi')
						->result();
	}

}

/* End of file m_transaksi.php */
/* Location: ./application/models/m_transaksi.php */