<?php
require 'includes/main.inc.php';

if ($_SESSION['uid'])
  goto('index.php');
  
$name = array_key_exists('name', $_POST) ? trim($_POST['name']) : NULL;

if ($name && array_key_exists('password', $_POST))
  user_register($name, $_POST['password']);
  
if ($_SESSION['uid'])
  goto('edit.php', sprintf('<p>Welcome <b>%s</b></p><p>Edit your profile here if you like.</p>', filter_var($name, FILTER_SANITIZE_ENCODED)));

$title = 'Register a new account';
include 'includes/output.inc.php'; 



