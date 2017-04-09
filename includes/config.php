<?php
session_start();

require 'includes/functions.php';

$host = 'localhost';
$user = 'root';
$pass = 'root';
$database = 'portfolio';


// variable for connecting database
$dbh = connectDatabase($host, $database, $user, $pass);
$projects = getProjects($dbh);
// die(var_dump($projects));