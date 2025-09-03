<?php

class Meta_model extends CI_model
{

    public function getAllData()
    {
        if ($this->session->userdata('role') == 5) {
            $this->db->where('unker', substr($this->session->userdata('kodeunker'), 0, 4) . '000000');
        }
        $this->db->order_by('tgl_rilis', 'DESC');
        return $this->db->get('m_metadata')->result_array();
    }

    public function getDetailMetadata($id)
    {
        $this->db->where('id', $id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('m_metadata')->row_array();
    }

    public function getDetailStatus($id)
    {
        $query = "select *, SUBSTRING(a.created_at from 1 for 10) as tanggal, SUBSTRING(a.created_at from 12 for 8) as waktu from trx_status_metadata a join user_role b on a.role_status = b.id 
        where a.id_metadata = '" . $id . "' ORDER BY a.created_at DESC";
        return  $this->db->query($query)->result_array();
    }

    public function getGroupTglDtlSts($id)
    {
        $query = "SELECT SUBSTRING(created_at from 1 for 10) as tanggal from trx_status_metadata where id_metadata = '" . $id . "'
        GROUP BY tanggal";
        return  $this->db->query($query)->result_array();
    }

    public function getAllVerData()
    {
        $query = "SELECT * FROM m_metadata WHERE tagging_data IN('1','2','3')  ORDER BY created_at DESC";
        return  $this->db->query($query)->result_array();
    }

    public function getDataById($id)
    {
        $query = $this->db->get_where('m_metadata', ['id' => $id])->row_array();
        return json_encode($query);
    }

    public function getDataByStatus()
    {
        $query = $this->db->get_where('m_metadata', ['status' => 0])->result_array();
        return $query;
    }

    public function searchDataByKeyword($word, $limit, $start)
    {
        $this->db->like('judul', $word);
        $this->db->order_by('tgl_rilis', 'DESC');
        $data = $this->db->get('m_metadata', $limit, $start)->result_array();

        $this->db->like('judul', $word);
        $this->db->from('m_metadata');
        $count = $this->db->count_all_results();

        $data =  array(
            'status' => true,
            'data' => $data,
            'count' => $count
        );
        return json_encode($data);
    }


    public function getDataLimit()
    {
        $query = "SELECT * FROM m_metadata WHERE `status` = '1' ORDER BY tgl_rilis DESC limit 5";

        return $this->db->query($query)->result_array();
    }

    public function getCountMeta()
    {
        $this->db->where('status', '1');
        $this->db->from('m_metadata');
        return $this->db->count_all_results();
    }

    public function addData($data)
    {
        $this->db->insert('m_metadata', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function unduh($nama_file)
    {
        return $this->db->get_where('m_metadata', ['file_statistik' => $nama_file])->row();
    }

    public function deleteData($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('m_metadata', ['id' => $id]);
        return $this->db->affected_rows();
    }


    public function editData($id, $param)
    {

        $this->db->where('id', $id);
        $this->db->update('m_metadata', $param);
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

    public function addStatusMetadata($data)
    {
        $this->db->insert('trx_status_metadata', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function search_dataset($id_penghubung)
    {
        $query = $this->db->get_where('m_metadata', ['penghubung_dataset' => $id_penghubung])->row_array();
        return json_encode($query);
    }

    public function delete_data($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('m_metadata', ['penghubung_dataset' => $id]);
        return $this->db->affected_rows();
    }

    public function joinAllTable()
    {
        return $this->db->query('SELECT m_metadata.judul, m_metadata.tgl_rilis, m_metadata.kategori, m_metadata.id, m_metadata.created_at FROM m_metadata UNION SELECT m_berita.judul_berita, m_berita.tgl_berita, m_berita.kategori, m_berita.id, m_berita.created_at  FROM m_berita UNION SELECT m_publikasi.judul_pub, m_publikasi.tgl_pub, m_publikasi.kategori, m_publikasi.id, m_publikasi.created_at  FROM m_publikasi UNION SELECT m_multimedia.judul_media, m_multimedia.tgl_media, m_multimedia.jenis_media, m_multimedia.id, m_multimedia.linkyt  FROM m_multimedia UNION SELECT m_infografis.judul_info, m_infografis.tgl_info, m_infografis.kategori, m_infografis.id, m_infografis.created_at  FROM m_infografis ORDER BY tgl_rilis DESC LIMIT 5')->result_array();
    }
}
