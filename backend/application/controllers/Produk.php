<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_produk','produk');
	}

	public function index()
	{
		$data['tampil_produk']=$this->produk->tampil();
		$data['kategori']=$this->produk->data_kategori();
		$data['content_view']="v_produk";
		$this->load->view('v_home', $data);
	}
	public function produk()
	{
		$data['tampil_produk']=$this->produk->tampil();
		$data['kategori']=$this->produk->data_kategori();
		$data['content_view']="v_produk";
		$this->load->view('v_home', $data);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('nama_produk', 'nama_produk', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');
		$this->form_validation->set_rules('nama_petani', 'nama_petani', 'trim|required');
		$this->form_validation->set_rules('kode_pesanan', 'kode_pesanan', 'trim|required');
		$this->form_validation->set_rules('biaya', 'biaya', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');
		$this->form_validation->set_rules('keterangan_produk', 'keterangan_produk', 'trim|required');
		if ($this->form_validation->run()==TRUE) {
			$config['upload_path'] = './assets/produk/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '10000000';
			$config['max_width']  = '5000';
			$config['max_height']  = '5000';
			if ($_FILES['foto_cover']['name']!="") {
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('foto_cover')) {
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
				}else {
					if ($this->produk->simpan_produk($this->upload->data('file_name'))) {
						$this->session->set_flashdata('pesan', 'Sukses menambah ');
					}else{
						$this->session->set_flashdata('pesan', 'Gagal menambah');
					}
					redirect('Produk','refresh');
				}
			}else{
				if ($this->produk->simpan_produk('')) {
					$this->session->set_flashdata('pesan', 'Sukses menambah');
				}else{
					$this->session->set_flashdata('pesan', 'Gagal menambah');
				}
				redirect('Produk','refresh');
			}

		}else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('Produk','refresh');
		}
	}
	public function edit_produk($id)
	{
		$data=$this->produk->detail($id);
		echo json_encode($data);
	}
	public function produk_update()
	{
		if($this->input->post()){
			
			if($_FILES['foto_cover']['name']==""){
				if($this->produk->edit_produk()){
					$this->session->set_flashdata('pesan', 'Sukses update');
					redirect('Produk');
				} else {
					$this->session->set_flashdata('pesan', 'Gagal update');
					redirect('Produk');
				}
			} else {
				$config['upload_path'] = './assets/produk/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '10000000';
				$config['max_width']  = '5000';
				$config['max_height']  = '5000';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('foto_cover')){
					$this->session->set_flashdata('pesan', 'Gagal Upload');
					redirect('Produk');
				}
				else{
					if($this->produk->edit_produk_dengan_foto($this->upload->data('file_name'))){
						$this->session->set_flashdata('pesan', 'Sukses update');
						redirect('Produk');
					} else {
						$this->session->set_flashdata('pesan', 'Gagal update');
						redirect('Produk');
					}
				}
			}

		}
		redirect('Produk');

	}
	public function hapus($id_produk='')
	{
		if ($this->produk->hapus_produk($id_produk)) {
			$this->session->set_flashdata('pesan', 'Sukses Hapus');
			redirect('Produk','refresh');
		}else{
			$this->session->set_flashdata('pesan', 'Gagal Hapus');
			redirect('Produk','refresh');
		}
	}

}

