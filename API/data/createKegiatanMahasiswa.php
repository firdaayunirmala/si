<?php
	// error_reporting(0);
	session_start();
	$nim_create_mhs_bimbingan = $_GET['nim_create_mhs_bimbingan'];
	if($nim_create_mhs_bimbingan != ''){
		header('Content-Type: application/json');
		$json = json_decode(file_get_contents('php://input'), true);
	    require '../config.php';   
	    $nama_create_mhs_bimbingan = $_GET['nama_create_mhs_bimbingan'];
	    $tanggal = $_GET['tanggal'];
	    $konsultasi = $_GET['konsultasi'];
	    $dosbing1 = $_GET['dosbing1'];
	    $dosbing2 = $_GET['dosbing2'];
	    $file_data_create_mhs_bimbingan = $_GET['file_data_create_mhs_bimbingan'];

		$query = "INSERT INTO kegiatan(nim, nama, tanggal, konsultasi, dosbing1, dosbing2, file)
                    VALUES('$nim_create_mhs_bimbingan','$nama_create_mhs_bimbingan','$tanggal','$konsultasi','$dosbing1','$dosbing2','$file_data_create_mhs_bimbingan')";   
        $result = $db->query($query);      
        echo "success";
		
	}
	else{
		echo "error";
	}
?>