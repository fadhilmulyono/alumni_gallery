<?php 
	include "../config/config.php";
	$id = $_GET['id'];
	$sql = "UPDATE alumni_tbl SET status = 'In Memoriam' WHERE id = $id";
	$query = $koneksi->query($sql);
	
	header("location:../admin/main.php");
?>