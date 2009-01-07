<?php
require 'includes/main.inc.php';

if ($_SESSION['uid'])
  goto('index.php');

if (array_key_exists('name', $_POST))
  user_send_password_reset(trim($_POST['name']));

if (array_key_exists('token', $_GET))
  user_reset_password($_GET['token']);
  
if ($_SESSION['uid'])
  goto('edit.php');

$title = 'Reset your password';
include 'includes/output.inc.php'; 
