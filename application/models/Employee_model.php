<?php
class Employee_model extends CI_Model {
  
  function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function get_satisfication_employee_data($startdate, $enddate=""){
	
		//Sub query
		$selectsub_employee_id = "employee_id,";
		$selectsub_amount_customer = "count(score) AS 'amount_customer',";
		$selectsub_score_data = "	SUM(CASE score WHEN '0' THEN 1 ELSE 0 END) AS 'score_0', SUM(CASE score WHEN '1' THEN 1 ELSE 0 END) AS 'score_1', SUM(CASE score WHEN '2' THEN 1 ELSE 0 END) AS 'score_2', SUM(CASE score WHEN '3' THEN 1 ELSE 0 END) AS 'score_3', SUM(CASE score WHEN '4' THEN 1 ELSE 0 END) AS 'score_4', 
		SUM(CASE score WHEN '5' THEN 1 ELSE 0 END) AS 'score_5', SUM(score) AS 'total_score', ";
		$selectsub_satisfication_data = "((1 * SUM(CASE score WHEN '1' THEN 1 ELSE 0 END)) + (2 * SUM(CASE score WHEN '2' THEN 1 ELSE 0 END)) + (3 * SUM(CASE score WHEN '3' THEN 1 ELSE 0 END)) + (4 * SUM(CASE score WHEN '4' THEN 1 ELSE 0 END)) + (5 * SUM(CASE score WHEN '5' THEN 1 ELSE 0 END))) / count(CASE WHEN score != '0' THEN 1 ELSE null END) AS 'score_averange', (((1 * SUM(CASE score WHEN '1' THEN 1 ELSE 0 END)) + (2 * SUM(CASE score WHEN '2' THEN 1 ELSE 0 END)) + (3 * SUM(CASE score WHEN '3' THEN 1 ELSE 0 END)) + (4 * SUM(CASE score WHEN '4' THEN 1 ELSE 0 END)) + (5 * SUM(CASE score WHEN '5' THEN 1 ELSE 0 END))) * 100) / (count(CASE WHEN score != '0' THEN 1 ELSE null END) * 5) AS 'satisfaction_percent'";

		$this->db->select($selectsub_employee_id . $selectsub_amount_customer . $selectsub_score_data . $selectsub_satisfication_data);
		$this->db->join('time_score', 'time_score.queue_log_id = queue_log.queue_log_id');
		if($enddate == ""){
			$this->db->where('date', $startdate);
		} else {
			$this->db->where('date >=', $startdate);
			$this->db->where('date <=', $enddate);
		}
		$this->db->group_by("queue_log.employee_id");

		$subquery_satisfication = $this->db->get_compiled_select('queue_log', FALSE);
		$this->db->reset_query();


		//Main query
		$selectmain = "employee.employee_id, CONCAT(employee.employee_name_title, ' ', `employee`.`employee_firstname`, ' ', employee.employee_lastname) AS 'employee_name', coalesce(satisfication.amount_customer, 0) AS 'amount_customer', coalesce(satisfication.score_0, 0) AS 'score_0',coalesce(satisfication.score_1, 0) AS 'score_1',coalesce(satisfication.score_2, 0) AS 'score_2',coalesce(satisfication.score_3, 0) AS 'score_3',coalesce(satisfication.score_4, 0) AS 'score_4',  coalesce(satisfication.score_5, 0) AS 'score_5',coalesce(satisfication.total_score, 0) AS 'total_score',coalesce(satisfication.score_averange, 0.00) AS 'score_averange',coalesce(satisfication.satisfaction_percent, 0.00) AS 'satisfaction_percent'";

		$this->db->select($selectmain);
		$this->db->from('employee');
		$this->db->join(' (' . $subquery_satisfication . ') AS satisfication', 'employee.employee_id = satisfication.employee_id', 'left outer');
		$this->db->group_by("employee.employee_id");
		//Get query result
		$result = $this->db->get()->result_array();
		return $result;

	}

	function get_analyze_employee_data($startdate, $enddate=""){
		/*START SUB QUERY*/
		// Subquery Get Login Time
		// $selectsub_login_time = "employee_id, min(login_time) AS 'login_time', max(logout_time) AS 'logout_time', TIMEDIFF(max(logout_time), min(login_time)) AS 'work_all_time_by_login'";
		// $selectsub_login_time = "employee_id, TIMEDIFF(max(logout_time), min(login_time)) AS 'work_all_time_by_login'";

		// $this->db->select($selectsub_login_time);
		// $this->db->where('date', $date);
		// $this->db->group_by("employee_id");
		// $subquery_login_time = $this->db->get_compiled_select('login_log', FALSE);
		// $this->db->reset_query();

		// Subquery Get amount customer
		$selectsub_amount_customer = "employee_id, count(score) AS 'amount_customer', count(CASE WHEN `end_service_time` is not null THEN 1 ELSE null END) AS 'success_service', count(CASE WHEN `end_service_time` is null THEN 1 ELSE null END) AS 'fail_service'";
		$this->db->select($selectsub_amount_customer);
		$this->db->join('time_score', 'queue_log.queue_log_id = time_score.queue_log_id');
		if($enddate == ""){
			$this->db->where('date', $startdate);
		} else {
			$this->db->where('date >=', $startdate);
			$this->db->where('date <=', $enddate);
		}
		$this->db->group_by("employee_id");
		$subquery_amount_customer = $this->db->get_compiled_select('queue_log', FALSE);
		$this->db->reset_query();

		// Subquery Get work time
		$selectsub_work_time = "employee_id, SEC_TO_TIME(CAST(AVG(TIME_TO_SEC(TIMEDIFF(`end_service_time`, `start_service_time`))) AS int)) AS 'averange_work_time', MAX(TIMEDIFF(`end_service_time`, `start_service_time`)) AS 'max_work_time', SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`end_service_time`, `start_service_time`)))) AS 'work_all_time_by_employee'";
		$this->db->select($selectsub_work_time);
		$this->db->join('queue_log', 'queue_log.queue_log_id = time_score.queue_log_id');
		$this->db->group_by("employee_id");
		$this->db->where('end_service_time is not null');
		if($enddate == ""){
			$this->db->where('date', $startdate);
		} else {
			$this->db->where('date >=', $startdate);
			$this->db->where('date <=', $enddate);
		}
		$subquery_work_time = $this->db->get_compiled_select('time_score', FALSE);
		$this->db->reset_query();
		/*END SUB QUERY*/

		//Main query
		$select_employee = "employee.employee_id, CONCAT(employee.employee_name_title, ' ', employee.employee_firstname, ' ', employee.employee_lastname) AS 'employee_name'"; // AS employee
		// $select_login_time = "login.work_all_time_by_login"; // AS login
		$select_amount_customer = "coalesce(amount.amount_customer, 0) AS 'amount_customer', coalesce(amount.success_service, 0) AS 'success_service', coalesce(amount.fail_service, 0) AS 'fail_service'"; // AS amount
		$select_work_time = "coalesce(work.averange_work_time, '00:00:00') AS 'averange_work_time', coalesce(work.max_work_time, '00:00:00') AS 'max_work_time', coalesce(work.work_all_time_by_employee, '00:00:00') AS 'work_all_time_by_employee'"; // AS work

		$this->db->select($select_employee . ', '  . $select_amount_customer . ', ' . $select_work_time);
		$this->db->from('employee');
		// $this->db->join(' (' . $subquery_login_time . ') AS login', 'employee.employee_id = login.employee_id', 'left outer');
		$this->db->join(' (' . $subquery_amount_customer . ') AS amount', 'employee.employee_id = amount.employee_id', 'left outer');
		$this->db->join(' (' . $subquery_work_time . ') AS work', 'employee.employee_id = work.employee_id', 'left outer');

		$this->db->group_by("employee.employee_id");

		//Get query result
		$result = $this->db->get()->result_array();
		return $result;
	}

	function get_queue_log_data($startdate, $enddate=""){
		$selectmain = "queue_log.counter_id, queue_log.employee_id, CONCAT(employee.employee_name_title, ' ', employee.employee_firstname, ' ', employee.employee_lastname) AS 'employee_name', CONCAT(queue_type_id, queue_number) AS 'queue', coalesce(ca_log.ca, 'ไม่มีรหัสลูกค้าจากบิล') AS 'ca', queue_log.queue_create_time, TIMEDIFF(time_score.start_service_time, queue_log.queue_create_time) AS 'wait_service_time', time_score.start_service_time, coalesce(time_score.end_service_time, 'ยกเลิกบริการ') AS 'end_service_time', time_score.score";

		$this->db->select($selectmain);
		$this->db->from('queue_log');
		if($enddate == ""){
			$this->db->where('date', $startdate);
		} else {
			$this->db->where('date >=', $startdate);
			$this->db->where('date <=', $enddate);
		}
		$this->db->join('time_score', 'queue_log.queue_log_id = time_score.queue_log_id');
		$this->db->join('ca_log', 'ca_log.queue_log_id = queue_log.queue_log_id', 'left outer');
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