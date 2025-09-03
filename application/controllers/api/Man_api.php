<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Man_api extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Manapi_model','api');
		//$this->methods['index_get']['limit'] = 10;
	}

    public function index_get(){

    	$id = $this->get('id');
    	if($id == null){

    		$api = $this->api->getAllApi();
    	}else{

    		$api = $this->api->getApiById($id);

    	}

    	 // Set the response and exit
          if($api){

          	$this->response([
                    'status' => 'true',
                    'data' => $api,
                ], REST_Controller::HTTP_OK);
          }else{

                $this->response([
                    'status' => 'false',
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

     		if($this->usr->hapusDataUser($id) > 0){

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
     			'api_name' => $this->post('namaAPI'),
     			'api_url' => $this->post('urlAPI'),
				'api_desc' => $this->post('apiDesc'),
				'api_owner' => $this->post('apiOwner'),
				'api_unker' => $this->post('apiUnker'),
				'api_type' => $this->post('apiType'),
				'api_param' => $this->post('apiParam'),
				'api_key' => $this->post('apiKey'),
				'api_auth' => $this->post('apiAuth'),
				'api_created_at' => $this->post('regtime')
     		];

     	if($this->api->tambahDataApi($data) > 0){
     		$this->response([
                    'status' => 'True',
					'message' => 'sukses'
				], REST_Controller::HTTP_CREATED);
				
     	}else{
     		 $this->response([
                    'status' => 'False',
					'message' => 'gagal'
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
