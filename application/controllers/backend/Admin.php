<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'usermodel');
        // $this->load->model('Eselon_model','eselon');
        $this->load->model('Meta_model', 'meta');
        $this->load->model('News_model', 'news');
        $this->load->model('Pub_model', 'pub');
        $this->load->model('Info_model', 'info');
        $this->load->library('form_validation');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['judul'] = 'Admin';
        $data['content'] = 'admin/index';

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }



    public function listapi()
    {
        $data['judul'] = 'Daftar API';
        $data['content'] = 'admin/listapi';

        $data['eselon1'] = $this->eselon->getAllEselon();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function listuser()
    {
        $data['judul'] = 'Daftar User';
        $data['content'] = 'admin/listuser';

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function verifydata()
    {
        $data['judul'] = 'Verifikasi Data';
        $data['content'] = 'admin/verifydata';
        $data['news'] = $this->news->getAllData();
        $data['meta'] = $this->meta->getDataByStatus();
        $data['pub'] = $this->pub->getAllData();
        $data['info'] = $this->info->getAllData();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function generatetoken()
    {
        $data['judul'] = 'Generate Token';
        $data['content'] = 'admin/generatetoken';

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function ajax_user_list()
    {
        $list = $this->usermodel->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $users) {

            $q = $this->db->get_where('user_role', ['id' =>  $users->role])->result_array();
            if (empty($q)) {
                $userrole = "kosong";
            } else {
                $userrole = $q[0]['role'];
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $users->nama_user;
            $row[] = $users->nip;
            $row[] = $users->unitkerja;
            $row[] = $users->email;
            $row[] = $users->hp;
            $row[] = $userrole;
            $row[] = $users->created_at;
            $row[] = '<button type="button" id="btnHapusUser" data-id=' . $users->id . ' class="btn btn-danger btn-xs">Hapus</button>
                      <button type="button" id="btnEditUser" data-id=' . $users->id . ' class="btn btn-primary btn-xs">Edit</button>
                      <button type="button" id="btnNonAktif" data-id=' . $users->id . ' class="btn btn-warning btn-xs">NonAktif</button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->usermodel->count_all(),
            "recordsFiltered" => $this->usermodel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function role()
    {
        $data['judul'] = 'Role';
        $data['content'] = 'admin/role';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/top', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/main', $data);
            $this->load->view('templates/footer2');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
            redirect('backend/admin/role');
        }
    }


    public function roleAccess($role_id)
    {
        $data['judul'] = 'Role Access';
        $data['content'] = 'admin/role-access';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        // $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/top', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/main', $data);
        $this->load->view('templates/footer2');
    }

    public function editrole($role_id)
    {
        $data['judul'] = 'Edit Role';
        $data['content'] = 'admin/editrole';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        // $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        if ($_POST) {

            // echo "aaa"; die;
            $data = array(
                'role' => $this->input->post('role')
            );

            $this->db->where('id', $role_id);
            $this->db->update('user_role', $data);

            // print_r($data); die;

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">role edited!</div>');

            redirect('backend/admin/role');
        } else {

            $this->load->view('templates/top', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/main', $data);
            $this->load->view('templates/footer2');
        }
    }

    public function deleterole($id)
    {

        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil di hapus</div>');
        redirect('backend/admin/role');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }
}
