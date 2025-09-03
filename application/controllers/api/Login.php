<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Mahasiswa_model','mhs');
	}

   
     public function index_post()
     {
     	$data = [
     			'nama' => $this->post('nama'),
     			'nrp' => $this->post('nrp'),
     			'email' => $this->post('email'),
     			'jurusan' => $this->post('jurusan')
     		];

     	if($this->mhs->tambahDataMahasiswa($data) > 0){
     		$this->response([
                    'status' => 'True',
					'message' => 'new mahasiswa has been created',
					'flash' =>  $this->session->set_flashdata('flash', 'Ditambahkan'),
					'redirect' => site_url().'mahasiswa'
				], REST_Controller::HTTP_CREATED);
				
     	}else{
     		 $this->response([
                    'status' => 'False',
					'message' => 'failed to create mahasiswa',
					'flash' =>  $this->session->set_flashdata('flash', 'Ditambahkan'),
					'redirect' => site_url().'mahasiswa'
                ], REST_Controller::HTTP_BAD_REQUEST);
     	}
     }


     

}
