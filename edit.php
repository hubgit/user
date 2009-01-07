<?php
require 'includes/functions.inc.php';

if (!$_SESSION['uid'])
  goto('login.php');
  
if (array_key_exists('pass', $_POST))
  user_set_password($_SESSION['uid'], $_POST['pass']);
  
if (array_key_exists('name', $_POST))
  user_set_email($_SESSION['uid'], $_POST['name']);
  
$user = user_load($_SESSION['uid']);
?>

<?php include 'html/header.html'; ?>

<form id="edit" action="" method="POST">
  <input type="text" name="name" id="edit-name" value="<?php print filter_var($user->name, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
  <label for="edit-name">Email address</label><br>
  <input type="password" name="pass" id="edit-pass"> 
  <label for="edit-pass">New password</label><br>
  <input type="submit" value="Save">
</form>
