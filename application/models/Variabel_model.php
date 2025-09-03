<?php

class Variabel_model extends CI_model
{
    public function getAllData()
    {
        return $this->db->get('m_variabel')->result_array();
    }

    public function save($data)
    {
        $this->db->insert('m_variabel', $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('m_variabel');
        return $this->db->affected_rows();
    }

    public function delete_data($id)
    {
        $this->db->where('penghubung_dataset', $id);
        $this->db->delete('m_variabel');
        return $this->db->affected_rows();
    }

    public function show($id)
    {
        $query = $this->db->get_where('m_variabel', ['id' => $id])->row_array();
        return json_encode($query);
    }

    public function edit($id, $param)
    {
        $this->db->where('id', $id);
        $this->db->update('m_variabel', $param);
        return $this->db->affected_rows();
    }

    public function search_dataset($id_penghubung)
    {
        $query = $this->db->get_where('m_variabel', ['penghubung_dataset' => $id_penghubung])->row_array();
        return json_encode($query);
    }
}
