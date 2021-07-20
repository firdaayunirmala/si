<?php
	error_reporting(0);
	session_start();
	$nim = $_GET['nim'];
	if($nim != ''){
		header('Content-Type: application/json');
		$json = json_decode(file_get_contents('php://input'), true);
	    require '../config.php';
	    $result = $db->query("select * from datata where nim='$nim'");
        $rowCount=$result->num_rows;
        if($rowCount==0){
        	$resultMhs = $db->query("select * from mahasiswa where nim='$nim'");
	        $rowCountMhs=$resultMhs->num_rows;
	        if($rowCountMhs!=0){
	        	$get_mahasiswa = mysqli_query($db, "SELECT * FROM mahasiswa where nim ='$nim'");
				$row_mahasiswa = mysqli_num_rows($get_mahasiswa);
				$arr_mahasiswa = array();
				while ($data = $get_mahasiswa->fetch_assoc()) {
					array_push($arr_mahasiswa, $data);
				}
				echo json_encode(array('response_code' => '1', 'response_status' => 'data found', 'data' => $arr_mahasiswa));
				mysqli_close($db);
			}
			else{
				echo json_encode("data_mahasiswa_not_found");
			}
		}
		else{
			echo json_encode("data_found_datata");
		}
	}
	else{
		echo json_encode("error");
	}
?>