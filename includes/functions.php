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

function deleteProject($id, $dbh) {
	$result = $dbh->prepare("DELETE FROM projects WHERE id = :id");
	$result->bindParam(':id', $id);
	$result->execute();
}

function redirect($url) {
 	header('Location: ' . $url);
 	die();
}

function editProject($id, $dbh) {
	$sth = $dbh->prepare("SELECT * FROM projects WHERE id = :id");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch();
	return $result;
}

function updateProject($id, $dbh, $title, $img_url, $content, $link) {
	$sth = $dbh->prepare("UPDATE projects SET title = :title, img_url = :img_url, content = :content, link = :link WHERE id = :id");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->bindParam(':title', $title, PDO::PARAM_STR);
	$sth->bindParam(':img_url', $img_url, PDO::PARAM_STR);
	$sth->bindParam(':content', $content, PDO::PARAM_STR);
	$sth->bindParam(':link', $link, PDO::PARAM_STR);
	$result = $sth->execute();
	return $result;
}

function singleProject($id, $dbh) {
	// prepare statement that will be executed
	$sth = $dbh->prepare("SELECT * FROM projects WHERE id = :id");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch();
	return $result;
}

function e($value) {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
function loggedIn() {
	return !empty($_SESSION['username']);
}

function addUser($dbh, $username, $email, $password) {
	// prepare statement that will be executed
	$sth = $dbh->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
	$sth->bindParam(':username', $username, PDO::PARAM_STR);
	$sth->bindParam(':email', $email, PDO::PARAM_STR);
	$sth->bindParam(':password', $password, PDO::PARAM_STR);
	// execute the statement 
	$success = $sth->execute();
	return $success;
}

function addMessage($type, $message) {
  $_SESSION['flash'][$type][] = $message;
}

function showMessage($type = null)
{
  $messages = '';
  if(!empty($_SESSION['flash'])) {
    foreach ($_SESSION['flash'] as $key => $message) {
      if(($type && $type === $key) || !$type) {
        foreach ($message as $k => $value) {
          unset($_SESSION['flash'][$key][$k]);
          $key = ($key == 'error') ? 'danger': $key;
          $messages .= '<div class="alert alert-' . $key . '">' . $value . '</div>' . "\n";
        }
      }
    }
  }
  return $messages;
}

function getUser($dbh, $username) {
	// prepare statement that will be executed
	$sth = $dbh->prepare('SELECT * FROM `users` WHERE username = :username OR email = :email');
	$sth->bindValue(':username', $username, PDO::PARAM_STR);
	$sth->bindValue(':email', $username, PDO::PARAM_STR);
	// execute the statement 
	$sth->execute();
	$row = $sth->fetch();
	if (!empty($row)) {
		return $row;
	}
	return false;
}

function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}