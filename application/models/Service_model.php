<?php
class Service_model extends CI_Model {
  
  function __construct() {
		parent::__construct();
		$this->load->database();
	}

  function get_service_data(){
    return $this->db->get('services')->result_array();
  }

  function get_service_data_by_id($service_id){
		$this->db->where('service_id', $service_id);
		return $this->db->get('services')->row_array();
  }

  function check_exist_service($service_id){
    $this->db->where('service_id', $service_id);
		return $this->db->get('services')->num_rows();
  }

  function insert_new_service($data){
    return $this->db->insert('services', $data);
  }

  function update_service($data){
		$this->db->where('service_id', $data['service_id']);
		return $this->db->update('services', $data);
  }

  function delete_service($service_id){
		$this->db->where('service_id', $service_id);
		return $this->db->delete('services');

  }
}

?>