<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_distributor extends CI_Model {

	public function get_user($parameter = null)
    {
      $this->db->join('level', 'level.id_level = user.id_level');
      if(!empty($parameter)) {
        $this->db->where('user.id_level', $parameter);
      }
      return $this->db->get('user')->result();

    }

     public function masuk_db()
  {
    $data_distributor=array(
      'username'=>$this->input->post('username'),
      'password'=>$this->input->post('password'),
      'nama'=>$this->input->post('nama'),
      'tlpn'=>$this->input->post('tlpn'),
      'email'=>$this->input->post('email'),
      'id_level'=>$this->input->post('id_level'),
    );
    $ql_masuk=$this->db->insert('user', $data_distributor);
    return $ql_masuk;
  }
  public function detail_distributor($id_user='')
  {
  return $this->db->where('id_user', $id_user)->get('user')->row();
  }

   public function update_distributor()
  {
    $dt_up_distributor=array(
     'username'=>$this->input->post('username'),
      'password'=>$this->input->post('password'),
       'nama'=>$this->input->post('nama'),
      'tlpn'=>$this->input->post('tlpn'),
      'email'=>$this->input->post('email'),
      'id_level'=>$this->input->post('id_level'),

    );
  return $this->db->where('id_user',$this->input->post('id_user'))->update('user', $dt_up_distributor);
  }
  public function hapus_distributor($id_user)
  {
    $this->db->where('id_user', $id_user);
     return $this->db->delete('user');
  }

}

/* End of file m_admin.php */
/* Location: ./application/models/m_admin.php */