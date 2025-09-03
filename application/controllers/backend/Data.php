<?php

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'data');
        $this->load->model('Variabel_model', 'variabel');
        $this->load->model('Indikator_model', 'indikator');
        $this->load->model('Meta_model', 'meta');
        $this->load->library('form_validation');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Data';
        $data['content'] = 'admin/data';
        $data['data'] = $this->data->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function save()
    {
        $this->form_validation->set_rules('nama_dataset', 'nama_dataset', 'required');
        $this->form_validation->set_rules('objek_data', 'objek_data', 'required');
        $this->form_validation->set_rules('variabel', 'variabel', 'required');
        $this->form_validation->set_rules('variabel', 'variabel', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('admin/data');
            $this->load->view('templates/footer');
        } else {
            $data = [
                "nama_dataset" => $this->input->post('nama_dataset'),
                "objek_data" => $this->input->post('objek_data'),
                "variabel" => $this->input->post('variabel'),
                "disagregasi" => $this->input->post('disagregasi'),
                "format_data" => $this->input->post('format_data'),
                "status" => $this->input->post('status'),
                "produsen_data" => $this->input->post('produsen_data'),
                "jadwal" => $this->input->post('jadwal'),
                "tagging" => $this->input->post('tagging'),
                "prioritas" => $this->input->post('prioritas'),
                "program" => $this->input->post('program'),
                "wali_data" => $this->input->post('wali_data'),
                "penanggung_jawab" => $this->input->post('penanggung_jawab'),
                "kesepakatan_data" => $this->input->post('kesepakatan_data'),
                "link_data" => $this->input->post('link_data'),
                "pengumpulan_data" => $this->input->post('pengumpulan_data'),
                "catatan" => $this->input->post('catatan'),
                "created_at" => date('y-m-d'),
            ];

            // $data = array('file_temp' => $this->upload->data('file_name'));
            $this->data->save($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');

            redirect('backend/data');
        }
    }

    public function hapus($id, $id_indikator, $id_variabel, $id_data)
    {
        $this->data->delete($id);

        if ($id_indikator != 0) {
            $this->indikator->delete_data($id_indikator);
        }
        if ($id_variabel != 0) {
            $this->variabel->delete_data($id_variabel);
        }
        if ($id_data != 0) {
            $this->meta->delete_data($id_data);
        }
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('backend/data');
    }

    public function show($id)
    {
        $data =  $this->data->show($id);
        echo $data;
    }

    public function edit()
    {
        $this->form_validation->set_rules('nama_dataset', 'nama_dataset', 'required');
        $this->form_validation->set_rules('objek_data', 'objek_data', 'required');
        $this->form_validation->set_rules('variabel', 'variabel', 'required');
        $this->form_validation->set_rules('variabel', 'variabel', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('admin/data');
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $data = [
                "nama_dataset" => $this->input->post('nama_dataset'),
                "objek_data" => $this->input->post('objek_data'),
                "variabel" => $this->input->post('variabel'),
                "disagregasi" => $this->input->post('disagregasi'),
                "format_data" => $this->input->post('format_data'),
                "status" => $this->input->post('status'),
                "produsen_data" => $this->input->post('produsen_data'),
                "jadwal" => $this->input->post('jadwal'),
                "tagging" => $this->input->post('tagging'),
                "prioritas" => $this->input->post('prioritas'),
                "program" => $this->input->post('program'),
                "wali_data" => $this->input->post('wali_data'),
                "penanggung_jawab" => $this->input->post('penanggung_jawab'),
                "kesepakatan_data" => $this->input->post('kesepakatan_data'),
                "link_data" => $this->input->post('link_data'),
                "pengumpulan_data" => $this->input->post('pengumpulan_data'),
                "catatan" => $this->input->post('catatan'),
                "edited_at" => date('y-m-d'),
            ];

            $this->db->where('id', $id);
            $this->db->update('m_dataset', $data);
        }
    }
}
