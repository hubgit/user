<?php
require 'includes/functions.inc.php';

if ($_SESSION['uid'])
  goto('index.php');

if (array_key_exists('name', $_POST)) // TODO: form key?
  user_send_password_reset($_POST['name']);

if (array_key_exists('token', $_GET)) // TODO: form key?
  user_reset_password($_GET['token']);
  
if ($_SESSION['uid'])
  goto('edit.php');
?>

<?php include 'html/header.html'; ?>

<form id="reset" action="" method="POST">
  <input type="text" name="name" id="reset-name" value="<?php print filter_var(array_key_exists('name', $_GET) ? $_GET['name'] : NULL, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
  <label for="reset-name">Email address</label><br>
  <input type="submit" value="Reset your password">
</form>
