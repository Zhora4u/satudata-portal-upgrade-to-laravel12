<?php

class Pub_model extends CI_model
{

    public function getAllData()
    {
        return $this->db->get('m_publikasi')->result_array();
    }

    public function getLastData()
    {
        $this->db->limit(1);
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('m_publikasi')->row_array();
    }

    public function getDataById($id)
    {
        $query = $this->db->get_where('m_publikasi', ['id' => $id])->row_array();
        return json_encode($query);
    }

    public function detailPublikasi($id)
    {
        return $this->db->get_where('m_publikasi', ['id' => $id])->row_array();
    }

    public function getDataByStatus()
    {
        return $this->db->get_where('m_publikasi', ['status_pub' => '1'])->result_array();
    }

    public function countRows()
    {
        return $this->db->get_where('m_publikasi', ['status_pub' => '1'])->num_rows();
    }

    public function searchDataByKeyword($word, $limit, $start)
    {
        $this->db->like('judul_pub', $word);
        $this->db->where('status_pub', '1');
        $this->db->order_by('tgl_pub', 'DESC');
        $data = $this->db->get('m_publikasi', $limit, $start)->result_array();

        $this->db->like('judul_pub', $word);
        $this->db->where('status_pub', '1');
        $this->db->from('m_publikasi');
        $count = $this->db->count_all_results();

        $data =  array(
            'status' => true,
            'data' => $data,
            'count' => $count
        );
        return json_encode($data);
    }

    public function getPageData($limit, $start, $keyword = null, $year = null)
    {
        if ($keyword and $year == null) {
            $this->db->like('judul_pub', $keyword);
            $this->db->like('status_pub', 1);
        } else if ($year and $keyword == null) {
            $this->db->like('YEAR(tgl_pub)', $year);
            $this->db->like('status_pub', 1);
        } else if ($keyword and $year) {
            $this->db->like('judul_pub', $keyword);
            $this->db->like('YEAR(tgl_pub)', $year);
            $this->db->like('status_pub', 1);
        }
        $this->db->order_by('tgl_pub', 'DESC');
        return $this->db->get_where('m_publikasi', ['status_pub' => '1'], $limit, $start)->result_array();
    }

    public function getDataLimit()
    {
        $query = "SELECT * FROM m_publikasi WHERE `status_pub` = '1' ORDER BY created_at DESC limit 12";

        return $this->db->query($query)->result_array();
    }

    public function getCountPub()
    {
        $this->db->where('status_pub', '1');
        $this->db->from('m_publikasi');
        return $this->db->count_all_results();
    }

    public function addData($data)
    {
        $this->db->insert('m_publikasi', $data);
        return json_encode($this->db->insert_id());
    }

    public function deleteData($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('m_publikasi', ['id' => $id]);
        return $this->db->affected_rows();
    }


    public function editData($id, $param)
    {

        $this->db->where('id', $id);
        $this->db->update('m_publikasi', $param);
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
}
