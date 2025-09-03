<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('User_model', 'user');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // $data['pesan'] = '';
        $data['judul'] = 'Login';
        $this->load->view('admin/login', $data);
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

        $data['usernip'] = $this->user->getUserByEmail($this->input->post('txt_user'));

        if ($data['usernip']['role'] == 4) {

            if ($data['usernip']['password'] == md5($this->input->post('txt_pass'))) {
                // print_r($data['usernip']);
                // die;
                $newuser = array(
                    'username'          => $this->input->post('txt_user'),
                    'ip address'        => $_SERVER["REMOTE_ADDR"],
                    'nip_pegawai'       => $data['usernip']['nip'],
                    'email'              => $data['usernip']['email'],
                    'role'               => $data['usernip']['role'],
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
                redirect('admin/login', $data);
            }
        } else {


            if (isset($ceklogin['status']) == 'success') {

                $data['usernip'] = $this->user->getUserByEmail($this->input->post('txt_user'));
                // print_r($data['usernip']);

                if ($data['usernip'] > 0) {

                    $newuser = array(
                        'username'          => $this->input->post('txt_user'),
                        'ip address'        => $_SERVER["REMOTE_ADDR"],
                        'nip_pegawai'       => $data['usernip']['nip'],
                        'nama_user'       => $data['usernip']['nama_user'],
                        'kodeunker'         => $data['usernip']['kodeunker'],
                        'email'              => $data['usernip']['email'],
                        'role'               => $data['usernip']['role'],
                        'browser'            => $_SERVER['HTTP_USER_AGENT'],
                        'logged_in'         => TRUE
                    );
                    $this->session->set_userdata($newuser);
                    $data['flashlogin'] = $this->session->set_flashdata('flash', 'sukses');
                    // return true;

                    redirect('backend/admin');
                } else {
                    // echo "login gagal";
                    $data['flashlogin'] = $this->session->set_flashdata('flash', 'usrnotfound');
                    redirect('admin/login', $data);
                }
            } else {
                // echo "login gagal";
                $data['flashlogin'] = $this->session->set_flashdata('flash', 'gagal');
                redirect('admin/login', $data);
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
