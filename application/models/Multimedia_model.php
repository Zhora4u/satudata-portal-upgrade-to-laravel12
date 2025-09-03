<?php

class Multimedia_model extends CI_model
{

    public function getAllData()
    {
        return $this->db->get('m_multimedia')->result_array();
    }

    public function getLastData()
    {
        $this->db->limit(1);
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('m_multimedia')->row_array();
    }

    public function getDataById($id)
    {
        $query = $this->db->get_where('m_multimedia', ['id' => $id])->row_array();
        return json_encode($query);
    }

    public function getDataByStatus()
    {
        $query = "SELECT * FROM m_multimedia WHERE `status_media` = '1' ORDER BY created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function getVideo()
    {
        $query = "SELECT * FROM m_multimedia WHERE `jenis_media` = 'video' and `status_media` = '1' ORDER BY tgl_media DESC limit 6";
        return $this->db->query($query)->result_array();
    }

    public function getAllVideo($limit, $start, $keyword = null, $year = null)
    {
        if ($keyword and $year == null) {
            $this->db->like('judul_media', $keyword);
            $this->db->like('status_media', 1);
        } else if ($year and $keyword == null) {
            $this->db->like('YEAR(tgl_media)', $year);
            $this->db->like('status_media', 1);
        } else if ($keyword and $year) {
            $this->db->like('judul_media', $keyword);
            $this->db->like('YEAR(tgl_media)', $year);
            $this->db->like('status_media', 1);
        }
        $this->db->where('jenis_media', 'video');
        $this->db->order_by('tgl_media', 'DESC');
        return $this->db->get_where('m_multimedia', ['status_media' => '1'], $limit, $start)->result_array();
    }

    public function getFoto()
    {
        $query = "SELECT * FROM m_multimedia WHERE `jenis_media` = 'foto' and `status_media` = '1' ORDER BY created_at DESC limit 8";
        return $this->db->query($query)->result_array();
    }

    public function getAllFoto($limit, $start, $keyword = null, $year = null)
    {
        if ($keyword and $year == null) {
            $this->db->like('judul_media', $keyword);
            $this->db->like('status_media', 1);
        } else if ($year and $keyword == null) {
            $this->db->like('YEAR(tgl_media)', $year);
            $this->db->like('status_media', 1);
        } else if ($keyword and $year) {
            $this->db->like('judul_media', $keyword);
            $this->db->like('YEAR(tgl_media)', $year);
            $this->db->like('status_media', 1);
        }
        $this->db->where('jenis_media', 'foto');
        $this->db->order_by('tgl_media', 'DESC');
        return $this->db->get_where('m_multimedia', ['status_media' => '1'], $limit, $start)->result_array();
    }

    public function getFotoWithoutLimit()
    {
        $this->db->where('jenis_media', 'foto');
        return $this->db->get('m_multimedia')->result_array();
    }

    public function getVideoWithoutLimit()
    {
        $this->db->where('jenis_media', 'video');
        return $this->db->get('m_multimedia')->result_array();
    }

    public function countRowsFoto()
    {
        $this->db->where('jenis_media', 'foto');
        $this->db->where('status_media', 1);
        $this->db->from('m_multimedia');
        return $this->db->get()->num_rows();
    }

    public function countRowsVideo()
    {
        $this->db->where('jenis_media', 'video');
        $this->db->where('status_media', 1);
        $this->db->from('m_multimedia');
        return $this->db->get()->num_rows();
    }

    public function addData($data)
    {
        $this->db->insert('m_multimedia', $data);
        return $this->db->affected_rows();
    }

    public function deleteData($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('m_multimedia', ['id' => $id]);
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
            $this->db->like('judul_media', $keyword);
            $this->db->like('status_media', 1);
        } else if ($year and $keyword == null) {
            $this->db->like('YEAR(tgl_media)', $year);
            $this->db->like('status_media', 1);
        } else if ($keyword and $year) {
            $this->db->like('judul_media', $keyword);
            $this->db->like('YEAR(tgl_media)', $year);
            $this->db->like('status_media', 1);
        }
        $this->db->order_by('tgl_media', 'DESC');
        return $this->db->get_where('m_multimedia', ['status_media' => '1'], $limit, $start)->result_array();
    }

    public function unduh($nama_file)
    {
        return $this->db->get_where('m_multimedia', ['file_media' => $nama_file])->row();
    }
}
