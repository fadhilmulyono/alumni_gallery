<?php 
	include "../config/config.php";
	
	$name = htmlentities ($_POST['name'], ENT_QUOTES);
	$photo_name = htmlentities ($_POST['photo_name'], ENT_QUOTES);
    $year = htmlentities ($_POST['year'], ENT_QUOTES);
	$grade = htmlentities ($_POST['grade'], ENT_QUOTES);
	
	$image = $_FILES['image']['name'];
	
	move_uploaded_file($_FILES['image']['tmp_name'],'../photos/'.$image);
	
	$sql = "INSERT INTO alumni_tbl (name, photo_name, class_of, grade)
	VALUES ('$name', '$photo_name', '$year', '$grade')";
	
	$quser = $koneksi->query($sql);
	
	header('location:./main.php');

?>