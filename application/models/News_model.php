<?php

class News_model extends CI_model
{

    public function getAllData()
    {
        return $this->db->get('m_berita')->result_array();
    }

    public function getLastData()
    {
        $this->db->limit(1);
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('m_berita')->row_array();
    }

    public function countRows()
    {
        $this->db->where('status_berita', 1);
        return $this->db->get('m_berita')->num_rows();
    }

    public function newNews()
    {
        $query = "SELECT * FROM m_berita WHERE `status_berita` = '1' ORDER BY id DESC limit 4";

        return $this->db->query($query)->result_array();
    }

    public function detailBerita($id)
    {
        return $this->db->get_where('m_berita', ['id' => $id])->row_array();
    }

    public function getPageData($limit, $start, $keyword = null, $year = null)
    {
        if ($keyword and $year == null) {
            $this->db->like('judul_berita', $keyword);
            $this->db->like('status_berita', 1);
        } else if ($year and $keyword == null) {
            $this->db->like('YEAR(tgl_pub)', $year);
            $this->db->like('status_berita', 1);
        } else if ($keyword and $year) {
            $this->db->like('judul_berita', $keyword);
            $this->db->like('YEAR(tgl_pub)', $year);
            $this->db->like('status_berita', 1);
        }
        $this->db->order_by('tgl_berita', 'DESC');
        return $this->db->get_where('m_berita', ['status_berita' => '1'], $limit, $start)->result_array();
    }

    public function getDataById($id)
    {
        $query = $this->db->get_where('m_berita', ['id' => $id])->row_array();
        return json_encode($query);
    }

    public function getNewsLimit()
    {
        $query = "SELECT * FROM m_berita WHERE `status_berita` = '1' ORDER BY created_at DESC limit 4";

        return $this->db->query($query)->result_array();
    }


    public function addData($data)
    {
        $this->db->insert('m_berita', $data);
        return $this->db->affected_rows();
    }

    public function deleteData($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('m_berita', ['id' => $id]);
        return $this->db->affected_rows();
    }


    public function editData($id, $param)
    {

        $this->db->where('id', $id);
        $this->db->update('m_berita', $param);
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

    public function searchDataByKeyword($word, $limit, $start)
    {
        $this->db->like('judul_berita', $word);
        $this->db->where('status_berita', '1');
        $this->db->order_by('tgl_berita', 'DESC');
        $data = $this->db->get('m_berita', $limit, $start)->result_array();

        $this->db->like('judul_berita', $word);
        $this->db->where('status_berita', '1');
        $this->db->from('m_berita');
        $count = $this->db->count_all_results();

        $data =  array(
            'status' => true,
            'data' => $data,
            'count' => $count
        );
        return json_encode($data);
    }
}
