<?php

class Stat extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model');
    $this->cookie_name = 'peastat';
  }
  
  public function index(){
    $data = array(
      'pageactive' => 'stat'
    );
    if($this->_check_cookie()){
      header("location: " . site_url('admin'));
    } else {
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