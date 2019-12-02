<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_produk extends CI_Model {

    public function tampil()
    {
        $tm_produk=$this->db
                      ->join('kategori','kategori.id_kategori=produk.id_kategori')
                      ->get('produk')
                      ->result();
        return $tm_produk;
    }
    public function data_kategori()
    {
        return $this->db->get('kategori')
                        ->result();
    }
   
    public function simpan_produk($file_cover)
    {
        if ($file_cover=="") {
             $object = array(
                'id_produk' => $this->input->post('id_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'kode_pesanan' => $this->input->post('kode_pesanan'),
                'stok' => $this->input->post('stok'),
                'id_kategori' => $this->input->post('id_kategori'),
                'nama_petani' => $this->input->post('nama_petani'),
                'biaya' => $this->input->post('biaya'),
                'keterangan_produk' => $this->input->post('keterangan_produk')
             );
        }else{
            $object = array(
               'id_produk' => $this->input->post('id_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'kode_pesanan' => $this->input->post('kode_pesanan'),
                'stok' => $this->input->post('stok'),
                'id_kategori' => $this->input->post('id_kategori'),
                'nama_petani' => $this->input->post('nama_petani'),
                'biaya' => $this->input->post('biaya'),
                'keterangan_produk' => $this->input->post('keterangan_produk'),
              	'foto_cover' => $file_cover
             );
        }
        return $this->db->insert('produk', $object);
    }
    public function detail($a)
    {
        $tm_produk=$this->db
                      ->join('kategori', 'kategori.id_kategori=produk.id_kategori')
                      ->where('id_produk', $a)
                      ->get('produk')
                      ->row();
        return $tm_produk;
    }
    public function edit_produk()
    {
        $data = array(
          		'id_produk' => $this->input->post('id_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'kode_pesanan' => $this->input->post('kode_pesanan'),
                'stok' => $this->input->post('stok'),
                'id_kategori' => $this->input->post('id_kategori'),
                'nama_petani' => $this->input->post('nama_petani'),
                'biaya' => $this->input->post('biaya'),
                'keterangan_produk' => $this->input->post('keterangan_produk')

            );

        return $this->db->where('id_produk', $this->input->post('id_produk_lama'))
                        ->update('produk', $data);
    }
    public function edit_produk_dengan_foto($file_cover)
    {
        $data = array(
          		'id_produk' => $this->input->post('id_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'kode_pesanan' => $this->input->post('kode_pesanan'),
                'stok' => $this->input->post('stok'),
                'id_kategori' => $this->input->post('id_kategori'),
                'nama_petani' => $this->input->post('nama_petani'),
                'biaya' => $this->input->post('biaya'),
                'keterangan_produk' => $this->input->post('keterangan_produk'),
          		'foto_cover' => $file_cover

            );

        return $this->db->where('id_produk', $this->input->post('id_produk_lama'))
                        ->update('produk', $data);
    }
    public function hapus_produk($id_produk='')
    {
        return $this->db->where('id_produk', $id_produk)
                    ->delete('produk');
    }


}

