<?php

class Link extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Link_model', 'link');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Link Website';
        $data['content'] = 'admin/link';
        $data['data'] = $this->link->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function addData()
    {
        $upload_file = $_FILES['foto']['name'];

        $stringformat = str_replace(' ', '_', $upload_file);

        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']      = '2048';
        $config['upload_path'] = './assets/docs/link/';

        $this->load->library('upload', $config);


        if ($this->upload->do_upload('foto')) {

            $data = [
                "nama_web" => $this->input->post('nama_website'),
                "link" => $this->input->post('link'),
                "foto" => $stringformat,
                "status_link" => 1,
                "created_at" => date('y-m-d H:i:s')
            ];

            // $data = array('file_temp' => $this->upload->data('file_name'));
            $this->link->addData($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
        } else {
            echo $this->upload->dispay_errors();
        }
    }

    public function show($id)
    {
        $data = $this->link->getDataById($id);
        echo $data;
    }

    public function editData()
    {
        $upload_file = $_FILES['foto']['name'];
        $id = $this->input->post('id');

        if ($upload_file == '') {
            $data = [
                "nama_web" => $this->input->post('nama_website'),
                "link" => $this->input->post('link'),
            ];
            $this->link->editData($id, $data);
        } else {
            $stringformat = str_replace(' ', '_', $upload_file);

            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path'] = './assets/docs/link/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {

                $data = [
                    "nama_web" => $this->input->post('nama_website'),
                    "link" => $this->input->post('link'),
                    "foto" => $stringformat,
                ];
                $this->link->editData($id, $data);
                $this->session->set_flashdata('message', 'Data telah diedit');
            } else {
                echo $this->upload->dispay_errors();
            }
        }
    }

    public function editStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $data = [
            "status_link" => $status
        ];

        $this->link->editData($id, $data);
        $this->session->set_flashdata('message', 'Data telah diedit');
    }
}
