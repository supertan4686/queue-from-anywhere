<?php

class Stat extends CI_Controller {
  
  public function __construct() {
		parent::__construct();
  }
  
  public function index(){
    $pageactive = array('pageactive'=>'stat');
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $pageactive);
    $this->load->view('stat');
    $this->load->view('template/footer');  }
}

?>