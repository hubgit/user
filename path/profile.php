<?php

if (!$_SESSION['uid'])
  goto('login');
  
$user = user_load($_SESSION['uid']);

$name = array_key_exists('name', $_GET) ? $_GET['name'] : $user->name;

$profile = user_load(NULL, $name);
if (!$profile){
  header('HTTP/1.0 404 Not Found');
  header('Content-Type: text/html');
  print 'User not found'; 
}

$items = array(
  'name' => $profile->name,
  'email' => $profile->email,
  );
 
$title = $profile->name;
