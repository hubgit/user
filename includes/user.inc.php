<?php

require 'libs/PasswordHash.php';

session_name('example');
session_start();

function user_load($id = NULL, $name = NULL, $email = NULL, $cached = TRUE){
  static $users;
  if (!isset($users))
    $users = array();
    
  if ($id){      
    if ($cached && array_key_exists($id, $users))
      return $users[$id];
    $result = db_query("SELECT * FROM users WHERE id = %d", $id);
  }
  else if ($name)
    $result = db_query("SELECT * FROM users WHERE name = '%s'", $name);
  else if ($email)
    $result = db_query("SELECT * FROM users WHERE email = '%s'", $email);
  else
    return false;
      
  if (mysql_num_rows($result)){
    $user = mysql_fetch_object($result);
    $users[$user->id] = $user;
    return $user;
  }
}

function user_insert($name, $password){ 
  $hasher = new PasswordHash(8, FALSE); 
  $result = db_query("INSERT INTO users (name, password) VALUES ('%s', '%s')", $name, $hasher->HashPassword($password));
  if ($result)
    return mysql_insert_id();
}

function user_register($name, $password){
  if (user_load(NULL, $name))
    messages('This username has already been taken, please choose another.');
  else
    $id = user_insert($name, $password);
  
  if ($id)
    $_SESSION['uid'] = $id;
}

function user_login($name, $password){
  $user = user_load(NULL, $name);
  if (!$user) return false;
  
  $hasher = new PasswordHash(8, FALSE);
  if ($hasher->CheckPassword($password, $user->password))
    $_SESSION['uid'] = $user->id;
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
  $user = user_load(NULL, $name); // name
  if (!$user)
    $user = user_load(NULL, NULL, $name); // email
  if (!$user || !$user->email){
    messages('Unknown username or email address');
    return;
  }
  
  $urandom = fopen('/dev/urandom', 'rb');
  $password = md5(fread($urandom, 16));
  
  do {
    $token = md5(fread($urandom, 16)); // TODO: check uniqueness
    $result = db_query("SELECT * FROM users WHERE token = '%s'", $token);
  } while (mysql_num_rows($result));
  
  fclose($urandom);
  
  $headers = sprintf("From: %s\r\n", 'test@example.com');
  mail($user->email, 'New password', sprintf("Password: %s\nConfirmation link: %s\n", $password, 'http://example.com/reset.php?token=' . urlencode($token)), $headers);
  
  $result = db_query("UPDATE users SET password_tmp = '%s', token = '%s' WHERE id = %d", $password, $token, $user->id);
  goto('index.php', 'Password sent by email'); 
}

function user_reset_password($token){
  $result = db_query("SELECT id FROM users WHERE token = '%s' AND password_tmp IS NOT NULL", $token);
  if (mysql_num_rows($result))
    $id = mysql_result($result, 0);
  else 
    goto('reset.php', 'Invalid token');
    
  $result = db_query("UPDATE users SET password = password_tmp, password_tmp = NULL, token = NULL WHERE id = %d", $id);
  $_SESSION['uid'] = $id;
  goto('edit.php', 'Your new password is now active and you are signed in. You may edit your password here if you like.'); 
}

function user_validate_name($id, $name){
  // TODO: check unique
  return $name;
}

function user_validate_password($id, $password){
  $user = user_load($id);
  
  $hasher = new PasswordHash(8, FALSE);
  if ($hasher->CheckPassword($password, $user->password))
    return false; // password unchanged
  else
   return $hasher->HashPassword($password);
}

function user_validate_email($id, $email){
  // TODO: check unique
  return $email;
}

function user_set_profile($id, $key, $value){
  if (function_exists("user_validate_$key"))
    $value = call_user_func_array("user_validate_$key", array($id, $value));
  
  if (!$value)
    return;

  db_query("UPDATE users SET `%s` = '%s' WHERE id = %d", $key, $value, $id);
  if (mysql_affected_rows())
    messages("$key updated.");
}
