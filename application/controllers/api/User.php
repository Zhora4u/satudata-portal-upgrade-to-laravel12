<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'usr');
		//$this->methods['index_get']['limit'] = 10;
	}

	public function index_get()
	{

		$id = $this->get('id');
		if ($id == null) {

			$user = $this->usr->getAllUser();
		} else {

			$user = $this->usr->getUserById($id);
		}

		// Set the response and exit
		if ($user) {

			$this->response([
				'status' => 'true',
				'data' => $user,
			], REST_Controller::HTTP_OK);
		} else {

			$this->response([
				'status' => 'false',
				'message' => 'not found',
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		if ($id == null) {
			$this->response([
				'status' => false,
				'message' => 'id not provided',
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {

			if ($this->usr->hapusDataUser($id) > 0) {

				$this->response([
					'status' => true,
					'id' => $id,
					'message' => 'deleted'
				], REST_Controller::HTTP_OK);
			} else {
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
			'nip' => $this->post('nip'),
			'nama_user' => $this->post('namalengkap'),
			'eselon' => $this->post('eselon'),
			'unitkerja' => $this->post('unker'),
			'kodeunker' => $this->post('kodeunker'),
			'email' => $this->post('email'),
			'hp' => $this->post('hp'),
			'role' => $this->post('role'),
			'created_at' => $this->post('regtime')
		];

		if ($this->usr->tambahDataUser($data) > 0) {
			$this->response([
				'status' => 'True',
				'message' => 'sukses'
			], REST_Controller::HTTP_CREATED);
		} else {
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
			'nip' => $this->put('nip'),
			'nama_user' => $this->put('namalengkap'),
			'eselon' => $this->put('eselon'),
			'unitkerja' => $this->put('unker'),
			'kodeunker' => $this->put('kodeunker'),
			'email' => $this->put('email'),
			'hp' => $this->put('hp'),
			'role' => $this->put('role'),
			'created_at' => $this->put('regtime')
		];

		if ($this->usr->ubahDataUser($data, $id)) {
			$this->response([
				'status' => 'True',
				'message' => 'sukses update'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => 'False',
				'message' => 'gagal update'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
