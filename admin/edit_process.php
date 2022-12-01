<?php 
	include "../config/config.php";
	
	$id = $_GET['id'];
	
	$name = htmlentities ($_POST['name'], ENT_QUOTES);
	$photo_name = htmlentities ($_POST['photo_name'], ENT_QUOTES);
    $year = htmlentities ($_POST['year'], ENT_QUOTES);
	$grade = htmlentities ($_POST['grade'], ENT_QUOTES);
	
	$image_old = $_POST['image_old'];
	
	if($_FILES['image']['error'] == 0){	
		$image = $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],'../photos/'.$image);	
		
		$sql = "UPDATE alumni_tbl SET name = '$name', photo_name = '$photo_name', year = '$year', grade = '$grade'
				WHERE id = $id";
				//echo $sql; exit;
	} else {
		$sql = "UPDATE alumni_tbl SET name = '$name', photo_name = '$photo_name', year = '$year', grade = '$grade'
        WHERE id = $id";
        //echo $sql; exit;	
	}
	
	$qnews = $koneksi->query($sql);
	
	header('location:../main.php');

?>