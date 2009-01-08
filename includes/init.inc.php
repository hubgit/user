<?php

define(MAIN_PATH, realpath(__DIR__) . DIRECTORY_SEPARATOR . '..');

require 'includes/config.inc.php';
require 'includes/functions.inc.php';
require 'includes/user.inc.php';

mysql_connect($config['db']['server'], $config['db']['user'], $config['db']['password']) or die('Could not connect to MySQL server'); // SERVER, DB USERNAME, DB PASSWORD
mysql_select_db($config['db']['db']); // DATABASE
mysql_query('SET NAMES utf8');

session_name('session');
session_start();

if (!isset($_SESSION['form-token'])) { 
  session_regenerate_id(); 
  $_SESSION['form-token'] = generate_token(); 
}

if (!empty($_POST))
  validate_form_token();
