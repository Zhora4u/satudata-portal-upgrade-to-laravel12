<?php

require './vendor/autoload.php';

use GuzzleHttp\Client;

class Simpeldatin extends CI_Controller
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => 'http://localhost/newsimpeldatin/api/'
        ]);
    }

    public function get($id)
    {
        $response = $this->_client->request('GET', 'data', [
            'query' => [
                'id' => $id
            ]
        ]);
        $result = $response->getBody()->getContents();

        echo $result;
    }

    public function insert()
    {
        $response = $this->_client->request('POST', 'data', [
            'multipart' => [
                [
                    'name' => 'photo',
                    'filename' => $_FILES['photo']['name'],
                    'contents' => fopen($_FILES['photo']['tmp_name'], 'r'),
                ], [
                    'name' => 'form-data',
                    'contents' => json_encode(
                        [
                            'name' => $this->input->post('name'),
                            'specific' => $this->input->post('specific'),
                            'access' => $this->input->post('access'),
                            'satuData' => $this->input->post('satuData'),
                            'categoryId' => $this->input->post('categoryId'),
                        ]
                    )
                ]
            ]
        ]);

        $result = $response->getBody()->getContents();
        echo $result;
    }

    public function delete($id)
    {
        $response = $this->_client->request('GET', 'data', [
            'query' => [
                'id' => $id,
                'delete' => true
            ]
        ]);
        $result = $response->getBody()->getContents();

        echo $result;
    }

    public function update()
    {
        if (!isset($_FILES['photo'])) {
            $response = $this->_client->request('POST', 'data', [
                'form_params' => [
                    'id' => $this->input->post('id'),
                    'name' => $this->input->post('name'),
                    'specific' => $this->input->post('specific'),
                ]
            ]);
        } else {
            $response = $this->_client->request('POST', 'data', [
                'multipart' => [
                    [
                        'name' => 'photo',
                        'filename' => $_FILES['photo']['name'],
                        'contents' => fopen($_FILES['photo']['tmp_name'], 'r'),
                    ], [
                        'name' => 'form-data',
                        'contents' => json_encode(
                            [
                                'id' => $this->input->post('id'),
                                'name' => $this->input->post('name'),
                                'specific' => $this->input->post('specific'),
                            ]
                        )
                    ]
                ]
            ]);
        }

        $result = $response->getBody()->getContents();
        echo $result;
    }
}
