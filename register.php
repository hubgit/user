<?php
require 'includes/functions.inc.php';

$name = array_key_exists('name', $_POST) ? $_POST['name'] : NULL;

if ($name && array_key_exists('pass', $_POST))
  user_register($name, $_POST['pass']);
  
if ($_SESSION['uid'])
  goto('index.php', 'Registered new user: ' . filter_var($name));
?>

<?php include 'html/header.html'; ?>

<div class="link"><?php print l('login.php', 'Sign in',  array('name' => filter_var($name))); ?></a>

<form id="register" action="" method="POST">
  <input type="text" name="name" id="register-name" value="<?php if (array_key_exists('name', $_REQUEST)) print filter_var($_REQUEST['name']); ?>"> 
  <label for="register-name">Email address</label><br>
  <input type="password" name="pass" id="register-pass"> 
  <label for="register-pass">Password</label><br>
  <input type="submit" value="Register">
</form>
