<?php

class Admin extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model');
    $this->cookie_name = 'peastat';
  }
  
  public function index(){
    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        header("location: " . site_url('admin/login'));
      } else {
        $admin =  $this->Admin_model->get_admin_by_id($admin_id);
        $data = array(
          'pageactive' => 'stat',
          'admin_id' => $admin_id,
          'admin' => $admin
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('stat');
        $this->load->view('template/footer');
      }
    } else {
      header("location: " . site_url('admin/login'));
    }
  }

  public function login(){
    $data = array(
      'pageactive' => 'login'
    );

    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('login');
        $this->load->view('template/footer');  
      } else {
        header("location: " . site_url('admin'));
      }
    } else {
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('login');
      $this->load->view('template/footer');  
    }
  }

  public function employee(){
    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        header("location: " . site_url('admin/login'));
      } else {
        $admin =  $this->Admin_model->get_admin_by_id($admin_id);
        $data = array(
          'pageactive' => 'employee',
          'admin_id' => $admin_id,
          'admin' => $admin
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('employee');
        $this->load->view('template/footer');
      }
    } else {
      header("location: " . site_url('admin/login'));
    }
  }

  public function service(){
    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        header("location: " . site_url('admin/login'));
      } else {
        $admin =  $this->Admin_model->get_admin_by_id($admin_id);
        $data = array(
          'pageactive' => 'service',
          'admin_id' => $admin_id,
          'admin' => $admin
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('service');
        $this->load->view('template/footer');
      }
    } else {
      header("location: " . site_url('admin/login'));
    }
  }

  public function ajax_login(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    // $rememberme = $this->input->post('rememberme');
    $admin = $this->Admin_model->admin_login($username, $password);
    $adminid = $admin['id'];
    if ($adminid != 0) {
      $token = $this->_gen_token();
      $timestamp = time()+(30*24*60*60);
      if ($this->Admin_model->set_session($adminid, $token, $timestamp)) {
        echo 'Success';
      } else {
        echo 'Fail Session';
      }
      
    } else {
      echo 'Fail Data';
    }
  }

  public function ajax_logout(){
    $admin_id = $this->input->post('adminid');
    $cookie = $_COOKIE[$this->cookie_name];
    $tokenexplode = explode(" ", $cookie);
    $token = $tokenexplode[1];
    if ($this->Admin_model->delete_session($admin_id, $token)) {
      echo 'Success';
    } else {
      echo 'Fail';
    }
  }

  public function checktoken(){
    $cookie_name = $this->input->get('c');
    if(!isset($_COOKIE[$cookie_name])) {
      echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value is: " . $_COOKIE[$cookie_name];
    }
  }

  private function _gen_token(){
    $token = bin2hex(openssl_random_pseudo_bytes(64));
    return $token;
  }

  private function _check_cookie(){
    if(isset($_COOKIE[$this->cookie_name])) {
      return true;
    } else {
      return false;
    }
  }

}

?>