<?php

// connects database to the pages
function connectDatabase($host, $database, $user, $pass) {
	try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 return $dbh;
} catch (PDOException $e) {
	print('Error! ' . $e->getMessage() . '<br>');
	die();
}
}
function getProjects($dbh) {
    $sth = $dbh->prepare("SELECT * FROM projects");
	$sth->execute();
	$result = $sth->fetchAll();
	return $result;
}

function addProject($dbh, $title, $img_url, $content, $link) {
	// prepares the statement that will be executed
	 $sth = $dbh->prepare("INSERT INTO projects (title, img_url, content, link, created_at, updated_at) VALUES (:title, :img_url, :content, :link, NOW(), NOW())");

	 // binds all the values together
	 $sth->bindParam(':title', $title, PDO::PARAM_STR);
	 $sth->bindParam(':img_url', $img_url, PDO::PARAM_STR);
	 $sth->bindParam(':content', $content, PDO::PARAM_STR);
	 $sth->bindParam(':link', $link, PDO::PARAM_STR);

	 // executes the statement
	 $success = $sth->execute();
	 return $success;
}