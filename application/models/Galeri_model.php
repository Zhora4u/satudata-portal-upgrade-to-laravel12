<?php

class Galeri_model extends CI_Model
{
    public function getAllData()
    {
        $this->db->select('judul_info, photo, m_galeri.id');
        $this->db->from('m_infografis');
        $this->db->join('m_galeri', 'm_galeri.id_info = m_infografis.id');
        return $this->db->get()->result_array();
    }

    public function getPhoto($id)
    {
        $this->db->where('id_info', $id);
        $this->db->from('m_galeri');
        $result = $this->db->get()->result_array();
        return json_encode($result);
    }

    public function addData($data)
    {
        $this->db->insert('m_galeri', $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('m_galeri');
        return $this->db->affected_rows();
    }
}
