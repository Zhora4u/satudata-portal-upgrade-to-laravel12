<?php

class Data_model extends CI_model
{
    public function getAllData()
    {
        return $this->db->get('m_dataset')->result_array();
    }

    public function save($data)
    {
        $this->db->insert('m_dataset', $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('m_dataset');
        return $this->db->affected_rows();
    }

    public function show($id)
    {
        $query = $this->db->get_where('m_dataset', ['id' => $id])->row_array();
        return json_encode($query);
    }

    public function edit($id, $param)
    {

        $this->db->where('id', $id);
        $this->db->update('m_dataset', $param);
        return $this->db->affected_rows();
    }

    public function update_variabel($field, $id, $penghubung)
    {
        $data = array(
            'penghubung_variabel' => $penghubung,
        );

        $this->db->where($field, $id);
        $this->db->update('m_dataset', $data);
    }

    public function update_indikator($field, $id, $penghubung)
    {
        $data = array(
            'penghubung_indikator' => $penghubung,
        );

        $this->db->where($field, $id);
        $this->db->update('m_dataset', $data);
    }

    public function update_kegiatan($field, $id, $penghubung)
    {
        $data = array(
            'penghubung_kegiatan' => $penghubung,
        );

        $this->db->where($field, $id);
        $this->db->update('m_dataset', $data);
    }

    public function update_data($field, $id, $penghubung)
    {
        $data = array(
            'penghubung_data' => $penghubung,
        );

        $this->db->where($field, $id);
        $this->db->update('m_dataset', $data);
    }
}
