<?php

class Metadata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Meta_model', 'meta');
        $this->load->model('Data_model', 'data');
        $this->load->library('form_validation');
        //$this->auth->is_logged_in();
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Daftar Data';
        $data['error'] = '';
        $data['content'] = 'admin/metadata';

        $data['meta'] = $this->meta->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Data';
        $data['error'] = '';
        $data['content'] = 'admin/detailmetadata';
        $data['metadtl'] = $this->meta->getDetailMetadata($id);
        $data['statusdt'] = $this->meta->getDetailStatus($id);
        $data['groupdt'] = $this->meta->getGroupTglDtlSts($id);

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function verifikasi()
    {
        $data['judul'] = 'Daftar Data';
        $data['content'] = 'admin/verifikasidata';

        $data['meta'] = $this->meta->getAllVerData();

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

    function save_meta()
    {

        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('tgl_rilis', 'tgl_rilis', 'required');
        $this->form_validation->set_rules('abstraksi', 'abstraksi', 'required');
        //$this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run() == false) {
            // redirect('backend/metadata');
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {

            if ($this->input->post('id_dataset_meta')) {

                $id_penghubung = $this->acak(10);

                $data = [
                    //"kode" =>   "meta-".$this->random->randomString(10),
                    "judul" => $this->input->post('judul', true),
                    "tgl_rilis" => $this->input->post('tgl_rilis', true),
                    "jnsdata" => $this->input->post('jnsdata', true),
                    "tagging_data" => $this->input->post('tagging', true),
                    "kategori" => 'metadata',
                    "kategori_data" => $this->input->post('katdata', true),
                    "abstraksi" => $this->input->post('abstraksi', true),
                    "created_at" => $this->input->post('created_at', true),
                    "created_by" => $this->input->post('created_by', true),
                    "owner" => substr($this->session->userdata('kodeunker'), 0, 2) . '00000000',
                    "unker" => substr($this->session->userdata('kodeunker'), 0, 4) . '000000',
                    "penghubung_dataset" => $id_penghubung,
                    "status" => 1,
                    "link_meta" => $this->input->post('link')
                ];

                $id = $this->meta->addData($data);

                // $this->session->set_flashdata('message', 'Data telah ditambahkan');
                // cek jika ada file yang akan diupload
                $upload_file1 = $_FILES['filename1']['name'];

                $config['allowed_types'] = 'xls|xlsx|pdf|doc|docx';
                $config['max_size']      = '1024';
                $config['upload_path'] = './assets/docs/metadata/';

                $this->load->library('upload', $config);

                if (!empty($_FILES['filename1']['name'])) {

                    $stringformat = str_replace(' ', '_', $upload_file1);

                    if (!$this->upload->do_upload('filename1')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    } else {
                        $param = [
                            'file_statistik' => $stringformat
                        ];
                        $this->db->where('id', $id);
                        $this->db->update('m_metadata', $param);
                    }
                }

                $this->data->update_data('id', $this->input->post('id_dataset_meta'), $id_penghubung);
                $this->session->set_flashdata('message', 'Data telah ditambahkan');

                redirect('backend/data');
            }
            $data = [
                //"kode" =>   "meta-".$this->random->randomString(10),
                "judul" => $this->input->post('judul', true),
                "tgl_rilis" => $this->input->post('tgl_rilis', true),
                "jnsdata" => $this->input->post('jnsdata', true),
                "tagging_data" => $this->input->post('tagging', true),
                "kategori_data" => $this->input->post('katdata', true),
                "abstraksi" => $this->input->post('abstraksi', true),
                "created_at" => $this->input->post('created_at', true),
                "created_by" => $this->input->post('created_by', true),
                "owner" => substr($this->session->userdata('kodeunker'), 0, 2) . '00000000',
                "unker" => substr($this->session->userdata('kodeunker'), 0, 4) . '000000',
                "status" => 1,
                "link_meta" => $this->input->post('link')
            ];

            $id = $this->meta->addData($data);

            // $this->session->set_flashdata('message', 'Data telah ditambahkan');
            // cek jika ada file yang akan diupload
            $upload_file1 = $_FILES['filename1']['name'];
            $upload_file2 = $_FILES['filename2']['name'];
            $upload_file3 = $_FILES['filename3']['name'];
            $upload_file4 = $_FILES['filename4']['name'];

            $config['allowed_types'] = 'xls|xlsx|pdf|doc|docx';
            $config['max_size']      = '1024';
            $config['upload_path'] = './assets/docs/metadata/';

            $this->load->library('upload', $config);

            if (!empty($_FILES['filename1']['name'])) {

                $stringformat = str_replace(' ', '_', $upload_file1);

                if (!$this->upload->do_upload('filename1')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $param = [
                        'file_statistik' => $stringformat
                    ];
                    $this->db->where('id', $id);
                    $this->db->update('m_metadata', $param);
                }
            }

            if (!empty($_FILES['filename2']['name'])) {

                $stringformat = str_replace(' ', '_', $upload_file2);

                if (!$this->upload->do_upload('filename2')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $param = [
                        'file_meta1' => $stringformat
                    ];
                    $this->db->where('id', $id);
                    $this->db->update('m_metadata', $param);
                }
            }

            if (!empty($_FILES['filename3']['name'])) {

                $stringformat = str_replace(' ', '_', $upload_file3);

                if (!$this->upload->do_upload('filename3')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {
                    $param = [
                        'file_meta2' => $stringformat
                    ];
                    $this->db->where('id', $id);
                    $this->db->update('m_metadata', $param);
                }
            }
            if (!empty($_FILES['filename4']['name'])) {


                $stringformat = str_replace(' ', '_', $upload_file4);

                if (!$this->upload->do_upload('filename4')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                } else {

                    $param = [
                        'file_meta3' => $stringformat
                    ];
                    $this->db->where('id', $id);
                    $this->db->update('m_metadata', $param);
                }
            }

            redirect('backend/metadata');
        }
    }

    public function edit($id)
    {
        $data =  $this->meta->getDataById($id);
        echo $data;
    }

    public function editstts($id)
    {

        //$id = $this->input->post('id');
        $param = array(
            "status" => $this->input->post('status'),
            "catatan" => $this->input->post('notes')
        );
        //echo $id;
        $this->db->where('id', $id);
        $this->db->update('m_metadata', $param);
    }

    public function add_status($id)
    {

        //$id = $this->input->post('id');
        $param = array(
            "id_metadata" => $id,
            "role_status" => $this->input->post('role'),
            "status_metadata" => $this->input->post('status'),
            "note_metadata" => $this->input->post('notes'),
            "created_at" => $this->input->post('created_at'),
            "updated_at" => $this->input->post('updated_at')
        );
        //echo $id;

        $data = $this->meta->addStatusMetadata($param);
        $updatestts = $this->editstts($id);
    }

    public function doeditmeta()
    {

        $id = $this->input->post('id');

        $data = [
            "judul" => $this->input->post('judul', true),
            "tgl_rilis" => $this->input->post('tgl_rilis', true),
            "jnsdata" => $this->input->post('jnsdata', true),
            "tagging_data" => $this->input->post('tagging', true),
            "kategori_data" => $this->input->post('katdata', true),
            "abstraksi" => $this->input->post('abstraksi', true),
            "created_at" => $this->input->post('created_at', true),
            "created_by" => $this->input->post('created_by', true),
            "owner" => substr($this->session->userdata('kodeunker'), 0, 2) . '00000000',
            "unker" => substr($this->session->userdata('kodeunker'), 0, 4) . '000000',
            "status" => $this->input->post('status'),
            "link_meta" => $this->input->post('link')
        ];

        $this->db->where('id', $id);
        $this->db->update('m_metadata', $data);

        $config['allowed_types'] = 'xls|xlsx|pdf|doc|docx';
        $config['max_size']      = '1024';
        $config['upload_path'] = './assets/docs/metadata/';

        $this->load->library('upload', $config);

        if (!empty($_FILES['filename1']['name'])) {

            $stringformat = str_replace(' ', '_', $_FILES['filename1']['name']);

            if (!$this->upload->do_upload('filename1')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            } else {
                $param = [
                    'file_statistik' => $stringformat
                ];
                $this->db->where('id', $id);
                $this->db->update('m_metadata', $param);
            }
        }
        if (!empty($_FILES['filename2']['name'])) {


            $stringformat = str_replace(' ', '_', $_FILES['filename2']['name']);

            if (!$this->upload->do_upload('filename2')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            } else {
                $param = [
                    'file_meta1' => $stringformat
                ];
                $this->db->where('id', $id);
                $this->db->update('m_metadata', $param);
            }
        }
        if (!empty($_FILES['filename3']['name'])) {


            $stringformat = str_replace(' ', '_', $_FILES['filename3']['name']);


            if (!$this->upload->do_upload('filename3')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            } else {
                $param = [
                    'file_meta2' => $stringformat
                ];
                $this->db->where('id', $id);
                $this->db->update('m_metadata', $param);
            }
        }
        if (!empty($_FILES['filename4']['name'])) {


            $stringformat = str_replace(' ', '_', $_FILES['filename4']['name']);

            if (!$this->upload->do_upload('filename4')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            } else {

                $param = [
                    'file_meta3' => $stringformat
                ];
                $this->db->where('id', $id);
                $this->db->update('m_metadata', $param);
            }
        }
        //$data = $this->meta->editData($id, $param);

    }

    public function hapus($id, $penghubung)
    {
        if ($penghubung == 0) {
            $this->meta->deleteData($id);
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('backend/metadata');
        } else {
            $this->meta->deleteData($id);
            $this->data->update_data('penghubung_data', $penghubung, '');
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('backend/metadata');
        }
    }

    public function show_dataset($id_penghubung)
    {
        $data =  $this->meta->search_dataset($id_penghubung);
        echo $data;
    }
}
