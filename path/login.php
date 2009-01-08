<?php

if ($_SESSION['uid'])
  goto('index.php');
  
$name = array_key_exists('name', $_POST) ? trim($_POST['name']) : NULL;

if ($name && array_key_exists('password', $_POST))
  user_login($name, $_POST['password']);

if ($_SESSION['uid'])
  goto('index.php');

if ($name)
  messages('Unknown username or password');

$title = 'Sign in';
