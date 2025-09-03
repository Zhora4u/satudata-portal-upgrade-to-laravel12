<?php

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model', 'news');
        $this->load->library('form_validation');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Berita';
        $data['content'] = 'admin/news';

        $data['news'] = $this->news->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    function save_news()
    {
        $this->form_validation->set_rules('judul_berita', 'judul', 'required');
        $this->form_validation->set_rules('tgl_berita', 'tgl_rilis', 'required');
        $this->form_validation->set_rules('isi_berita', 'abstraksi', 'required');
        $this->form_validation->set_rules('isi_singkat_berita', 'abstraksi', 'required');
        $this->form_validation->set_rules('owner_berita', 'owner', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('admin/news');
            $this->load->view('templates/footer');
        } else {

            // cek jika ada file yang akan diupload
            $upload_file = $_FILES['filename']['name'];
            $upload_file2 = $_FILES['filename2']['name'];

            // print_r($_FILES['filename']); die;

            if ($upload_file || $upload_file2) {
                $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|png|jpg';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/docs/berita/';

                $this->load->library('upload', $config);

                $stringformat = str_replace(' ', '_', $upload_file);
                $stringformat2 = str_replace(' ', '_', $upload_file2);

                if ($this->upload->do_upload('filename') || $this->upload->do_upload('filename2')) {

                    $data = [
                        "judul_berita" => $this->input->post('judul_berita', true),
                        "tgl_berita" => $this->input->post('tgl_berita', true),
                        "isi_berita" => $this->input->post('isi_berita', true),
                        "isi_singkat_berita" => $this->input->post('isi_singkat_berita', true),
                        "owner_berita" => $this->input->post('owner_berita', true),
                        "created_at" => $this->input->post('created_at', true),
                        "file_berita" =>  $stringformat,
                        "file_foto" =>  $stringformat2
                    ];

                    // $data = array('file_temp' => $this->upload->data('file_name'));
                    if ($this->news->addData($data)) {
                        $data = $this->news->getLastData();
                        $id = [
                            'status' => true,
                            'data' => $data,
                        ];
                        echo json_encode($id);
                        die;
                    };
                } else {
                    echo $this->upload->dispay_errors();
                }
            } else {
                echo $this->upload->dispay_errors();
            }

            redirect('backend/news');
        }
    }

    public function edit($id)
    {
        $data =  $this->news->getDataById($id);
        echo $data;
    }

    public function doeditnews()
    {

        //$data['meta'] = $this->db->get_where('m_metadata', ['id' => $id])->row_array();
        // cek jika ada file yang akan diupload
        $upload_file = $_FILES['filename']['name'];
        $upload_file2 = $_FILES['filename2']['name'];

        // print_r($_FILES['filename']); die;

        if ($upload_file || $upload_file2) {

            $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|png|jpg';
            $config['max_size']      = '10240';
            $config['upload_path'] = './assets/docs/berita/';

            $this->load->library('upload', $config);

            $stringformat = str_replace(' ', '_', $upload_file);
            $stringformat2 = str_replace(' ', '_', $upload_file2);

            if ($stringformat == '' and $stringformat2 != '') {
                if ($this->upload->do_upload('filename') or $this->upload->do_upload('filename2')) {

                    $this->upload->overwrite = true;
                    $id = $this->input->post('id');
                    $param = array(
                        "judul_berita" => $this->input->post('judul_berita', true),
                        "kategori" => 'berita',
                        "tgl_berita" => $this->input->post('tgl_berita', true),
                        "isi_berita" => $this->input->post('isi_berita', true),
                        "isi_singkat_berita" => $this->input->post('isi_singkat_berita', true),
                        "owner_berita" => $this->input->post('owner_berita', true),
                        "edited_at" => $this->input->post('created_at', true),
                        "file_foto" =>  $stringformat2
                    );

                    $this->db->where('id', $id);
                    $this->db->update('m_berita', $param);
                } else {
                    echo $this->upload->dispay_errors();
                }
            } else if ($stringformat != '' and $stringformat2 == '') {
                if ($this->upload->do_upload('filename') or $this->upload->do_upload('filename2')) {

                    $this->upload->overwrite = true;
                    $id = $this->input->post('id');
                    $param = array(
                        "judul_berita" => $this->input->post('judul_berita', true),
                        "tgl_berita" => $this->input->post('tgl_berita', true),
                        "isi_berita" => $this->input->post('isi_berita', true),
                        "isi_singkat_berita" => $this->input->post('isi_singkat_berita', true),
                        "owner_berita" => $this->input->post('owner_berita', true),
                        "edited_at" => $this->input->post('created_at', true),
                        "file_berita" =>  $stringformat,
                    );

                    $this->db->where('id', $id);
                    $this->db->update('m_berita', $param);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            if ($this->upload->do_upload('filename') or $this->upload->do_upload('filename2')) {

                $this->upload->overwrite = true;
                $id = $this->input->post('id');
                $param = array(
                    "judul_berita" => $this->input->post('judul_berita', true),
                    "tgl_berita" => $this->input->post('tgl_berita', true),
                    "isi_berita" => $this->input->post('isi_berita', true),
                    "isi_singkat_berita" => $this->input->post('isi_singkat_berita', true),
                    "owner_berita" => $this->input->post('owner_berita', true),
                    "edited_at" => $this->input->post('created_at', true),
                    "file_berita" =>  $stringformat,
                    "file_foto" =>  $stringformat2
                );

                $this->db->where('id', $id);
                $this->db->update('m_berita', $param);
            } else {
                echo $this->upload->dispay_errors();
            }
        } else {

            $id = $this->input->post('id');
            $param = array(
                "judul_berita" => $this->input->post('judul_berita', true),
                "tgl_berita" => $this->input->post('tgl_berita', true),
                "isi_berita" => $this->input->post('isi_berita', true),
                "isi_singkat_berita" => $this->input->post('isi_singkat_berita', true),
                "owner_berita" => $this->input->post('owner_berita', true),
                "edited_at" => $this->input->post('created_at', true)
            );

            $this->db->where('id', $id);
            $this->db->update('m_berita', $param);
            //echo "upload gagal";

        }
    }

    public function editstts($id)
    {

        //$id = $this->input->post('id');
        $param = array(
            "status_berita" => $this->input->post('status')
        );
        //echo $id;
        $this->db->where('id', $id);
        $this->db->update('m_berita', $param);
    }

    public function hapus($id)
    {
        $this->news->deleteData($id);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('backend/news');
    }
}
