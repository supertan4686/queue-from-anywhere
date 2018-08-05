<?php
class Service_model extends CI_Model {
  
  function __construct() {
		parent::__construct();
		$this->load->database();
	}

  function get_service_data(){
    return $this->db->get('queue_type')->result_array();
  }

  function get_service_data_by_id($queue_type_id){
		$this->db->where('queue_type_id', $queue_type_id);
		return $this->db->get('queue_type')->row_array();
  }

  function check_exist_service($queue_type_id){
    $this->db->where('queue_type_id', $queue_type_id);
		return $this->db->get('queue_type')->num_rows();
  }

  function insert_new_service($data){
    return $this->db->insert('queue_type', $data);
  }

  function update_service($data){
		$this->db->where('queue_type_id', $data['queue_type_id']);
		return $this->db->update('queue_type', $data);
  }

  function delete_service($queue_type_id){
		$this->db->where('queue_type_id', $queue_type_id);
		return $this->db->delete('queue_type');

  }
}

?>