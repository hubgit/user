<?php

require 'includes/config.inc.php';
require 'includes/functions.inc.php';
require 'includes/user.inc.php';

mysql_connect('localhost', $config['db']['user'], $config['db']['password']) or die('Could not connect to MySQL server'); // SERVER, DB USERNAME, DB PASSWORD
mysql_select_db('test_users'); // DATABASE
mysql_query('SET NAMES utf8');

session_name('example');
session_start();

if (!isset($_SESSION['real'])) { 
  session_regenerate_id(); 
  $_SESSION['real'] = true; 
}

$link_vars = array(
  'name' => $_REQUEST['name'],
  'email' => $_REQUEST['email']
);
