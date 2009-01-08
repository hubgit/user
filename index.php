<?php

require 'includes/config.inc.php';
require 'includes/functions.inc.php';
require 'includes/user.inc.php';

mysql_connect('localhost', $config['db']['user'], $config['db']['password']) or die('Could not connect to MySQL server'); // SERVER, DB USERNAME, DB PASSWORD
mysql_select_db('test_users'); // DATABASE
mysql_query('SET NAMES utf8');

session_name('session');
session_start();

if (!isset($_SESSION['form-token'])) { 
  session_regenerate_id(); 
  $_SESSION['form-token'] = generate_token(); 
}

if (!empty($_POST))
  validate_form_token();

$link_vars = array();
foreach (array('name', 'email') as $var)
  if (array_key_exists($var, $_REQUEST))
    $link_vars[$var] = $_REQUEST[$var];

$path = array_values(array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))));

$root = array_filter(explode('/', $config['site']['root']));
array_splice($path, 0, count($root));
array_walk($path, create_function('$text','return preg_replace("[^a-z]", "", $text);'));

if (empty($path))
  $path[] = 'index';
    
$file = sprintf('path/%s.php', $path[0]);
if (!file_exists($file))
  goto('index');

require $file;

require 'includes/output.inc.php'; 
