<?php

class Info_model extends CI_model
{

    public function getAllData()
    {
        return $this->db->get('m_infografis')->result_array();
    }

    public function getLastData()
    {
        $this->db->limit(1);
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('m_infografis')->row_array();
    }

    public function getDataById($id)
    {
        $query = $this->db->get_where('m_infografis', ['id' => $id])->row_array();
        return json_encode($query);
    }

    public function getDataByStatus()
    {
        $query = "SELECT * FROM m_infografis WHERE `status_info` = '1' ORDER BY created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function getTitleData()
    {
        $this->db->select('id, judul_info');
        $this->db->from('m_infografis');
        $this->db->where('status_info', 1);
        return $this->db->get()->result_array();
    }

    public function getInfoLimit()
    {
        $query = "SELECT * FROM m_infografis WHERE `status_info` = '1' ORDER BY created_at DESC limit 20";

        return $this->db->query($query)->result_array();
    }

    public function getCountInfo()
    {
        $this->db->where('status_info', '1');
        $this->db->from('m_infografis');
        return $this->db->count_all_results();
    }

    public function addData($data)
    {
        $this->db->insert('m_infografis', $data);
        return $this->db->affected_rows();
    }

    public function deleteData($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('m_infografis', ['id' => $id]);
        return $this->db->affected_rows();
    }


    public function editData($id, $param)
    {

        $this->db->where('id', $id);
        $this->db->update('m_infografis', $param);
        return $this->db->affected_rows();
    }

    public function cariDataUser()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }

    public function addKontak($data)
    {
        $this->db->insert('m_kontak', $data);
        return $this->db->affected_rows();
    }

    public function getPageData($limit, $start, $keyword = null, $year = null)
    {
        if ($keyword and $year == null) {
            $this->db->like('judul_info', $keyword);
            $this->db->like('status_info', 1);
        } else if ($year and $keyword == null) {
            $this->db->like('YEAR(tgl_info)', $year);
            $this->db->like('status_info', 1);
        } else if ($keyword and $year) {
            $this->db->like('judul_info', $keyword);
            $this->db->like('YEAR(tgl_info)', $year);
            $this->db->like('status_info', 1);
        }
        $this->db->order_by('tgl_info', 'DESC');
        return $this->db->get_where('m_infografis', ['status_info' => '1'], $limit, $start)->result_array();
    }

    public function unduh($nama_file)
    {
        return $this->db->get_where('m_infografis', ['file_info' => $nama_file])->row();
    }

    public function searchDataByKeyword($word, $limit, $start)
    {
        $this->db->like('judul_info', $word);
        $this->db->where('status_info', '1');
        $this->db->order_by('tgl_info', 'DESC');
        $data = $this->db->get('m_infografis', $limit, $start)->result_array();

        $this->db->like('judul_info', $word);
        $this->db->where('status_info', '1');
        $this->db->from('m_infografis');
        $count = $this->db->count_all_results();

        $data =  array(
            'status' => true,
            'data' => $data,
            'count' => $count
        );
        return json_encode($data);
    }
}
