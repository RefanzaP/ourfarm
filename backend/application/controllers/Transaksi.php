<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
	}

    public function index()
    {
        if($this->session->userdata('login_status') == TRUE){

        $data['content_view'] ="v_transaksi";
       //get cart
       $data['cart_transaksi']=$this->m_transaksi->get_cart();
       $this->load->view('v_home', $data);
       
        } else{
            redirect('v_user');
        }

       

    }
	public function cari_produk()
	{
		if($this->session->userdata('login_status') == TRUE){

			if($this->m_transaksi->cari_produk() == TRUE)
			{
				redirect('transaksi/index');
			} else {
				$this->session->set_flashdata('pesan', 'Data produk tidak ditemukan atau stok sudah habis!');
				redirect('transaksi/index');
			}

		} else {
			redirect('login/index');
		}
	}

	public function hapus_item_cart()
	{
		if($this->session->userdata('login_status') == TRUE){

			if($this->m_transaksi->hapus_item_cart() == TRUE)
			{
				redirect('transaksi/index');
			} else {
				$this->session->set_flashdata('pesan', 'Hapus item cart gagal');
				redirect('transaksi/index');
			}

		} else {
			redirect('login/index');
		}
	}

	public function ubah_jumlah_cart()
	{
		if($this->session->userdata('login_status') == TRUE){

			if($this->m_transaksi->ubah_jumlah_cart() == TRUE){
				echo json_encode(1);
			} else {
				echo json_encode(0);
			}
		} else {
			redirect('login/index');
		}
	}

	public function get_total_belanja()
	{
		if($this->session->userdata('login_status') == TRUE){

			$total_belanja['total'] = $this->m_transaksi->get_total_belanja();
			echo json_encode($total_belanja);

		} else {
			redirect('login/index');
		}
	}

	public function pesan()
	{
		if($this->session->userdata('login_status') == TRUE){

			//insert ke tabel transaksi dulu
			if($this->m_transaksi->tambah_transaksi() == TRUE)
			{
				$this->session->set_flashdata('pesan', 'Proses pembelian berhasil');
				redirect('transaksi/index');

			} else {
				$this->session->set_flashdata('pesan', 'Proses pembelian gagal');
				redirect('transaksi/index');
			}

		} else {
			redirect('login/index');
		}
	}

	public function riwayat()
	{
		if($this->session->userdata('login_status') == TRUE){
			$data['content_view'] = 'riwayat_transaksi';
			$data['riwayat'] = $this->m_transaksi->get_riwayat_transaksi();

			$this->load->view('v_home', $data);
		} else {
			redirect('login/index');
		}
	}

	public function get_detil_transaksi_by_id($id)
	{
		if($this->session->userdata('login_status') == TRUE){
			$detil_transaksi = $this->m_transaksi->get_transaksi_by_id($id);
			$data['show_detil'] = "";
			$total = 0;
			$no = 1;
			$data['show_detil'] .= '<table class="table table-striped">
									<tr>
										<th>No</th>
										<th>kode</th>
										<th>Nama Produk</th>
										<th>Nama Petani</th>
										
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Sub Total</th>
									</tr>';

			foreach ($detil_transaksi as $d) {
				$data['show_detil'] .= '<tr>
									<td>'.$no.'</td>
									<td>'.$d->kode_pesanan.'</td>
									<td>'.$d->nama_produk.'</td>
									<td>'.$d->nama_petani.'</td>
									
									<td>'.$d->biaya.'</td>
									<td>'.$d->jumlah.'</td>
									<td>'.$d->biaya*$d->jumlah.'</td>
								</tr>';

				$no++;
				$total += $d->biaya*$d->jumlah;
			}
			$data['show_detil'] .= '</table>';
			$data['show_detil'] .= '<h3><p class="text-right">Total Harga:</p></h3>
									<h2><p class="text-right">Rp '.$total.',- </p></h2>';
			echo json_encode($data);
		} else {
			redirect('login/index');
		}
	}

	public function cetak_nota()
	{
		$this->load->view('cetak_nota_view');
	}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */