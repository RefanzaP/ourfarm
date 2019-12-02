<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {

	public function index()
	{
		$data['content_view']="v_distributor";
        $this->load->model('m_distributor');
		$data['data_distributor']=$this->m_distributor->get_user(3);
		$this->load->model('m_level');
		$data['data_level']=$this->m_level->get_level();
		$this->load->view('v_home', $data, FALSE);
	}
	public function tambah_distributor()
	{
        $this->form_validation->set_rules('username', 'Username', 'trim|required',
        array('required' => 'Username harus diisi'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required',
        array('required' => 'Password harus diisi'));
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required',
        array('required' => 'Nama Distributor harus diisi'));
        $this->form_validation->set_rules('tlpn', 'tlpn', 'trim|required',
        array('required' => 'Telepon harus diisi'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required',
        array('required' => 'Telepon harus diisi'));
		$this->form_validation->set_rules('id_level', 'Id Level', 'trim|required',
        array('required' => 'Id Level harus diisi'));
        
		if ($this->form_validation->run() == TRUE )
		{
			$this->load->model('m_distributor', 'lvl');
			$masuk=$this->lvl->masuk_db();
			if($masuk==true){
				$this->session->set_flashdata('pesan', 'sukses masuk');
			} else{
				$this->session->set_flashdata('pesan', 'gagal masuk');
			}
			redirect(base_url('index.php/Distributor'), 'refresh');
		}
		else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/Distributor'), 'refresh');
		}
	}
		public function get_detail_distributor($id_user='')
		{
			$this->load->model('m_distributor');
			$data_detail=$this->m_distributor->detail_distributor($id_user);
			echo json_encode($data_detail);
		}

		public function update_distributor()
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('tlpn', 'tlpn', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('id_level', 'Id Level', 'trim|required');
			if ($this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('pesan', validation_errors());
				redirect(base_url('index.php/Distributor'), 'refresh');
			} else{
				$this->load->model('m_distributor');
				$proses_update=$this->m_distributor->update_distributor();
				if ($proses_update) {
					$this->session->set_flashdata('pesan', 'sukses update');
				}
				else {
					$this->session->set_flashdata('pesan', 'gagal update');
				}
				redirect(base_url('index.php/Distributor'), 'refresh');
			} 
		}

		public function hapus_distributor($id_user)
	{
		$this->load->model('m_distributor');
		$this->m_distributor->hapus_distributor($id_user);
		redirect(base_url('index.php/Distributor'), 'refresh');
	}
}
