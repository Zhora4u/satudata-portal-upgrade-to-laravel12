<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // $data['pesan'] = '';
        $data['judul'] = 'Login';
        $this->load->view('login', $data);
    }

    public function act_login()
    {
        $postdata = http_build_query(
            array(
                'username' => $this->input->post('txt_user'),
                'password' => $this->input->post('txt_pass'),
                'api-key' => '023ceba765b2ab68636c6e08c2b1b7ae'
            )
        );

        // $email = $this->input->post('username');
        // $password = $this->input->post('password');

        $opts = array(
            'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents('https://api.pertanian.go.id/api/email/login/auth', false, $context);
        //echo $result;
        $ceklogin = json_decode($result, true);
        // print_r($ceklogin); 

        if (isset($ceklogin['status']) == 'success') {

            $newuser = array(
                'username'          => $this->input->post('txt_user'),
                'ip address'        => $_SERVER["REMOTE_ADDR"],
                'browser'            => $_SERVER['HTTP_USER_AGENT'],
                'logged_in'         => TRUE
            );
            $this->session->set_userdata($newuser);
            $data['flashlogin'] = $this->session->set_flashdata('flash', 'sukses');
            // return true;

            redirect('backend/admin');
        } else {
            // echo "login gagal";
            $data['flashlogin'] = $this->session->set_flashdata('flash', 'gagal');
            redirect('login', $data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
