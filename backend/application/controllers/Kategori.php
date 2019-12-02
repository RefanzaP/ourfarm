<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$data['content_view']="v_kategori";
        $this->load->model('m_kategori');
        $data['data_kategori']=$this->m_kategori->get_kategori();
		$this->load->view('v_home', $data, FALSE);
	}
	public function tambah_kategori()
	{
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required',
        array('required' => 'nama Kategori harus diisi'));
        
		if ($this->form_validation->run() == TRUE )
		{
			$this->load->model('m_kategori', 'lvl');
			$masuk=$this->lvl->masuk_db();
			if($masuk==true){
				$this->session->set_flashdata('pesan', 'sukses masuk');
			} else{
				$this->session->set_flashdata('pesan', 'gagal masuk');
			}
			redirect(base_url('index.php/Kategori'), 'refresh');
		}
		else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/Kategori'), 'refresh');
		}
	}
		public function get_detail_kategori($id_kategori='')
		{
			$this->load->model('m_kategori');
			$data_detail=$this->m_kategori->detail_kategori($id_kategori);
			echo json_encode($data_detail);
		}

		public function update_kategori()
		{
			$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
			if ($this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('pesan', validation_errors());
				redirect(base_url('index.php/Kategori'), 'refresh');
			} else{
				$this->load->model('m_kategori');
				$proses_update=$this->m_kategori->update_kategori();
				if ($proses_update) {
					$this->session->set_flashdata('pesan', 'sukses update');
				}
				else {
					$this->session->set_flashdata('pesan', 'gagal update');
				}
				redirect(base_url('index.php/Kategori'), 'refresh');
			} 
		}

		public function hapus_kategori($id_kategori)
	{
		$this->load->model('m_kategori');
		$this->m_kategori->hapus_kategori($id_kategori);
		redirect(base_url('index.php/Kategori'), 'refresh');
	}
}
