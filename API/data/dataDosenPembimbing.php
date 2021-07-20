<?php
	// error_reporting(0);
	session_start();
	
	if($_GET['nim']){
		$nim = $_GET['nim'];
		if($nim != ''){
			header('Content-Type: application/json');
			$json = json_decode(file_get_contents('php://input'), true);
		    require '../config.php';
		    $query = "SELECT nim , pembimbing1, pembimbing2 FROM datata where nim ='$nim'";
		    $rowCountMhs=mysqli_query($db,$query)->num_rows;
		    if($rowCountMhs!=0){
			    $result = mysqli_query($db,$query);
			    $baris= mysqli_fetch_array($result);
			    $pembimbing1= $baris['pembimbing1'];
				$pembimbing2= $baris['pembimbing2'];
				$get_dosen = mysqli_query($db, "SELECT name, email, hp FROM dosen where nik = '$pembimbing1' or '$pembimbing2' ");
				$row_dosen = mysqli_num_rows($get_dosen);
				$arr_dosen = array();
				while ($data = $get_dosen->fetch_assoc()) {
					array_push($arr_dosen, $data);
				}
				echo json_encode(array('response_code' => '1', 'response_status' => 'data found', 'data' => $arr_dosen));
				mysqli_close($db);
			}
			else{
				echo json_encode("data_not_found"); 
			}
		}
		else{
			echo json_encode("error") ;
		}
	}
