<?php
	// error_reporting(0);
	session_start();
	$name = $_GET['name'];
	if($name != ''){
		header('Content-Type: application/json');
		$json = json_decode(file_get_contents('php://input'), true);
	    require '../config.php';   
		$get_dosen = mysqli_query($db, "SELECT * FROM datata where pembimbing1 = '$name' or pembimbing2='$name'");
		$row_dosen = mysqli_num_rows($get_dosen);
		$arr_dosen = array();
		while ($data = $get_dosen->fetch_assoc()) {
			array_push($arr_dosen, $data);
		}
		echo json_encode(array('response_code' => '1', 'response_status' => 'data found', 'data' => $arr_dosen));
		mysqli_close($db);
	}
	else{
		echo json_encode("error") ;
	}

	
?>