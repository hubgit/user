<?php
require 'includes/functions.inc.php';

if ($_SESSION['uid'])
  goto('index.php');
  
$name = array_key_exists('name', $_POST) ? trim($_POST['name']) : NULL;

if ($name && array_key_exists('password', $_POST))
  user_register($name, $_POST['password']);
  
if ($_SESSION['uid'])
  goto('index.php', 'Registered new user: ' . filter_var($name, FILTER_SANITIZE_ENCODED));
?>

<?php
$title = 'Register a new account';
include 'html/header.php';
?>

<form id="register" action="" method="POST">
  <input type="text" name="name" id="register-name" value="<?php if (array_key_exists('name', $_REQUEST)) print filter_var($_REQUEST['name'], FILTER_SANITIZE_SPECIAL_CHARS); ?>">
  <label for="register-name">Username</label><br>  
  <input type="password" name="password" id="register-password">
  <label for="register-password">Password</label><br>
  <!--<input type="text" name="email" id="register-email" value="<?php if (array_key_exists('email', $_REQUEST)) print filter_var($_REQUEST['email'], FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
  <label for="register-email">Email address</label><br>-->
  <input type="submit" value="Register">
</form>

<ul id="links">
  <li>If you already have an account, <?php print l('login.php', 'sign in', $link_vars); ?> instead.</li>
  <li>Forgot your password? <?php print l('reset.php', 'Reset it',  $link_vars); ?> now.</li>
</ul>
