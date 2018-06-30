<?php
class Employee_model extends CI_Model {
  
  function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function get_satisfication_employee_data($date){
	
		//Main query
		$selectmain = "employee.employee_id, CONCAT(employee.employee_name_title, ' ', employee.employee_firstname, ' ', employee.employee_lastname) AS 'employee_name',count(queue_log.score) AS 'amount_customer', ";

		$select_evaluation_amount = "SUM(queue_log.score) AS 'total_score', SUM(CASE queue_log.score WHEN '0' THEN 1 ELSE 0 END) AS 'score_0', SUM(CASE queue_log.score WHEN '1' THEN 1 ELSE 0 END) AS 'score_1', SUM(CASE queue_log.score WHEN '2' THEN 1 ELSE 0 END) AS 'score_2', SUM(CASE queue_log.score WHEN '3' THEN 1 ELSE 0 END) AS 'score_3', SUM(CASE queue_log.score WHEN '4' THEN 1 ELSE 0 END) AS 'score_4', SUM(CASE queue_log.score WHEN '5' THEN 1 ELSE 0 END) AS 'score_5', ";

		$select_score_averange = "((1 * SUM(CASE queue_log.score WHEN '1' THEN 1 ELSE 0 END)) + (2 * SUM(CASE queue_log.score WHEN '2' THEN 1 ELSE 0 END)) + (3 * SUM(CASE queue_log.score WHEN '3' THEN 1 ELSE 0 END)) + (4 * SUM(CASE queue_log.score WHEN '4' THEN 1 ELSE 0 END)) + (5 * SUM(CASE queue_log.score WHEN '5' THEN 1 ELSE 0 END))) / count(CASE WHEN queue_log.score != '0' THEN 1 ELSE null END) AS 'score_averange', ";

		$select_satisfaction_percent = "(((1 * SUM(CASE queue_log.score WHEN '1' THEN 1 ELSE 0 END)) + (2 * SUM(CASE queue_log.score WHEN '2' THEN 1 ELSE 0 END)) + (3 * SUM(CASE queue_log.score WHEN '3' THEN 1 ELSE 0 END)) + (4 * SUM(CASE queue_log.score WHEN '4' THEN 1 ELSE 0 END)) + (5 * SUM(CASE queue_log.score WHEN '5' THEN 1 ELSE 0 END))) * 100) / (count(CASE WHEN queue_log.score != '0' THEN 1 ELSE null END) * 5) AS 'satisfaction_percent'";

		$this->db->select($selectmain . $select_evaluation_amount . $select_score_averange . $select_satisfaction_percent);
		$this->db->from('queue_log');
		$this->db->where('timestamp', $date);
		$this->db->join('employee', 'employee.employee_id = queue_log.employee_id');
		$this->db->group_by("queue_log.employee_id");

		//Get query result
		$result = $this->db->get()->result_array();
		return $result;

	}

	function get_analyze_employee_data($date){
		/*START SUB QUERY*/
		// Subquery Get Login Time
		$selectsub_login_time = "employee_id, min(login_time) AS 'login_time', max(logout_time) AS 'logout_time', TIMEDIFF(max(logout_time), min(login_time)) AS 'work_all_time_by_login'";
		$this->db->select($selectsub_login_time);
		$this->db->where('timestamp', $date);
		$this->db->group_by("employee_id");
		$subquery_login_time = $this->db->get_compiled_select('login_log', FALSE);
		$this->db->reset_query();

		// Subquery Get amount customer
		$selectsub_amount_customer = "employee_id, count(score) AS 'amount_customer', count(CASE WHEN `end_service_time` is not null THEN 1 ELSE null END) AS 'success_service', count(CASE WHEN `end_service_time` is null THEN 1 ELSE null END) AS 'fail_service'";
		$this->db->select($selectsub_amount_customer);
		$this->db->where('timestamp', $date);
		$this->db->group_by("employee_id");
		$subquery_amount_customer = $this->db->get_compiled_select('queue_log', FALSE);
		$this->db->reset_query();

		// Subquery Get work time
		$selectsub_work_time = "employee_id, SEC_TO_TIME(CAST(AVG(TIME_TO_SEC(TIMEDIFF(`end_service_time`, `start_service_time`))) AS int)) AS 'averange_work_time', MAX(TIMEDIFF(`end_service_time`, `start_service_time`)) AS 'max_work_time', SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`end_service_time`, `start_service_time`)))) AS 'work_all_time_by_employee'";
		$this->db->select($selectsub_work_time);
		$this->db->group_by("employee_id");
		$this->db->where('end_service_time is not null');
		$this->db->where('timestamp', $date);
		$subquery_work_time = $this->db->get_compiled_select('queue_log', FALSE);
		$this->db->reset_query();
		/*END SUB QUERY*/

		//Main query
		$select_employee = "employee.employee_id, CONCAT(employee.employee_name_title, ' ', employee.employee_firstname, ' ', employee.employee_lastname) AS 'employee_name'"; // AS employee
		$select_login_time = "login.login_time, login.logout_time, login.work_all_time_by_login"; // AS login
		$select_amount_customer = "amount.amount_customer, amount.success_service, amount.fail_service"; // AS amount
		$select_work_time = "work.averange_work_time, work.max_work_time, work.work_all_time_by_employee"; // AS work

		$this->db->select($select_employee . ', ' . $select_login_time . ', ' . $select_amount_customer . ', ' . $select_work_time);
		$this->db->from('employee');
		$this->db->join(' (' . $subquery_login_time . ') AS login', 'employee.employee_id = login.employee_id');
		$this->db->join(' (' . $subquery_amount_customer . ') AS amount', 'employee.employee_id = amount.employee_id');
		$this->db->join(' (' . $subquery_work_time . ') AS work', 'employee.employee_id = work.employee_id');

		$this->db->group_by("employee.employee_id");

		//Get query result
		$result = $this->db->get()->result_array();
		return $result;
	}

	function get_queue_log_data($date){
		$selectmain = "queue_log.counter_id, queue_log.employee_id, CONCAT(employee.employee_name_title, ' ', employee.employee_firstname, ' ', employee.employee_lastname) AS 'employee_name', CONCAT(queue_log.queue_type, queue_log.queue_number) AS 'queue', queue_log.ca ,queue_log.queue_create_time, TIMEDIFF(queue_log.start_service_time, queue_log.queue_create_time) AS wait_service_time, queue_log.start_service_time, queue_log.end_service_time, queue_log.score";

		$this->db->select($selectmain);
		$this->db->from('queue_log');
		$this->db->where('timestamp', $date);
		$this->db->join('employee', 'employee.employee_id = queue_log.employee_id');

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