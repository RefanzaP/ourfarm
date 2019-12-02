<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function user_check()
    {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $query = $this->db->join('level', 'level.id_level = user.id_level')
                        ->where('username', $username)
                        ->where('password', $password)
                        ->get('user');

      if($query->num_rows() > 0)
      {
        $data_login = $query->row();
        $data_session = array(
                          'username'  => $username,
                          'id_level'     => $data_login->nama_level,
                          'login_status'  => TRUE

                        );

        $this->session->set_userdata($data_session);

        return true;
      }
      else
      {
        return false;
      }
    }

}

/* End of file m_login.php */
/* Location: ./application/models/m_login.php */