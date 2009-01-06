<?php
require 'includes/functions.inc.php';

if (!$_SESSION['uid'])
  goto('login.php');
  
$user = user_load($_SESSION['uid']);
?>

<?php include 'html/header.html'; ?>

<form id="edit" action="" method="POST">
  <input type="text" name="name" id="edit-name" value="<?php print filter_var($user->name, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
  <label for="edit-name">Email address</label><br>
  <input type="password" name="pass" id="edit-pass"> 
  <label for="edit-pass">Password</label><br>
  <input type="submit" value="Save">
</form>
