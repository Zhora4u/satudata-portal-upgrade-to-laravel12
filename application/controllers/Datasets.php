<?php

class Datasets extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Meta_model', 'metadata');
        $this->load->model('Pub_model', 'pub');
        $this->load->model('Info_model', 'info');
        $this->load->model('News_model', 'news');
        $this->load->model('Galeri_model', 'model');
        $this->load->helper(array('url', 'download'));
    }

    public function index()
    {
        //$this->load->helper('url');
        $data['meta'] = $this->metadata->getAlldata();
        $data['judul'] = 'Datasets';

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/datasets');
    }

    public function publikasi()
    {
        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->db->like('judul_pub', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $this->db->like('judul_pub', $data['keyword']);
        }

        $this->db->like('status_pub', 1);
        $this->db->from('m_publikasi');

        $config['base_url'] = 'http://localhost/satudata/datasets/publikasi';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['pub'] = $this->pub->getPageData($config['per_page'], $data['start'], $data['keyword']);
        $data['judul'] = 'Publikasi';

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/publikasi');
    }

    public function infografis()
    {
        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->db->like('judul_info', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $this->db->like('judul_info', $data['keyword']);
        }

        $this->db->like('status_info', 1);
        $this->db->from('m_infografis');

        $config['base_url'] = 'http://localhost/satudata/datasets/infografis';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['info'] = $this->info->getPageData($config['per_page'], $data['start'], $data['keyword']);
        $data['judul'] = 'Infografis';
        // $data['test'] = $this->info->getDataWithPhoto();

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/infografis');
    }

    public function news()
    {
        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->db->like('judul_berita', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $this->db->like('judul_berita', $data['keyword']);
        }

        $this->db->like('status_berita', 1);
        $this->db->from('m_berita');

        $config['base_url'] = 'http://localhost/satudata/datasets/news';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['news'] = $this->news->getPageData($config['per_page'], $data['start'], $data['keyword']);
        $data['judul'] = 'Berita';

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/news');
    }

    public function caridata($word, $limit, $start)
    {
        $data = $this->metadata->searchDataByKeyword($word, $limit, $start);
        echo $data;
    }

    public function caripublikasi($word, $limit, $start)
    {
        $data = $this->pub->searchDataByKeyword($word, $limit, $start);
        echo $data;
    }

    public function cariinfografis($word, $limit, $start)
    {
        $data = $this->info->searchDataByKeyword($word, $limit, $start);
        echo $data;
    }

    public function cariberita($word, $limit, $start)
    {
        $data = $this->news->searchDataByKeyword($word, $limit, $start);
        echo $data;
    }

    public function download($nama_file)
    {
        $data = $this->info->unduh($nama_file);
        $file = $data->file_info;
        force_download('./assets/docs/infografis/' . $file, NULL);
    }

    public function gambar($id)
    {
        $result = $this->info->getDataById($id);
        echo $result;
    }
}
