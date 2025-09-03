<?php

class Indikator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Indikator_model', 'indikator');
        $this->load->model('Data_model', 'data');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Indikator Data';
        $data['content'] = 'admin/indikator';
        $data['data'] = $this->indikator->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function acak($panjang)
    {
        $karakter = '0123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter[$pos];
        }
        return $string;
    }

    public function save()
    {
        if ($this->input->post('id_dataset_indikator')) {

            $id_penghubung = $this->acak(10);

            $data = [
                "nama_ind" => $this->input->post('nama_ind'),
                "konsep_ind" => $this->input->post('konsep_ind'),
                "definisi_ind" => $this->input->post('definisi_ind'),
                "intepretasi_ind" => $this->input->post('intepretasi_ind'),
                "rumus_ind" => $this->input->post('rumus_ind'),
                "ukuran_ind" => $this->input->post('ukuran_ind'),
                "satuan_ind" => $this->input->post('satuan_ind'),
                "klasifikasi_ind" => $this->input->post('klasifikasi_ind'),
                "komposit" => $this->input->post('komposit'),
                "publikasi_pembangunan" => $this->input->post('publikasi_pembangunan'),
                "nama_pembangunan" => $this->input->post('nama_pembangunan'),
                "kegiatan_pembangunan" => $this->input->post('kegiatan_pembangunan'),
                "kode_pembangunan" => $this->input->post('kode_pembangunan'),
                "nama_var_pembangunan" => $this->input->post('nama_var_pembangunan'),
                "estimasi_ind" => $this->input->post('estimasi_ind'),
                "akses_umum" => $this->input->post('akses_umum'),
                'penghubung_dataset' => $id_penghubung,
                "created_at" => date('y-m-d'),
            ];

            $this->indikator->save($data);
            $this->data->update_indikator('id', $this->input->post('id_dataset_indikator'), $id_penghubung);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
        }
        $data = [
            "nama_ind" => $this->input->post('nama_ind'),
            "konsep_ind" => $this->input->post('konsep_ind'),
            "definisi_ind" => $this->input->post('definisi_ind'),
            "intepretasi_ind" => $this->input->post('intepretasi_ind'),
            "rumus_ind" => $this->input->post('rumus_ind'),
            "ukuran_ind" => $this->input->post('ukuran_ind'),
            "satuan_ind" => $this->input->post('satuan_ind'),
            "klasifikasi_ind" => $this->input->post('klasifikasi_ind'),
            "komposit" => $this->input->post('komposit'),
            "publikasi_pembangunan" => $this->input->post('publikasi_pembangunan'),
            "nama_pembangunan" => $this->input->post('nama_pembangunan'),
            "kegiatan_pembangunan" => $this->input->post('kegiatan_pembangunan'),
            "kode_pembangunan" => $this->input->post('kode_pembangunan'),
            "nama_var_pembangunan" => $this->input->post('nama_var_pembangunan'),
            "estimasi_ind" => $this->input->post('estimasi_ind'),
            "akses_umum" => $this->input->post('akses_umum'),
            "created_at" => date('y-m-d H:i:s'),
        ];

        $this->indikator->save($data);
        $this->session->set_flashdata('message', 'Data telah ditambahkan');
    }

    public function hapus($id, $id_penghubung)
    {
        if ($id_penghubung == 0) {
            $this->indikator->delete($id);
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('backend/indikator');
        } else {
            $this->indikator->delete($id);
            $this->data->update_indikator('penghubung_indikator', $id_penghubung, '');
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('backend/indikator');
        }
    }

    public function show($id)
    {
        $data =  $this->indikator->show($id);
        echo $data;
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $data = [
            "nama_ind" => $this->input->post('nama_ind'),
            "konsep_ind" => $this->input->post('konsep_ind'),
            "definisi_ind" => $this->input->post('definisi_ind'),
            "intepretasi_ind" => $this->input->post('intepretasi_ind'),
            "rumus_ind" => $this->input->post('rumus_ind'),
            "ukuran_ind" => $this->input->post('ukuran_ind'),
            "satuan_ind" => $this->input->post('satuan_ind'),
            "klasifikasi_ind" => $this->input->post('klasifikasi_ind'),
            "komposit" => $this->input->post('komposit'),
            "publikasi_pembangunan" => $this->input->post('publikasi_pembangunan'),
            "nama_pembangunan" => $this->input->post('nama_pembangunan'),
            "kegiatan_pembangunan" => $this->input->post('kegiatan_pembangunan'),
            "kode_pembangunan" => $this->input->post('kode_pembangunan'),
            "nama_var_pembangunan" => $this->input->post('nama_var_pembangunan'),
            "estimasi_ind" => $this->input->post('estimasi_ind'),
            "akses_umum" => $this->input->post('akses_umum'),
            "edited_at" => date('y-m-d'),
        ];

        $this->db->where('id', $id);
        $this->db->update('m_indikator', $data);
    }

    public function show_dataset($id_penghubung)
    {
        $data =  $this->indikator->search_dataset($id_penghubung);
        echo $data;
    }
}
