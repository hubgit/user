<?php
require 'includes/functions.inc.php';

if ($_SESSION['uid'])
  goto('index.php');
  
$name = array_key_exists('name', $_POST) ? $_POST['name'] : NULL;

if ($name && array_key_exists('pass', $_POST))
  user_login($name, $_POST['pass']);

if ($_SESSION['uid'])
  goto('index.php');

if ($name)
  messages('Unknown username or password');
?>

<?php include 'html/header.html'; ?>

<div class="link"><?php print l('register.php', 'Register',  array('name' => $name)); ?></a>

<form id="login" action="" method="POST">
  <input type="text" name="name" id="login-name" value="<?php if (array_key_exists('name', $_REQUEST)) print filter_var($_REQUEST['name'], FILTER_SANITIZE_SPECIAL_CHARS); ?>">
  <label for="login-name">Email address</label><br>
  <input type="password" name="pass" id="login-pass">
  <label for="login-pass">Password</label><br>
  <input type="submit" value="Sign in">
</form>
