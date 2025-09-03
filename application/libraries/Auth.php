<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth library
 *
 * @author  Asyhadi Laksono Hakim
 */
class Auth
{
   var $CI = NULL;
   function __construct()
   {
      // get CI's object
      $this->CI = &get_instance();
   }
   // untuk validasi login
   function do_login($username, $password)
   {
      // cek di database, ada ga?
      /*
	  $encrypt = md5($password);
	  $query = "SELECT * FROM tbl_user WHERE usr_name = '$username' and usr_pswd = '$encrypt'";
	  $hasil = $this->CI->db->query($query);
	  */

      $newuser = array(
         'username'        => $username,
         'ip address'      => $_SERVER["REMOTE_ADDR"],
         'browser'      => $_SERVER['HTTP_USER_AGENT'],
         'logged_in'       => TRUE
      );
      $this->CI->session->set_userdata($newuser);
      return true;
   }
   // untuk mengecek apakah user sudah login/belum
   function is_logged_in()
   {
      if ($this->CI->session->userdata('username') == '') {
         return false;
      }
      return true;
   }
   // untuk validasi di setiap halaman yang mengharuskan authentikasi
   function restrict()
   {
      if ($this->is_logged_in() == false) {
         redirect('admin/login');
      }
   }
   // untuk logout
   function do_logout()
   {
      $this->CI->session->sess_destroy();
   }
}
