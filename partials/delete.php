<?php
	require 'includes/config.php';
	$id=$_POST['id'];
	$result = $db->prepare("DELETE FROM projects WHERE id= :id");
	$result->bindParam(':id', $id);
	$result->execute();
	header("location: index.php");