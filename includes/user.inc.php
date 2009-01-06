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
