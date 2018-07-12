<?php
include(FCPATH . 'assets/phpqrcode/qrlib.php');

class Admin extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model');
    $this->load->model('Employee_model');
    $this->load->model('Service_model');
    $this->load->helper('common_helper');
    $this->cookie_name = 'peastat';
    $this->date = date('Y-m-d');
  }
  
  public function index(){
  }

  public function satisfication(){
    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        header("location: " . site_url('admin/login'));
      } else {
        $admin =  $this->Admin_model->get_admin_by_id($admin_id);
        $a_employee_data = $this->Employee_model->get_satisfication_employee_data($this->date);
        // print_r($a_employee_data);
        $data = array(
          'pageactive' => 'satisfication',
          'admin_id' => $admin_id,
          'admin' => $admin,
          'employee_group' => $a_employee_data
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('satisfication');
        $this->load->view('template/footer');
      }
    } else {
      header("location: " . site_url('admin/login'));
    }
  }

  public function analyze(){
    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        header("location: " . site_url('admin/login'));
      } else {
        $admin =  $this->Admin_model->get_admin_by_id($admin_id);
        $a_analyze_data = $this->Employee_model->get_analyze_employee_data($this->date);
        $data = array(
          'pageactive' => 'analyze',
          'admin_id' => $admin_id,
          'admin' => $admin,
          'a_analyze' => $a_analyze_data
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('analyze');
        $this->load->view('template/footer');
      }
    } else {
      header("location: " . site_url('admin/login'));
    }
  }

  public function queue(){
    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        header("location: " . site_url('admin/login'));
      } else {
        $admin =  $this->Admin_model->get_admin_by_id($admin_id);
        $queue_log = $this->Employee_model->get_queue_log_data($this->date);
        // print_r($a_employee_data);
        $data = array(
          'pageactive' => 'queue',
          'queue_log' => $queue_log,
          'admin_id' => $admin_id,
          'admin' => $admin,
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('queue_log');
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
    $act = $this->input->get('act');
    $employee_id = $this->input->get('employee');

    if ($act == 'insert') {
      $message_act = 'เพิ่มข้อมูลพนักงานรหัส ' . $employee_id . 'เรียบร้อยแล้ว';
    } else if ($act == 'update') {
      $message_act = 'อัพเดตข้อมูลพนักงานรหัส ' . $employee_id . 'เรียบร้อยแล้ว';
    } else if ($act == 'delete') {
      $message_act = 'ลบข้อมูลพนักงานรหัส ' . $employee_id . 'เรียบร้อยแล้ว';
    } else {
      $message_act = 'เพิ่ม,ลบหรืออัพเดตข้อมูลพนักงานรหัส ' . $employee_id . 'ล้มเหลว';
    }

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
          'a_employee' => $a_employee,
          'act' => $act,
          'message_act' => $message_act);
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
    $act = $this->input->get('act');
    $service_id = $this->input->get('service');

    if ($act == 'insert') {
      $message_act = 'เพิ่มข้อมูลกลุ่มงานบริการรหัส ' . $service_id . 'เรียบร้อยแล้ว';
    } else if ($act == 'update') {
      $message_act = 'อัพเดตข้อมูลกลุ่มงานบริการรหัส ' . $service_id . 'เรียบร้อยแล้ว';
    } else if ($act == 'delete') {
      $message_act = 'ลบข้อมูลกลุ่มงานบริการรหัส ' . $service_id . 'เรียบร้อยแล้ว';
    } else {
      $message_act = 'เพิ่ม,ลบหรืออัพเดตข้อมูลพนักงานรหัส ' . $service_id . 'ล้มเหลว';
    }
    if($this->_check_cookie()){
      $cookie = $_COOKIE[$this->cookie_name];
      $tokenexplode = explode(" ", $cookie);
      $token = $tokenexplode[1];
      $admin_id = $this->Admin_model->get_admin_id_by_token($token);
      if($admin_id == NULL){
        header("location: " . site_url('admin/login'));
      } else {
        $admin =  $this->Admin_model->get_admin_by_id($admin_id);
        $a_service = $this->Service_model->get_service_data();
        $data = array(
          'pageactive' => 'service',
          'admin_id' => $admin_id,
          'admin' => $admin,
          'a_service' => $a_service,
          'act' => $act,
          'message_act' => $message_act);
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

  public function ajax_get_employee_by_id(){
    $employee_id = $this->input->get('employee_id');
    $employee_data = $this->Employee_model->get_employee_data_by_id($employee_id);
    if ($employee_data != NULL){
      return echo_json($employee_data);
    } else {
      return echo_json();
    }
  }

  public function ajax_submit_employee(){
    $data = $this->input->post();
    $checkexistemployee = $this->Employee_model->check_exist_employee($data['employee_id']);
    if($checkexistemployee == 0){
      //Insert
      $this->Employee_model->insert_new_employee($data);
      $result = array(
        'type' => 'insert',
        'result' => 'success',
        'employee_id' => $data['employee_id']
      );
    } else {
      //Update
      $this->Employee_model->update_employee($data);
      $result = array(
        'type' => 'update',
        'result' => 'success',
        'employee_id' => $data['employee_id']
      );
    }

    return echo_json($result);
  }

  public function ajax_delete_employee(){
    $employee_id = $this->input->post('employee_id');
    $this->Employee_model->delete_employee($employee_id);
    $result = array(
      'type' => 'delete',
      'result' => 'success',
      'employee_id' => $employee_id);
    return echo_json($result);
  }

  public function ajax_get_service_by_id(){
    $service_id = $this->input->get('service_id');
    $service_data = $this->Service_model->get_service_data_by_id($service_id);
    if ($service_data != NULL){
      return echo_json($service_data);
    } else {
      return echo_json();
    }
  }

  public function ajax_submit_service(){
    $data = $this->input->post();
    $checkexistservice = $this->Service_model->check_exist_service($data['service_id']);
    if($checkexistservice == 0){
      //Insert
      $this->Service_model->insert_new_service($data);
      $result = array(
        'type' => 'insert',
        'result' => 'success',
        'service_id' => $data['service_id']
      );
    } else {
      //Update
      $this->Service_model->update_service($data);
      $result = array(
        'type' => 'update',
        'result' => 'success',
        'service_id' => $data['service_id']
      );
    }

    return echo_json($result);
  }

  public function ajax_delete_service(){
    $service_id = $this->input->post('service_id');
    $this->Service_model->delete_service($service_id);
    $result = array(
      'type' => 'delete',
      'result' => 'success',
      'service_id' => $service_id);
    return echo_json($result);
  }

  public function get_qrcode_employee(){
    $employee_id = $this->input->get('id');
    QRcode::png($employee_id, false, QR_ECLEVEL_L, 10, 3);
  }

  public function submit_satisfication_data(){
    $queue_type = $this->input->post('queue_type');
    $queue_number = $this->input->post('queue_number');
    $employee_id = $this->input->post('employee_id');
    $counter_id = $this->input->post('counter');
    $ca = $this->input->post('ca');
    $queue_create_time = $this->input->post('queue_create_time');
    $start_service_time = $this->input->post('start_service_time');
    $end_service_time = $this->input->post('end_service_time');
    $score = $this->input->post('score');
    $a_data = array(
      'queue_type' => $queue_type,
      'queue_number' => $queue_number,
      'employee_id' => $employee_id,
      'counter_id' => $counter_id,
      'ca' => $ca,
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