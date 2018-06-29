<?php
  	function echo_json($data = array()){
		$a_json = array(
			'data' => $data,
		);
		
		echo json_encode($a_json);
	}

?>
