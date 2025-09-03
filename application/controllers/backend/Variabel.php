<?php

class Variabel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Variabel_model', 'variabel');
        $this->load->model('Data_model', 'data');
        $this->load->library('form_validation');
        $this->auth->restrict();
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

    public function index()
    {
        $data['judul'] = 'Daftar Variabel Data';
        $data['content'] = 'admin/variabel';
        $data['data'] = $this->variabel->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function save()
    {
        if ($this->input->post('id_dataset_variabel')) {

            $id_penghubung = $this->acak(10);

            $data = [
                "nama_var" => $this->input->post('nama_var'),
                "alias_var" => $this->input->post('alias_var'),
                "konsep_var" => $this->input->post('konsep_var'),
                "definisi_var" => $this->input->post('definisi_var'),
                "ref_pemilihan" => $this->input->post('ref_pemilihan'),
                "ref_waktu" => $this->input->post('ref_waktu'),
                "tipe_var" => $this->input->post('tipe_var'),
                "klasifikasi_var" => $this->input->post('klasifikasi_var'),
                "validasi_var" => $this->input->post('validasi_var'),
                "kalimat_pertanyaan" => $this->input->post('kalimat_pertanyaan'),
                "akses_umum" => $this->input->post('akses_umum'),
                "penghubung_dataset" => $id_penghubung,
                "created_at" => date('y-m-d'),
            ];

            $this->variabel->save($data);
            $this->data->update_variabel('id', $this->input->post('id_dataset_variabel'), $id_penghubung);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');

            redirect('backend/data');
        }

        $data = [
            "nama_var" => $this->input->post('nama_var'),
            "alias_var" => $this->input->post('alias_var'),
            "konsep_var" => $this->input->post('konsep_var'),
            "definisi_var" => $this->input->post('definisi_var'),
            "ref_pemilihan" => $this->input->post('ref_pemilihan'),
            "ref_waktu" => $this->input->post('ref_waktu'),
            "tipe_var" => $this->input->post('tipe_var'),
            "klasifikasi_var" => $this->input->post('klasifikasi_var'),
            "validasi_var" => $this->input->post('validasi_var'),
            "kalimat_pertanyaan" => $this->input->post('kalimat_pertanyaan'),
            "akses_umum" => $this->input->post('akses_umum'),
            "created_at" => date('y-m-d'),
        ];

        $this->variabel->save($data);
        $this->session->set_flashdata('message', 'Data telah ditambahkan');

        redirect('backend/variabel');
    }

    public function hapus($id, $id_penghubung)
    {
        if ($id_penghubung == 0) {
            $this->variabel->delete($id);
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('backend/variabel');
        } else {
            $this->variabel->delete($id);
            $this->data->update_variabel('penghubung_variabel', $id_penghubung, '');
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('backend/variabel');
        }
    }

    public function show($id)
    {
        $data =  $this->variabel->show($id);
        echo $data;
    }

    public function edit()
    {

        $id = $this->input->post('id');
        $data = [
            "nama_var" => $this->input->post('nama_var'),
            "alias_var" => $this->input->post('alias_var'),
            "konsep_var" => $this->input->post('konsep_var'),
            "definisi_var" => $this->input->post('definisi_var'),
            "ref_pemilihan" => $this->input->post('ref_pemilihan'),
            "ref_waktu" => $this->input->post('ref_waktu'),
            "tipe_var" => $this->input->post('tipe_var'),
            "klasifikasi_var" => $this->input->post('klasifikasi_var'),
            "validasi_var" => $this->input->post('validasi_var'),
            "kalimat_pertanyaan" => $this->input->post('kalimat_pertanyaan'),
            "akses_umum" => $this->input->post('akses_umum'),
            "edited_at" => date('y-m-d'),
        ];

        $this->db->where('id', $id);
        $this->db->update('m_variabel', $data);
    }

    public function show_dataset($id_penghubung)
    {
        $data =  $this->variabel->search_dataset($id_penghubung);
        echo $data;
    }
}
