<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_kategori extends CI_Model {

  public function get_kategori()
  {
      $data_kategori= $this->db->get('kategori')->result();
      return $data_kategori;
  }
  public function masuk_db()
  {
    $data_kategori=array(
      'nama_kategori'=>$this->input->post('nama_kategori'),
    );
    $ql_masuk=$this->db->insert('kategori', $data_kategori);
    return $ql_masuk;
  }
  public function detail_kategori($id_kategori='')
{
  return $this->db->where('id_kategori', $id_kategori)->get('kategori')->row();
  }

   public function update_kategori()
  {
    $dt_up_kategori=array(
		'nama_kategori'=>$this->input->post('nama_kategori'),
    );
  return $this->db->where('id_kategori',$this->input->post('id_kategori'))->update('kategori', $dt_up_kategori);
  }
  public function hapus_kategori($id_kategori)
  {
    $this->db->where('id_kategori', $id_kategori);
     return $this->db->delete('kategori');
  }  
}

