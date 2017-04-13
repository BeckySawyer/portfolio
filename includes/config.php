<?php
session_start();
date_default_timezone_set('Pacific/Auckland');
require 'includes/functions.php';

$host = 'localhost';
$user = 'root';
$pass = 'root';
$database = 'portfolio';


// variable for connecting database
$dbh = connectDatabase($host, $database, $user, $pass);
// die(var_dump($projects));