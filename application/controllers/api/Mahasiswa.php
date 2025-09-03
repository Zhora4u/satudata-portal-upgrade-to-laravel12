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
		$this->load->model('Mahasiswa_model','mhs');
		$this->methods['index_get']['limit'] = 10;
	}

    public function index_get(){

    	$id = $this->get('id');
    	if($id == null){

    		$mahasiswa = $this->mhs->getAllMahasiswa();
    	}else{

    		$mahasiswa = $this->mhs->getMahasiswaById($id);

    	}
    	
    	//var_dump($mahasiswa);

    	 // Set the response and exit
          if($mahasiswa){

          	$this->response([
                    'status' => true,
                    'data' => $mahasiswa,
                ], REST_Controller::HTTP_OK);
          }else{

                $this->response([
                    'status' => false,
                    'message' => 'not found',
                ], REST_Controller::HTTP_NOT_FOUND);
   		}
     }

     public function index_delete()
     {
     	$id = $this->delete('id');

     	if($id == null){
     		$this->response([
                    'status' => false,
                    'message' => 'id not provided',
                ], REST_Controller::HTTP_BAD_REQUEST);
     	}else{

     		if($this->mhs->hapusDataMahasiswa($id) > 0){

     				$this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_OK);

     		}else{
     				$this->response([
                    'status' => false,
                    'message' => 'id not found',
                ], REST_Controller::HTTP_BAD_REQUEST);
     		}
     	}
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


     public function index_put()
     {

     	$id = $this->put('id');

     	$data = [
     			'nama' => $this->put('nama'),
     			'nrp' => $this->put('nrp'),
     			'email' => $this->put('email'),
     			'jurusan' => $this->put('jurusan')
     		];

     	if($this->mhs->ubahDataMahasiswa($data, $id) > 0)
     	{
     		$this->response([
                    'status' => true,
                    'message' => 'data mahasiswa has been updated'
                ], REST_Controller::HTTP_OK);	
     	}else
     	{
     		 $this->response([
                    'status' => false,
                    'message' => 'failed to update mahasiswa',
                ], REST_Controller::HTTP_BAD_REQUEST);
     	}

     }

}
