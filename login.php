<?php
require 'includes/functions.inc.php';

if ($_SESSION['uid'])
  goto('index.php');

if (array_key_exists('name', $_POST) && array_key_exists('pass', $_POST))
  user_login($_POST['name'], $_POST['pass']);

if ($_SESSION['uid'])
  goto('index.php');

if (array_key_exists('name', $_POST))
  messages('Unknown username or password<br>' . l('register.php', 'Register',  array('name' => filter_var($_POST['name']))));
?>

<?php include 'html/header.html'; ?>

<form id="login" action="" method="POST">
  <input type="text" name="name" id="login-name" value="<?php if (array_key_exists('name', $_REQUEST)) print filter_var($_REQUEST['name']); ?>">
  <label for="login-name">Email address</label><br>
  <input type="password" name="pass" id="login-pass">
  <label for="login-pass">Password</label><br>
  <input type="submit" value="Sign in">
</form>
