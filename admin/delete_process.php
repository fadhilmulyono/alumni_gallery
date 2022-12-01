<?php 
	include "../config/config.php";
	$id = $_GET['id'];
	$sql = "DELETE FROM alumni_tbl WHERE id = $id";
	$query = $koneksi->query($sql);
	
	header("location:../admin/main.php");
?>
