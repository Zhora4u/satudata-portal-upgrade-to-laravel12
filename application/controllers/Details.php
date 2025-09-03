<?php

class Details extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pub_model', 'pub');
        $this->load->model('News_model', 'news');
    }

    public function publikasi($id)
    {
        $data['pub'] = $this->pub->detailPublikasi($id);
        $data['judul'] = 'Detail Publikasi';

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/details/publikasi');
    }

    public function berita($id)
    {
        $data['news'] = $this->news->detailBerita($id);
        $data['judul'] = 'Detail Berita';
        $data['newNews'] = $this->news->newNews();

        $this->load->view('templates/header_atas', $data);
        $this->load->view('page/details/berita');
    }
}
