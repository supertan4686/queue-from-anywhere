<?php

class Stat extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model');
    $this->load->model('Employee_model');
    $this->cookie_name = 'peastat';
    $this->date = '2018-06-01';
  }
  
  public function index(){
    if($this->_check_cookie()){
      header("location: " . site_url('admin'));
    } else {
      $a_employee_data = $this->Employee_model->get_employee_data($this->date);
      $data = array(
        'pageactive' => 'stat',
        'employee_group' => $a_employee_data
      );
      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('stat');
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