<?php

class Publikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pub_model', 'pub');
        $this->load->library('form_validation');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Publikasi';
        $data['content'] = 'admin/publikasi';

        $data['pub'] = $this->pub->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    function save_pub()
    {

        $this->form_validation->set_rules('judul_pub', 'judul_pub', 'required');
        $this->form_validation->set_rules('tgl_pub', 'tgl_pub', 'required');
        $this->form_validation->set_rules('ket_pub', 'ket_pub', 'required');
        $this->form_validation->set_rules('owner_pub', 'owner_pub', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('admin/publikasi');
            $this->load->view('templates/footer');
        } else {
            $upload_file = $_FILES['file_pub']['name'];
            $upload_file2 = $_FILES['cover_pub']['name'];

            if ($upload_file or $upload_file2) {
                $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|jpg|png';
                $config['max_size']      = '10240';
                $config['upload_path'] = './assets/docs/publikasi/';

                $this->load->library('upload', $config);

                $stringformat = str_replace(' ', '_', $upload_file);
                $stringformat2 = str_replace(' ', '_', $upload_file2);

                if ($this->upload->do_upload('file_pub') && $this->upload->do_upload('cover_pub')) {

                    $data = [
                        "judul_pub" => $this->input->post('judul_pub'),
                        "kategori" => 'publikasi',
                        "no_pub" => $this->input->post('no_pub'),
                        "no_issn" => $this->input->post('no_issn'),
                        "tgl_pub" => $this->input->post('tgl_pub'),
                        "ukuran_pub" => $this->input->post('ukuran_pub'),
                        "jml_hlmn_pub" => $this->input->post('jml_hlmn_pub'),
                        "ket_pub" => $this->input->post('ket_pub'),
                        "file_pub" =>  $stringformat,
                        "owner_pub" => $this->input->post('owner_pub'),
                        "abstrak_pub" => $this->input->post('abstrak_pub'),
                        "cover_pub" =>  $stringformat2,
                        "created_at" => $this->input->post('created_at')
                    ];

                    if ($this->pub->addData($data)) {
                        $data = $this->pub->getLastData();
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
        $data =  $this->pub->getDataById($id);
        echo $data;
    }

    public function doeditpublikasi()
    {
        if (isset($_FILES['file_pub'])) {
            $upload_file = $_FILES['file_pub']['name'];
        }
        if (isset($_FILES['cover_pub'])) {
            $upload_file2 = $_FILES['cover_pub']['name'];
        }

        if (isset($upload_file) or isset($upload_file2)) {
            $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|jpg|png';
            $config['max_size']      = '10240';
            $config['upload_path'] = './assets/docs/publikasi/';

            $this->load->library('upload', $config);

            $stringformat = str_replace(' ', '_', $upload_file);
            $stringformat2 = str_replace(' ', '_', $upload_file2);

            if ($stringformat == '' and $stringformat2 != '') {
                if ($this->upload->do_upload('file_pub') or $this->upload->do_upload('cover_pub')) {

                    $this->upload->overwrite = true;
                    $id = $this->input->post('id');
                    $param = array(
                        "judul_pub" => $this->input->post('judul_pub'),
                        "no_pub" => $this->input->post('no_pub'),
                        "no_issn" => $this->input->post('no_issn'),
                        "tgl_pub" => $this->input->post('tgl_pub'),
                        "ukuran_pub" => $this->input->post('ukuran_pub'),
                        "jml_hlmn_pub" => $this->input->post('jml_hlmn_pub'),
                        "ket_pub" => $this->input->post('ket_pub'),
                        "owner_pub" => $this->input->post('owner_pub'),
                        "abstrak_pub" => $this->input->post('abstrak_pub'),
                        "cover_pub" =>  $stringformat2,
                        "created_at" => $this->input->post('created_at')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('m_publikasi', $param);
                } else {
                    echo $this->upload->dispay_errors();
                }
            } else if ($stringformat2 == '' and $stringformat) {
                if ($this->upload->do_upload('file_pub') or $this->upload->do_upload('cover_pub')) {

                    $this->upload->overwrite = true;
                    $id = $this->input->post('id');
                    $param = array(
                        "judul_pub" => $this->input->post('judul_pub'),
                        "no_pub" => $this->input->post('no_pub'),
                        "no_issn" => $this->input->post('no_issn'),
                        "tgl_pub" => $this->input->post('tgl_pub'),
                        "ukuran_pub" => $this->input->post('ukuran_pub'),
                        "jml_hlmn_pub" => $this->input->post('jml_hlmn_pub'),
                        "ket_pub" => $this->input->post('ket_pub'),
                        "file_pub" =>  $stringformat,
                        "owner_pub" => $this->input->post('owner_pub'),
                        "abstrak_pub" => $this->input->post('abstrak_pub'),
                        "created_at" => $this->input->post('created_at')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('m_publikasi', $param);
                } else {
                    echo $this->upload->dispay_errors();
                }
            } else {
                if ($this->upload->do_upload('file_pub') && $this->upload->do_upload('cover_pub')) {

                    $this->upload->overwrite = true;
                    $id = $this->input->post('id');
                    $param = array(
                        "judul_pub" => $this->input->post('judul_pub'),
                        "no_pub" => $this->input->post('no_pub'),
                        "no_issn" => $this->input->post('no_issn'),
                        "tgl_pub" => $this->input->post('tgl_pub'),
                        "ukuran_pub" => $this->input->post('ukuran_pub'),
                        "jml_hlmn_pub" => $this->input->post('jml_hlmn_pub'),
                        "ket_pub" => $this->input->post('ket_pub'),
                        "file_pub" =>  $stringformat,
                        "owner_pub" => $this->input->post('owner_pub'),
                        "abstrak_pub" => $this->input->post('abstrak_pub'),
                        "cover_pub" =>  $stringformat2,
                        "created_at" => $this->input->post('created_at')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('m_publikasi', $param);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
        } else {
            $id = $this->input->post('id');
            $param = array(
                "judul_pub" => $this->input->post('judul_pub'),
                "no_pub" => $this->input->post('no_pub'),
                "no_issn" => $this->input->post('no_issn'),
                "tgl_pub" => $this->input->post('tgl_pub'),
                "ukuran_pub" => $this->input->post('ukuran_pub'),
                "jml_hlmn_pub" => $this->input->post('jml_hlmn_pub'),
                "ket_pub" => $this->input->post('ket_pub'),
                "owner_pub" => $this->input->post('owner_pub'),
                "abstrak_pub" => $this->input->post('abstrak_pub'),
                "created_at" => $this->input->post('created_at')
            );

            $this->db->where('id', $id);
            $this->db->update('m_publikasi', $param);
        }
    }

    public function editstts($id)
    {

        //$id = $this->input->post('id');
        $param = array(
            "status_pub" => $this->input->post('status')
        );
        //echo $id;
        $this->db->where('id', $id);
        $this->db->update('m_publikasi', $param);
    }

    public function hapus($id)
    {
        $this->pub->deleteData($id);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('backend/publikasi');
    }
}
