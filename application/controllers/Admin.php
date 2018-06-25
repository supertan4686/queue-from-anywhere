<?php

class Admin extends CI_Controller {
  
  public function __construct() {
		parent::__construct();
  }
  
  public function index(){
    $pageactive = array('pageactive'=>'admin');
    $this->load->view('template/header');
    $this->load->view('template/sidebar_admin', $pageactive);
    $this->load->view('stat');
    $this->load->view('template/footer');
  }

  public function login(){
    $pageactive = array('pageactive'=>'login');
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $pageactive);
    $this->load->view('login');
    $this->load->view('template/footer');
  }

  public function employee(){
    $pageactive = array('pageactive'=>'employee');
    $this->load->view('template/header');
    $this->load->view('template/sidebar_admin', $pageactive);
    $this->load->view('employee');
    $this->load->view('template/footer');
  }

  public function service(){
    $pageactive = array('pageactive'=>'service');
    $this->load->view('template/header');
    $this->load->view('template/sidebar_admin', $pageactive);
    $this->load->view('service');
    $this->load->view('template/footer');
  }
}

?>