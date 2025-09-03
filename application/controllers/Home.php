<?php

class Home extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Meta_model', 'metadata');
        $this->load->model('News_model', 'news');
        $this->load->model('Info_model', 'info');
        $this->load->model('Pub_model', 'pub');
        $this->load->model('Multimedia_model', 'media');
        $this->load->model('Link_model', 'link');
        $this->load->helper(array('url', 'download'));
    }
    public function index()
    {
        $this->load->helper('url');
        $data['judul'] = 'Portal Satu Data Pertanian';
        $data['meta'] = $this->metadata->joinAllTable();
        $data['news'] = $this->news->getNewsLimit();
        $data['info'] = $this->info->getInfoLimit();
        $data['pub'] = $this->pub->getDataLimit();
        $data['countinfo'] = $this->info->getCountInfo();
        $data['countmeta'] = $this->metadata->getCountMeta();
        $data['countpub'] = $this->pub->getCountPub();
        $data['video'] = $this->media->getVideo();
        $data['foto'] = $this->media->getFoto();
        $data['link'] = $this->link->getAllDataActive();
        $data['countNews'] = $this->news->countRows();
        $data['countFoto'] = $this->media->countRowsFoto();
        $data['countVideo'] = $this->media->countRowsVideo();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/index2', $data);
        $this->load->view('templates/footer');
    }

    public function meta_detail($id)
    {
        $data['judul'] = 'Detail Metadata';
        $data['meta'] = $this->metadata->getDataById($id);

        $data['dt'] = json_decode($data['meta'], true);

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/metadetail', $data);
    }


    public function news_detail($id)
    {
        $data['judul'] = 'Detail Berita';
        $data['news'] = $this->news->getDataById($id);

        $data['dt'] = json_decode($data['news'], true);

        //echo $data['dt']['judul'];

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/newsdetail', $data);
    }

    public function tambahKontak()
    {
        $this->load->library('mailer');
        //$data['judul'] = 'Form Tambah Data Mahasiswa';

        $data = [
            "nama" => $this->input->post('nama', true),
            "email" => $this->input->post('email', true),
            "instansi" => $this->input->post('instansi', true),
            "pesan" => $this->input->post('pesan', true)
        ];

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('instansi', 'Instansi', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('flash', 'Salah');
        } else {

            if ($this->info->addKontak($data) > 0) {

                $email = $this->input->post('email', true);
                $pesan = $this->input->post('pesan', true);

                $content = $this->load->view('templates/content_email', array('pesan' => $pesan), true); // Ambil isi file content.php dan masukan ke variabel $content
                $sendmail = array(
                    'email_penerima' => $email,
                    'subjek' => $pesan,
                    'content' => $content,
                    // 'attachment'=>$attachment
                );

                $send = $this->mailer->send($sendmail); // Panggil fungsi send yang ada di librari Mailer

                $sts = array(
                    'status' => 'True',
                    'status_email' => $send['status'],
                    'message_email' => $send['message'],
                    'message' => 'sukses'
                );
            } else {
                $sts = array(
                    'status' => 'False',
                    'message' => 'gagal'
                );
            }

            $json = json_encode($sts);
            echo $json;
        }
    }

    public function foto()
    {
        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->db->like('judul_media', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $this->db->like('judul_media', $data['keyword']);
        }

        $this->db->like('status_media', 1);
        $this->db->like('jenis_media', 'foto');
        $this->db->from('m_multimedia');

        $config['base_url'] = 'http://localhost/satudata/home/foto';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 15;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['galeri'] = $this->media->getAllFoto($config['per_page'], $data['start'], $data['keyword']);
        $data['judul'] = 'Galeri Foto';

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/galeri');
    }

    public function video()
    {
        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->db->like('judul_media', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $this->db->like('judul_media', $data['keyword']);
        }

        $this->db->like('status_media', 1);
        $this->db->like('jenis_media', 'video');
        $this->db->from('m_multimedia');

        $config['base_url'] = 'http://localhost/satudata/home/video';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 15;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['galeri'] = $this->media->getAllVideo($config['per_page'], $data['start'], $data['keyword']);
        $data['judul'] = 'Galeri Video';

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/galeri');
    }

    public function gambar($id)
    {
        $result = $this->media->getDataById($id);
        echo $result;
    }

    public function download($nama_file)
    {
        $data = $this->media->unduh($nama_file);
        $file = $data->file_media;
        force_download('./assets/docs/multimedia/' . $file, NULL);
    }

    public function downloadMetadata($nama_file)
    {
        $data = $this->metadata->unduh($nama_file);
        $file = $data->file_statistik;
        force_download('./assets/docs/metadata/' . $file, NULL);
    }

    public function pencarian()
    {
        $data['judul'] = 'Halaman Pencarian';
        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/searchPage');
        $this->load->view('templates/footer');
    }

    public function formatOwner($owner)
    {
        $data['nama_eselon'] = nama_eselon($owner);
        echo json_encode($data);
    }

    public function formatDate($date)
    {
        $data['format_date'] = longdate_indo(substr($date, 0, 10));
        echo json_encode($data);
    }
}
