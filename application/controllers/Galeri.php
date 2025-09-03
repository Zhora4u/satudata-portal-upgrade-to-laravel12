<?php

class Galeri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Galeri_model', 'galeri');
    }

    public function photo($id)
    {
        $result = $this->galeri->getPhoto($id);
        echo $result;
    }
}
