<?php

function messages($message){
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
  return sprintf('<a href="%s">%s</a>', filter_var(filter_var($url, FILTER_SANITIZE_URL), FILTER_SANITIZE_SPECIAL_CHARS), filter_var($title, FILTER_SANITIZE_STRING));
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
  $debug = 1;
  if ($debug){
    print_r($item);
    print "<br/>\n";
  }
}

function generate_token($length = 16){
  $urandom = fopen('/dev/urandom', 'rb');
  $result = md5(fread($urandom, $length));
  fclose($urandom);
  return $result;
}

function validate_form_token(){
  if ($_REQUEST['form-token'] != $_SESSION['form-token'])
    exit('Invalid form token');
  return TRUE;
}

