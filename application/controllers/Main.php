<?php

class Main extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model');
    $this->load->model('Employee_model');
    $this->cookie_name = 'peastat';
    $this->date = date('Y-m-d');

  }
  
  public function index(){
  }

  public function satisfication(){
    if($this->_check_cookie()){
      header("location: " . site_url('admin'));
    } else {
      $dateinput = $this->input->get('daterange');
      if($dateinput == ""){
        $startdate = $this->date;
        $enddate = $this->date;
      } else {
        $daterange = explode(" ", $dateinput);
        $startdate = $daterange[0];
        $enddate = $daterange[2];
      }

      if($startdate == $enddate){
        $a_employee_data = $this->Employee_model->get_satisfication_employee_data($startdate);
      } else {
        $a_employee_data = $this->Employee_model->get_satisfication_employee_data($startdate, $enddate);
      }

      // echo $this->db->last_query();die();
      $data = array(
        'pageactive' => 'satisfication',
        'dateselected' => isset($dateinput) ? $dateinput : "",
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
      $dateinput = $this->input->get('daterange');
      if($dateinput == ""){
        $startdate = $this->date;
        $enddate = $this->date;
      } else {
        $daterange = explode(" ", $dateinput);
        $startdate = $daterange[0];
        $enddate = $daterange[2];
      }

      if($startdate == $enddate){
        $a_analyze_data = $this->Employee_model->get_analyze_employee_data($startdate);
      } else {
        $a_analyze_data = $this->Employee_model->get_analyze_employee_data($startdate, $enddate);
      }

      // echo $this->db->last_query();die();
      $data = array(
        'pageactive' => 'analyze',
        'dateselected' => isset($dateinput) ? $dateinput : "",
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
      $dateinput = $this->input->get('daterange');
      if($dateinput == ""){
        $startdate = $this->date;
        $enddate = $this->date;
      } else {
        $daterange = explode(" ", $dateinput);
        $startdate = $daterange[0];
        $enddate = $daterange[2];
      }

      if($startdate == $enddate){
        $queue_log = $this->Employee_model->get_queue_log_data($startdate);
      } else {
        $queue_log = $this->Employee_model->get_queue_log_data($startdate, $enddate);
      }

      // echo $this->db->last_query();die();
      $data = array(
        'pageactive' => 'queue',
        'dateselected' => isset($dateinput) ? $dateinput : "",
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