<?php
class Link_model extends CI_Model
{
    public function getAllDataActive()
    {
        return $this->db->get_where('m_link', ['status_link' => 1])->result_array();
    }

    public function getAllData()
    {
        return $this->db->get('m_link')->result_array();
    }

    public function addData($data)
    {
        $this->db->insert('m_link', $data);
        return $this->db->affected_rows();
    }

    public function getDataById($id)
    {
        $data = $this->db->get_where('m_link', ['id' => $id])->row_array();
        return json_encode($data);
    }

    public function editData($id, $param)
    {
        $this->db->where('id', $id);
        $this->db->update('m_link', $param);
        return $this->db->affected_rows();
    }
}
