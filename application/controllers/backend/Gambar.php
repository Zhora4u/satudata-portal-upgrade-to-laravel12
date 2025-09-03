<?php

class Gambar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Galeri_model', 'galeri');
        $this->load->model('Info_model', 'info');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Gambar Infografis';
        $data['content'] = 'admin/gambar';
        $data['galeri'] = $this->galeri->getAllData();
        $data['info'] = $this->info->getTitleData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function addData()
    {
        $this->form_validation->set_rules('id_info', 'id_info', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('admin/gambar');
            $this->load->view('templates/footer');
        } else {
            $upload_file = $_FILES['photo']['name'];

            if ($upload_file) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/docs/infografis/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('photo')) {

                    $data = [
                        "id_info" => $this->input->post('id_info'),
                        "photo" =>  $upload_file,
                        "created_at" => date('y-m-d H:i:s'),
                    ];

                    $this->galeri->addData($data);
                    $this->session->set_flashdata('message', 'Data telah ditambahkan');
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
        }
    }

    public function deleteData($id)
    {
        $this->galeri->delete($id);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('backend/gambar');
    }
}
