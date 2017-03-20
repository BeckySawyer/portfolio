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


// }

// // searches through the array
// function filterResults($searchQuery, $data) {
//         $matches = [];
 
//         foreach ($data as $key => $value) {
//           if (strpos(strtolower($value['text']), strtolower($searchQuery)) !== false) {
//             $matches[] = $value;
//           }
//         }
//         return $matches;
//     }

// // searching through php, don't use as this will crash with large data
// function getWebsites($dbh) {
//     $sth = $dbh->prepare("SELECT * FROM websites");
// 	$sth->execute();
// 	$result = $sth->fetchAll();

// 	return $result;
// }

// // searching through sql rather than php
// function searchWebsites($dbh, $searchQuery) {
// 	// prepares the statement that will be executed
//     	$sth = $dbh->prepare("SELECT * FROM websites WHERE text LIKE :search ");

//     // binds the '$searchQuery' in the SQL statement
//     	$sth->bindValue(':search', '%' . $searchQuery . '%', PDO::PARAM_STR);

//     // executes the statement
// 		$sth->execute();

// 	$result = $sth->fetchAll();
// 	return $result;
// }


// // make function to get all data from feedback form into database
// function saveFeedback($dbh, $name, $email, $feedback) {
// 	// prepares the statement that will be executed
// 	 $sth = $dbh->prepare("INSERT INTO feedback (name, email, feedback, created_at) VALUES (:name, :email, :feedback, NOW())");

// 	 // binds all the values together
// 	 $sth->bindParam(':name', $name, PDO::PARAM_STR);
// 	 $sth->bindParam(':email', $email, PDO::PARAM_STR);
// 	 $sth->bindParam(':feedback', $feedback, PDO::PARAM_STR);

// 	 // executes the statement
// 	 $success = $sth->execute();
// 	 return $success;
// }