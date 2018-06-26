<?php
class Admin_model extends CI_Model {
  
  function __construct() {
		parent::__construct();
		$this->load->database();
  }
  
  function admin_login ($username, $password) {
    $this->db->select('id');
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    return $this->db->get('admin')->row_array();
  }

  function get_admin_id_by_token($token){
    $this->db->select('admin_id');
    $this->db->where('token', $token);
    $result = $this->db->get('admin_session')->row_array();
    return $result['admin_id'];
  }

  function get_admin_by_id($admin_id){
    $this->db->select('username');
    $this->db->where('id', $admin_id);
    $result = $this->db->get('admin')->row_array();
    return $result['username'];
  }

  function set_session ($admin_id, $token, $timestamp) {
    setcookie("peastat", 'Bearer '. $token, $timestamp, "/");
    $data = array(
      'admin_id' => $admin_id,
      'token' => $token
    );
    return $this->db->insert('admin_session', $data);
  }
  function delete_session ($admin_id, $token) {
    setcookie("peastat", "", -1, "/");
    $this->db->where('admin_id', $admin_id);
    $this->db->where('token', $token);
    $this->db->delete('admin_session');
    if($this->db->affected_rows() == 1){
      return true;
    } else {
      return false;
    }
  }

}

?>