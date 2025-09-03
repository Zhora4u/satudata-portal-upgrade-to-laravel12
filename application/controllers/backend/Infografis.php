<?php

class Infografis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Info_model', 'info');
        $this->load->library('form_validation');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Infografis';
        $data['content'] = 'admin/infografis';
        $data['info'] = $this->info->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    function save_info()
    {
        $this->form_validation->set_rules('judul_info', 'judul_info', 'required');
        $this->form_validation->set_rules('tgl_info', 'tgl_info', 'required');
        $this->form_validation->set_rules('ket_info', 'ket_info', 'required');
        $this->form_validation->set_rules('owner_info', 'owner_info', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('admin/infografis');
            $this->load->view('templates/footer');
        } else {
            // cek jika ada file yang akan diupload
            $upload_file = $_FILES['file_info']['name'];
            $name = str_replace(" ", "_", $upload_file);

            if ($upload_file) {
                $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/docs/infografis/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_info')) {

                    $data = [
                        "judul_info" => $this->input->post('judul_info'),
                        "kategori" => 'infografis',
                        "tgl_info" => $this->input->post('tgl_info'),
                        "ket_info" => $this->input->post('ket_info'),
                        "owner_info" => $this->input->post('owner_info'),
                        "created_at" => date('Y-m-d H:i:s'),
                        "file_info" =>  $name
                    ];
                    // $data = array('file_temp' => $this->upload->data('file_name'));
                    if ($this->info->addData($data)) {
                        $data = $this->info->getLastData();
                        $id = [
                            'status' => true,
                            'data' => $data,
                        ];
                        echo json_encode($id);
                    };
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
        }
    }

    public function edit($id)
    {
        $data =  $this->info->getDataById($id);
        echo $data;
    }

    public function doeditinfo()
    {
        $upload_file = $_FILES['file_info']['name'];
        // print_r($_FILES['filename']); die;

        if ($upload_file) {
            $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|jpg|png';
            $config['max_size']      = '2048';
            $config['upload_path'] = './assets/docs/infografis/';

            $this->load->library('upload', $config);

            $pisahfile = explode(".", $upload_file);
            $ext = end($pisahfile);
            $file = url_title($pisahfile[0], 'underscore');
            $file2 = $file . '.' . $ext;

            if ($this->upload->do_upload('file_info')) {

                $this->upload->overwrite = true;
                $id = $this->input->post('id');
                $param = array(
                    "judul_info" => $this->input->post('judul_info'),
                    "tgl_info" => $this->input->post('tgl_info'),
                    "ket_info" => $this->input->post('ket_info'),
                    "owner_info" => $this->input->post('owner_info'),
                    "created_at" => date('Y-m-d H:i:s'),
                    "file_info" => $file2
                );

                $this->db->where('id', $id);
                $this->db->update('m_infografis', $param);
            } else {
                echo $this->upload->dispay_errors();
            }
        } else {

            $id = $this->input->post('id');
            $param = array(
                "judul_info" => $this->input->post('judul_info'),
                "tgl_info" => $this->input->post('tgl_info'),
                "ket_info" => $this->input->post('ket_info'),
                "owner_info" => $this->input->post('owner_info'),
                "created_at" => $this->input->post('created_at')
            );

            $this->db->where('id', $id);
            $this->db->update('m_infografis', $param);
            //echo "upload gagal";

        }
    }

    public function editstts($id)
    {

        //$id = $this->input->post('id');
        $param = array(
            "status_info" => $this->input->post('status')
        );
        //echo $id;
        $this->db->where('id', $id);
        $this->db->update('m_infografis', $param);
    }

    public function hapus($id)
    {
        $this->info->deleteData($id);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('backend/infografis');
    }
}
