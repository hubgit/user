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
print_r($_SESSION);

if (!empty($_POST) && !validate_form_token())
  exit('Invalid form token');

$link_vars = array(
  'name' => $_REQUEST['name'],
  'email' => $_REQUEST['email']
);
