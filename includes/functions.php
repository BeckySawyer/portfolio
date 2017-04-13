<?php

/**
 * connects database to the pages
 * @param string $host 
 * @param string $database 
 * @param string $user 
 * @param string $pass 
 * @return boolean
 */
function connectDatabase($host, $database, $user, $pass) {
	try {
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 return $dbh;
} catch (PDOException $e) {
	print('Error! ' . $e->getMessage() . '<br>');
	die();
	}
}

/**
 * gets all the  projects from the database
 * @param string $dbh 
 * @return boolean
 */
function getProjects($dbh) {
    $sth = $dbh->prepare("SELECT * FROM projects");
	$sth->execute();
	$result = $sth->fetchAll();
	return $result;
}


/**
 * adds a project into the database
 * @param string $dbh 
 * @param string $title 
 * @param string $img_url 
 * @param string $content 
 * @param string $link 
 * @return boolean
 */
function addProject($dbh, $title, $img_url, $content, $link) {
	 $sth = $dbh->prepare("INSERT INTO projects (title, img_url, content, link, created_at, updated_at, user_id) VALUES (:title, :img_url, :content, :link, NOW(), NOW(), :user_id)");
	 $sth->bindParam(':title', $title, PDO::PARAM_STR);
	 $sth->bindParam(':img_url', $img_url, PDO::PARAM_STR);
	 $sth->bindParam(':content', $content, PDO::PARAM_STR);
	 $sth->bindParam(':link', $link, PDO::PARAM_STR);
	 $sth->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
	 $success = $sth->execute();
	 return $success;
}

/**
 * deletes single project from the database
 * @param int $id 
 * @param string $dbh 
 * @return boolean
 */
function deleteProject($id, $dbh) {
	$result = $dbh->prepare("DELETE FROM projects WHERE id = :id LIMIT 1");
	$result->bindParam(':id', $id);
	$result->execute();
}

/**
 * redirects to another page
 * @param string $url 
 * @return url
 */
function redirect($url) {
 	header('Location: ' . $url);
 	die();
}

/**
 * gets project from database to be edited
 * @param int $id 
 * @param string $dbh 
 * @return boolean
 */
function editProject($id, $dbh) {
	$sth = $dbh->prepare("SELECT * FROM projects WHERE id = :id LIMIT 1");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch();
	return $result;
}

/**
 * binds updated project info to go back into database
 * @param int $id 
 * @param string $dbh 
 * @param string $title 
 * @param string $img_url 
 * @param string $content 
 * @param string $link 
 * @return boolean
 */
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

/**
 * finds a single project to show on the page
 * @param int $id 
 * @param string $dbh 
 * @return boolean
 */
function singleProject($id, $dbh) {
	$sth = $dbh->prepare("SELECT * FROM projects WHERE id = :id LIMIT 1");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetch();
	return $result;
}

function getComments($id, $dbh) {
	$sth = $dbh->prepare("SELECT comments.id, comments.content, comments.project_id, comments.user_id, comments.created_at, comments.updated_at, users.username, users.email FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.project_id = :id ORDER BY comments.created_at DESC");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();
	$result = $sth->fetchAll();
	if(!empty($result)) {
		return $result;
	}
	return false;
}

function deleteComment($id, $dbh) {
  $result = $dbh->prepare("DELETE FROM comments WHERE id = :id LIMIT 1");
  $result->bindParam(':id', $id);
  $result->execute();
}

/**
 * Description
 * @param type $value 
 * @return type
 */
function e($value) {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Description
 * @return type
 */
function loggedIn() {
	return !empty($_SESSION['username']);
}

/**
 * Description
 * @param type $dbh 
 * @param type $username 
 * @param type $email 
 * @param type $password 
 * @return type
 */
function addUser($dbh, $username, $email, $password) {
	$sth = $dbh->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
	$sth->bindParam(':username', $username, PDO::PARAM_STR);
	$sth->bindParam(':email', $email, PDO::PARAM_STR);
	$sth->bindParam(':password', $password, PDO::PARAM_STR);
	$success = $sth->execute();
	return $success;
}

/**
 * Description
 * @param string $type 
 * @param string $message 
 * @return boolean
 */
function addMessage($type, $message) {
  $_SESSION['flash'][$type][] = $message;
}

/**
 * shows the message
 * @param string $type 
 * @return boolean
 */
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

/**
 * gets the user from the database
 * @param string $dbh 
 * @param string $username 
 * @return boolean
 */
function getUser($dbh, $username) {
	$sth = $dbh->prepare('SELECT * FROM users WHERE username = :username OR email = :email LIMIT 1');
	$sth->bindValue(':username', $username, PDO::PARAM_STR);
	$sth->bindValue(':email', $username, PDO::PARAM_STR);
	$sth->execute();
	$row = $sth->fetch();
	if (!empty($row)) {
		return $row;
	}
	return false;
}

/**
 * gets the users gravatar
 * @param string $email 
 * @param int $s 
 * @param string $d 
 * @param string $r 
 * @param bool $img 
 * @param array $atts 
 * @return boolean
 */
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

function userOwns($id) {
	if (loggedIn() && $_SESSION['id'] == $id) {
		return true;
	}
	return false;
}


function addComment($dbh, $project_id, $content) {
	 $sth = $dbh->prepare("INSERT INTO comments (content, user_id, project_id, created_at, updated_at) VALUES (:content, :user_id, :project_id, NOW(), NOW())");
	 $sth->bindParam(':content', $content, PDO::PARAM_STR);
	 $sth->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
	 $sth->bindParam(':project_id', $project_id, PDO::PARAM_INT);
	 $success = $sth->execute();
	 return $success;
}

/**
 * Returns a human-readable time from a timestamp
 * @param timestamp $timestamp
 * @return string
 */
function formatTime($timestamp)
{
  // Get time difference and setup arrays
  $difference = time() - $timestamp;
  $periods = array("second", "minute", "hour", "day", "week", "month", "years");
  $lengths = array("60","60","24","7","4.35","12");
 
  // Past or present
  if ($difference === 0) {
    return 'Just now';
  }
  if ($difference >= 0)
  {
    $ending = "ago";
  }
  else
  {
    $difference = -$difference;
    $ending = "to go";
  }
 
  // Figure out difference by looping while less than array length
  // and difference is larger than lengths.
  $arr_len = count($lengths);
  for($j = 0; $j < $arr_len && $difference >= $lengths[$j]; $j++)
  {
    $difference /= $lengths[$j];
  }
 
  // Round up
  $difference = round($difference);
 
  // Make plural if needed
  if($difference != 1)
  {
    $periods[$j].= "s";
  }
 
  // Default format
  $text = "$difference $periods[$j] $ending";
 
  // over 24 hours
  if($j > 2)
  {
    // future date over a day formate with year
    if($ending == "to go")
    {
      if($j == 3 && $difference == 1)
      {
        $text = "Tomorrow at ". date("g:i a", $timestamp);
      }
      else
      {
        $text = date("F j, Y \a\\t g:i a", $timestamp);
      }
      return $text;
    }
 
    if($j == 3 && $difference == 1) // Yesterday
    {
      $text = "Yesterday at ". date("g:i a", $timestamp);
    }
    else if($j == 3) // Less than a week display -- Monday at 5:28pm
    {
      $text = date("l \a\\t g:i a", $timestamp);
    }
    else if($j < 6 && !($j == 5 && $difference == 12)) // Less than a year display -- June 25 at 5:23am
    {
      $text = date("F j \a\\t g:i a", $timestamp);
    }
    else // if over a year or the same month one year ago -- June 30, 2010 at 5:34pm
    {
      $text = date("F j, Y \a\\t g:i a", $timestamp);
    }
  }
 
  return $text;
}