<?php
require 'includes/config.php';
// destroy the session and redirect
session_destroy();
session_start();
addMessage('success', "You have been logged out");
redirect('index.php');