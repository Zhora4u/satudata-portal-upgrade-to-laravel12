<?php

class Multimedia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Multimedia_model', 'media');
        $this->load->library('form_validation');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Multimedia';
        $data['content'] = 'admin/multimedia';
        $data['media'] = $this->media->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function foto()
    {
        $data['judul'] = 'Daftar Foto';
        $data['content'] = 'admin/foto';
        $data['media'] = $this->media->getFotoWithoutLimit();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function video()
    {
        $data['judul'] = 'Daftar Video';
        $data['content'] = 'admin/video';
        $data['media'] = $this->media->getvideoWithoutLimit();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    function save()
    {
        $this->form_validation->set_rules('judul_media', 'judul_media', 'required');
        $this->form_validation->set_rules('jenis_media', 'jenis_media', 'required');
        $this->form_validation->set_rules('tgl_media', 'tgl_media', 'required');
        $this->form_validation->set_rules('ket_media', 'ket_media', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('admin/multimedia');
            $this->load->view('templates/footer');
        } else {
            $upload_file = $_FILES['filename']['name'];

            $stringformat = str_replace(' ', '_', $upload_file);
            if ($upload_file) {
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/docs/multimedia/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('filename')) {
                    $data = [
                        "judul_media" => $this->input->post('judul_media'),
                        "jenis_media" => $this->input->post('jenis_media'),
                        "linkyt" => $this->input->post('linkyt'),
                        "tgl_media" => $this->input->post('tgl_media'),
                        "ket_media" => $this->input->post('ket_media'),
                        "created_at" => date("Y-m-d H:i:s"),
                        "file_media" =>  $stringformat
                    ];
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $data = [
                    "judul_media" => $this->input->post('judul_media'),
                    "jenis_media" => $this->input->post('jenis_media'),
                    "linkyt" => $this->input->post('linkyt'),
                    "tgl_media" => $this->input->post('tgl_media'),
                    "ket_media" => $this->input->post('ket_media'),
                    "created_at" => date("Y-m-d H:i:s"),
                    "file_media" =>  $stringformat
                ];
            }
            if ($this->media->addData($data)) {
                $data = $this->media->getLastData();
                $id = [
                    'status' => true,
                    'data' => $data,
                ];
                echo json_encode($id);
            };
        }
    }

    public function edit($id)
    {
        $data =  $this->media->getDataById($id);
        echo $data;
    }

    public function doeditmedia()
    {

        $upload_file = $_FILES['filename']['name'];
        $upload_size = $_FILES['filename']['size'];
        $upload_type = $_FILES['filename']['type'];
        // print_r($_FILES['filename']); die;

        $stringformat = str_replace(' ', '_', $upload_file);

        if ($upload_file) {
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']      = '2048';
            $config['upload_path'] = './assets/docs/multimedia/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('filename')) {

                $this->upload->overwrite = true;
                $id = $this->input->post('id');
                $data = [
                    "judul_media" => $this->input->post('judul_media'),
                    "jenis_media" => $this->input->post('jenis_media'),
                    "linkyt" => $this->input->post('linkyt'),
                    "tgl_media" => $this->input->post('tgl_media'),
                    "ket_media" => $this->input->post('ket_media'),
                    "created_at" => $this->input->post('created_at'),
                    "file_media" =>  $stringformat
                ];


                $this->db->where('id', $id);
                $this->db->update('m_multimedia', $data);
            } else {
                echo $this->upload->dispay_errors();
            }
        } else {

            $id = $this->input->post('id');

            $data = [
                "judul_media" => $this->input->post('judul_media'),
                "jenis_media" => $this->input->post('jenis_media'),
                "linkyt" => $this->input->post('linkyt'),
                "tgl_media" => $this->input->post('tgl_media'),
                "ket_media" => $this->input->post('ket_media'),
                "created_at" => $this->input->post('created_at'),
            ];

            $this->db->where('id', $id);
            $this->db->update('m_multimedia', $data);
        }
    }

    public function editstts($id)
    {
        $param = array(
            "status_media" => $this->input->post('status')
        );
        //echo $id;
        $this->db->where('id', $id);
        $this->db->update('m_multimedia', $param);
    }

    public function hapus($id)
    {
        $this->media->deleteData($id);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('backend/multimedia');
    }
}
