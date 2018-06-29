<?php
class Employee_model extends CI_Model {
  
  function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function get_stat_employee_data($date){
		//Sub query
		$selectsub = "login_log.employee_id, min(login_log.login_time) AS 'login_time', max(login_log.logout_time) AS 'logout_time'";
		$this->db->select($selectsub);
		$this->db->where('login_log.date', $date);
		$this->db->group_by("login_log.employee_id");
		$subquery = $this->db->get_compiled_select('login_log', FALSE);
		$this->db->reset_query();

		//Main query
		$selectmain = "employee.employee_id, CONCAT(employee.employee_name_title, ' ', employee.employee_firstname, ' ', employee.employee_lastname) AS 'employee_name', login_log.login_time, login_log.logout_time ,count(queue_log.score) AS 'amount_customer', ";

		$select_evaluation_amount = "SUM(queue_log.score) AS 'total_score', SUM(CASE queue_log.score WHEN '0' THEN 1 ELSE 0 END) AS 'score_0', SUM(CASE queue_log.score WHEN '1' THEN 1 ELSE 0 END) AS 'score_1', SUM(CASE queue_log.score WHEN '2' THEN 1 ELSE 0 END) AS 'score_2', SUM(CASE queue_log.score WHEN '3' THEN 1 ELSE 0 END) AS 'score_3', SUM(CASE queue_log.score WHEN '4' THEN 1 ELSE 0 END) AS 'score_4', SUM(CASE queue_log.score WHEN '5' THEN 1 ELSE 0 END) AS 'score_5', ";

		$select_score_averange = "((1 * SUM(CASE queue_log.score WHEN '1' THEN 1 ELSE 0 END)) + (2 * SUM(CASE queue_log.score WHEN '2' THEN 1 ELSE 0 END)) + (3 * SUM(CASE queue_log.score WHEN '3' THEN 1 ELSE 0 END)) + (4 * SUM(CASE queue_log.score WHEN '4' THEN 1 ELSE 0 END)) + (5 * SUM(CASE queue_log.score WHEN '5' THEN 1 ELSE 0 END))) / count(CASE WHEN queue_log.score != '0' THEN 1 ELSE null END) AS 'score_averange', ";

		$select_satisfaction_percent = "(((1 * SUM(CASE queue_log.score WHEN '1' THEN 1 ELSE 0 END)) + (2 * SUM(CASE queue_log.score WHEN '2' THEN 1 ELSE 0 END)) + (3 * SUM(CASE queue_log.score WHEN '3' THEN 1 ELSE 0 END)) + (4 * SUM(CASE queue_log.score WHEN '4' THEN 1 ELSE 0 END)) + (5 * SUM(CASE queue_log.score WHEN '5' THEN 1 ELSE 0 END))) * 100) / (count(CASE WHEN queue_log.score != '0' THEN 1 ELSE null END) * 5) AS 'satisfaction_percent'";

		$this->db->select($selectmain . $select_evaluation_amount . $select_score_averange . $select_satisfaction_percent);
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

	function insert_queue_log($data){
		$this->db->insert('queue_log', $data);
	}

	function get_employee_data(){
		return $this->db->get('employee')->result_array();
	}

	function get_employee_data_by_id($employee_id){
		$this->db->where('employee_id', $employee_id);
		return $this->db->get('employee')->row_array();
	}

	function check_exist_employee($employee_id){
		$this->db->where('employee_id', $employee_id);
		return $this->db->get('employee')->num_rows();
	}

	function insert_new_employee($data){
		return $this->db->insert('employee', $data);
	}

	function update_employee($data){
		$this->db->where('employee_id', $data['employee_id']);
		return $this->db->update('employee', $data);
	}

	function delete_employee($employee_id){
		$this->db->where('employee_id', $employee_id);
		return $this->db->delete('employee');
	}
}

?>