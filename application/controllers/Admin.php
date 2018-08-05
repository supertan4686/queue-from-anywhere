<?php
include(FCPATH . 'assets/phpqrcode/qrlib.php');
require_once FCPATH. 'assets/spout-2.7.3/src/Spout/Autoloader/autoload.php';
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\Border;
use Box\Spout\Writer\Style\BorderBuilder;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;


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
        
        $data = array(
          'pageactive' => 'satisfication',
          'admin_id' => $admin_id,
          'admin' => $admin,
          'dateselected' => isset($dateinput) ? $dateinput : "",
          'employee_group' => $a_employee_data
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('satisfication');
        $this->load->view('template/footer');

        // print_r($a_employee_data);
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
        $data = array(
          'pageactive' => 'analyze',
          'admin_id' => $admin_id,
          'admin' => $admin,
          'dateselected' => isset($dateinput) ? $dateinput : "",
          'a_analyze' => $a_analyze_data
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('analyze');
        $this->load->view('template/footer');
        // print_r($a_analyze_data);

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

        echo $this->db->last_query();

        $data = array(
          'pageactive' => 'queue',
          'queue_log' => $queue_log,
          'admin_id' => $admin_id,
          'dateselected' => isset($dateinput) ? $dateinput : "",
          'admin' => $admin
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('queue_log');
        $this->load->view('template/footer');
        // print_r($queue_log);
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
      // print_r($data);
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
    // echo $this->db->last_query();
    $result = array(
      'type' => 'delete',
      'result' => 'success',
      'employee_id' => $employee_id);
    return echo_json($result);
  }

  public function ajax_get_service_by_id(){
    $queue_type_id = $this->input->get('queue_type_id');
    $service_data = $this->Service_model->get_service_data_by_id($queue_type_id);
    if ($service_data != NULL){
      return echo_json($service_data);
    } else {
      return echo_json();
    }
  }

  public function ajax_submit_service(){
    $data = $this->input->post();
    $checkexistservice = $this->Service_model->check_exist_service($data['queue_type_id']);
    if($checkexistservice == 0){
      //Insert
      $this->Service_model->insert_new_service($data);
      $result = array(
        'type' => 'insert',
        'result' => 'success',
        'queue_type_id' => $data['queue_type_id']
      );
    } else {
      //Update
      $this->Service_model->update_service($data);
      $result = array(
        'type' => 'update',
        'result' => 'success',
        'queue_type_id' => $data['queue_type_id']
      );
    }

    return echo_json($result);
  }

  public function ajax_delete_service(){
    $queue_type_id = $this->input->post('queue_type_id');
    $this->Service_model->delete_service($queue_type_id);
    $result = array(
      'type' => 'delete',
      'result' => 'success',
      'queue_type_id' => $queue_type_id);
    return echo_json($result);
  }

  public function ajax_export_satisfication(){
    $dateinput = $this->input->post('daterange');
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

    $filename = "employee_satisfication_data_" . $dateinput . ".xlsx";
    $a_header = ["employee_id", "employee_name", "amount_customer", "score_0", "score_1", "score_2", "score_3", "score_4", "score_5", "total_score", "score_averange", "satisfaction_percent"];
    $link = $this->_create_excel($filename, $a_employee_data, $a_header);
    echo $link;

  }

  public function ajax_export_analyze(){
    $dateinput = $this->input->post('daterange');
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
    
    $filename = "employee_analyze_data_" . $dateinput . ".xlsx";
    $a_header = ["employee_id", "employee_name", "amount_customer", "success_service", "fail_service", "averange_work_time", "max_work_time", "work_all_time_by_employee"];
    $link = $this->_create_excel($filename, $a_analyze_data, $a_header);
    echo $link;

  }

  public function ajax_export_queue_log(){
    $dateinput = $this->input->post('daterange');
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

    $filename = "queue_log_data_" . $dateinput . ".xlsx";
    $a_header = ["counter_id", "employee_id", "employee_name", "queue", "ca", "queue_create_time", "wait_service_time", "start_service_time", "end_service_time", "score"];
    $link = $this->_create_excel($filename, $queue_log, $a_header);
    echo $link;

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

	private function _create_excel($filename, $a_data, $a_header){
		// Check sheets folder in project
		if(!in_array("export", scandir(FCPATH))){
			mkdir(FCPATH. "export", 0755);
		}
		$filePath = FCPATH . 'export/' . $filename;
    $writer = WriterFactory::create(Type::XLSX); // for XLSX files
		$writer->openToFile($filePath); // write data to a file or to a PHP stream
		$sheet = $writer->getCurrentSheet();
		$sheet_no = 1;
		$sheet->setName('Page_' . $sheet_no);
		$writer->addRow($a_header);
		$rowdata = 0;
    foreach ($a_data as $key => $data) {
      $writer->addRow($data);
      $rowdata++;
      if($rowdata % 10000 == 0){
        $sheet_no++;
        $sheet = $writer->addNewSheetAndMakeItCurrent();
        $sheet->setName('Page_' . $sheet_no);    
        $writer->addRow($header);
      }
		}
    $writer->close();
    $link = base_url() . 'export/' . $filename;
		return $link;
	}

}

?>