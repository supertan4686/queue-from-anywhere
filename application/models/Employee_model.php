<?php
class Employee_model extends CI_Model {
  
  function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function get_employee_data($date){
		//Sub query
		$selectsub = "login_log.employee_id, min(login_log.login_time) AS 'login_time', max(login_log.logout_time) AS 'logout_time'";
		$this->db->select($selectsub);
		$this->db->where('login_log.date', $date);
		$this->db->group_by("login_log.employee_id");
		$subquery = $this->db->get_compiled_select('login_log', FALSE);
		$this->db->reset_query();

		//Main query
		$selectmain = "employee.employee_id, CONCAT(employee.employee_name_title, ' ', employee.employee_firstname, ' ', employee.employee_lastname) AS 'employee_name', login_log.login_time, login_log.logout_time ,count(queue_log.score) AS 'Amount customer', SUM(queue_log.score) AS 'Total Score', SUM(CASE queue_log.score WHEN '0' THEN 1 ELSE 0 END) AS 'score 0', SUM(CASE queue_log.score WHEN '1' THEN 1 ELSE 0 END) AS 'score 1', SUM(CASE queue_log.score WHEN '2' THEN 1 ELSE 0 END) AS ' score 2', SUM(CASE queue_log.score WHEN '3' THEN 1 ELSE 0 END) AS 'score 3', SUM(CASE queue_log.score WHEN '4' THEN 1 ELSE 0 END) AS 'score 4', SUM(CASE queue_log.score WHEN '5' THEN 1 ELSE 0 END) AS 'score 5'";
		$this->db->select($selectmain);
		$this->db->from('queue_log');
		//Join subquery
		$this->db->join(' (' . $subquery . ') AS login_log', 'login_log.employee_id = queue_log.employee_id');
		//Join employee
		$this->db->join('employee', 'employee.employee_id = queue_log.employee_id');
		$this->db->group_by("queue_log.employee_id");

		//Get query result
		$result = $this->db->get()->result_array();
		return $result;

	}
}

?>