<?php

require 'includes/config.inc.php';
require 'includes/user.inc.php';

mysql_connect('localhost', $config['db']['user'], $config['db']['pass']) or die('Could not connect to MySQL server'); // SERVER, DB USERNAME, DB PASSWORD
mysql_select_db('test_users'); // DATABASE
mysql_query('SET NAMES utf8');

function messages($message = NULL){
  if ($message)
    $_SESSION['messages'][] = $message;
}

function goto($url, $message = NULL){
  if ($message)
    messages($message);
    
  header('Location: ' . $url);
  exit(); 
}

function l($url, $title, $params = array()){
  if (!empty($params))
    $url .= '?' . http_build_query($params);
  return sprintf('<a href="%s">%s</a>', filter_var($url), filter_var($title));
}

function db_query(){
  $params = func_get_args();
  $query = array_shift($params);

  foreach ($params as $key => $value)
    if (!is_int($value))
      $params[$key] = mysql_real_escape_string($value);
  
  $sql = vsprintf($query, $params); 
  debug($sql);
  
  $result = mysql_query($sql);
  if (mysql_errno())
    exit(debug(sprintf('MySQL error %d: %s', mysql_errno(), mysql_error())));
    
  return $result;
}

function debug($item){
  $debug = 0;
  if ($debug){
    print_r($item);
    print "<br/>\n";
  }
}

