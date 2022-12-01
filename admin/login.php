<?php
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	include "../config/config.php";
	
	session_start();
	
	$sql = "SELECT * FROM admin_tbl WHERE username = '$username' and password = '$password'";
	$quser = $koneksi->query($sql);
	$rowuser = $quser->fetch_assoc();
	
	if(!empty($rowuser)){	
		$_SESSION['username'] = $username;;
		header("location:./main.php");
	}
	else {
		header("location:./index.php?error1");	
	}
?>