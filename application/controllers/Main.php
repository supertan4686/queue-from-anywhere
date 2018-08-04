<?php

class Main extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model');
    $this->load->model('Employee_model');
    $this->cookie_name = 'peastat';
    // $this->date = date('Y-m-d');
    $this->date = "2018-08-02";

  }
  
  public function index(){
  }

  public function satisfication(){
    if($this->_check_cookie()){
      header("location: " . site_url('admin'));
    } else {
      $a_employee_data = $this->Employee_model->get_satisfication_employee_data($this->date);
      // echo $this->db->last_query();die();
      $data = array(
        'pageactive' => 'satisfication',
        'employee_group' => $a_employee_data
      );
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('satisfication');
      $this->load->view('template/footer');  
    }
  }

  public function analyze(){
    if($this->_check_cookie()){
      header("location: " . site_url('admin/analyze'));
    } else {
      $a_analyze_data = $this->Employee_model->get_analyze_employee_data($this->date);
      // echo $this->db->last_query();die();
      $data = array(
        'pageactive' => 'analyze',
        'a_analyze' => $a_analyze_data
      );
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('analyze');
      $this->load->view('template/footer');  
    }
  }

  public function queue(){
    if($this->_check_cookie()){
      header("location: " . site_url('admin/queue'));
    } else {
      $queue_log = $this->Employee_model->get_queue_log_data($this->date);
      // echo $this->db->last_query();die();
      $data = array(
        'pageactive' => 'queue',
        'queue_log' => $queue_log
      );
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('queue_log');
      $this->load->view('template/footer');  
    }
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