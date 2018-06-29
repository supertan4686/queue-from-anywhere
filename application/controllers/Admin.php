<?php

class Admin extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model');
    $this->load->model('Employee_model');
    $this->cookie_name = 'peastat';
    $this->date = '2018-06-01';
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
        $a_employee_data = $this->Employee_model->get_stat_employee_data($this->date);
        // print_r($a_employee_data);
        $data = array(
          'pageactive' => 'stat',
          'admin_id' => $admin_id,
          'admin' => $admin,
          'employee_group' => $a_employee_data
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
        $a_employee = $this->Employee_model->get_employee_data();
        $data = array(
          'pageactive' => 'employee',
          'admin_id' => $admin_id,
          'admin' => $admin,
          'a_employee' => $a_employee
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

  public function submit_satisfication_data(){
    $queue_type = $this->input->post('queue_type');
    $queue_number = $this->input->post('queue_number');
    $employee_id = $this->input->post('employee_id');
    $counter_id = $this->input->post('counter');
    $queue_create_time = $this->input->post('queue_create_time');
    $start_service_time = $this->input->post('start_service_time');
    $end_service_time = $this->input->post('end_service_time');
    $score = $this->input->post('score');
    $a_data = array(
      'queue_type' => $queue_type,
      'queue_number' => $queue_number,
      'employee_id' => $employee_id,
      'counter_id' => $counter_id,
      'queue_create_time' => $queue_create_time,
      'start_service_time' => $start_service_time,
      'end_service_time' => $end_service_time,
      'score' => $score,
    );

    $this->Employee_model->insert_queue_log($a_data);

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