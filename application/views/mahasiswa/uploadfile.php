<?php
	$nama_create_mhs_bimbingan = $_GET['nama_create_mhs_bimbingan'];
	$nim_create_mhs_bimbingan = $_GET['nim_create_mhs_bimbingan'];
	$date = date('YmdHis');
	$filename = $_FILES['file']['name'];
	$location = "assets/filebimbingan/".$date.' - NIM '.$nim_create_mhs_bimbingan.' - Nama '.$nama_create_mhs_bimbingan.' - '.$filename;
	$uploadOk = 1;
	if($uploadOk == 0){
	   echo 0;
	}else{
	   if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
	      echo '../../'.$location;
	   }else{
	      echo 0;
	   }
	}
?>