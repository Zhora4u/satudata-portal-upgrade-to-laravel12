<?php

class Iframe extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Website Lainnya';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/iframe');
        $this->load->view('templates/footer');
    }
}
