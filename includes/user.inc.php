<?php

require 'libs/PasswordHash.php';

session_name('example');
session_start();

function user_load($id = NULL, $name = NULL){
  static $users;
  if (!isset($users))
    $users = array();
    
  if ($id){
    if (array_key_exists($id, $users))
      return $users[$id];
    $result = db_query("SELECT id, name FROM users WHERE id = %d", $id);
  }
  else if ($name)
    $result = db_query("SELECT id, name FROM users WHERE name = '%s'", $name);
  else
    return false;
      
  if (mysql_num_rows($result)){
    $user = mysql_fetch_object($result);
    $users[$user->id] = $user;
    return $user;
  }
}

function user_insert($name, $pass){ 
  $hasher = new PasswordHash(8, FALSE); 
  $result = db_query("INSERT INTO users (name, pass) VALUES ('%s', '%s')", $name, $hasher->HashPassword($pass));
  if ($result)
    return mysql_insert_id();
}

function user_register($name, $pass){
  if (user_load(NULL, $name))
    messages('Username already exists.');
  else
    $id = user_insert($name, $pass);
  
  if ($id)
    $_SESSION['uid'] = $id;
}

function user_login($name, $pass){
  $hasher = new PasswordHash(8, FALSE);
  $result = db_query("SELECT id, pass FROM users WHERE name = '%s'", $name);
  if (mysql_num_rows($result)){
    $user = mysql_fetch_object($result);
    if ($hasher->CheckPassword($pass, $user->pass))
      $_SESSION['uid'] = $user->id;
  }
}

function user_logout(){
  if ($_SESSION['uid']){
    $_SESSION = array();
    if (isset($_COOKIE[session_name()]))
       setcookie(session_name(), '', time() - 42000, '/');
    session_destroy();
  }
}

function user_send_password_reset($name){
  $result = db_query("SELECT id, name FROM users WHERE name = '%s'", $name);
  $user = mysql_fetch_object($result);
  
  $urandom = fopen('/dev/urandom', 'rb');
  $password = md5(fread($urandom, 16));
  
  do {
    $token = md5(fread($urandom, 16)); // TODO: check uniqueness
    $result = db_query("SELECT * FROM users WHERE token = '%s'", $token);
  } while (mysql_num_rows($result));
  
  fclose($urandom);
  
  $headers = sprintf("From: %s\r\n", 'test@example.com');
  mail($user->name, 'New password', sprintf("Password: %s\nConfirmation link: %s\n", $password, 'http://example.com/reset.php?token=' . urlencode($token)), $headers);
  
  $result = db_query("UPDATE users SET pass_tmp = '%s', token = '%s' WHERE id = %d", $password, $token, $user->id);
  goto('index.php', 'Password sent by email'); 
}

function user_reset_password($token){
  $result = db_query("SELECT id FROM users WHERE token = '%s' AND pass_tmp IS NOT NULL", $token);
  if (mysql_num_rows($result))
    $id = mysql_result($result, 0);
  else 
    goto('reset.php', 'Invalid token');
    
  $result = db_query("UPDATE users SET pass = pass_tmp, pass_tmp = NULL, token = NULL WHERE id = %d", $id);
  $_SESSION['uid'] = $id;
  goto('edit.php', 'Your new password is now active. You may edit it here if you like.'); 
}
