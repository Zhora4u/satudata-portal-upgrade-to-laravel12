<?php
class Cronjob extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('User_model', 'user');
        $this->load->library('email');
    }

    public function index()
    {
        // $date = date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d'))));
        // $user = $this->user->getEmailByDate($date);

        // if ($user) {
        //     $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
        //     $this->email->to($user);
        //     $this->email->subject('Test Email');
        //     $this->email->message("
        //         It's been 3 days since you last requested data, there's a lot of new data that fits your needs.
        //     ");
        //     $this->email->send();
        // }
        $this->email->from('layanan.pusdatin.kementan@gmail.com', 'Kementrian Pertanian');
        $this->email->to('farhanmaulidian16@gmail.com');
        $this->email->subject('Test Email');
        $this->email->message("
                It's been 3 days since you last requested data, there's a lot of new data that fits your needs.
            ");
        $this->email->send();
        die;
    }
}
