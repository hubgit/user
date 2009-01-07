<?php
require 'includes/functions.inc.php';

if (!$_SESSION['uid'])
  goto('login.php');

$user = user_load($_SESSION['uid']);
  
foreach (array('password', 'name', 'email') as $key)
  if (array_key_exists($key, $_POST) && $_POST[$key] && $_POST[$key] != $user->{$key})
    user_set_profile($_SESSION['uid'], $key, $_POST[$key]);
  
$user = user_load($_SESSION['uid'], NULL, NULL, FALSE); // load fresh
?>

<?php 
$title = 'Edit your profile';
include 'html/header.php'; 
?>

<form id="edit" action="" method="POST">
  <div class="profile">
    <input type="text" name="name" id="edit-name" value="<?php print filter_var($user->name, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
    <label for="edit-name">Username</label><br>
    <input type="password" name="password" id="edit-password"> 
    <label for="edit-password">New password</label><br>
  </div>
  
  <div class="profile">
    <input type="text" name="email" id="edit-email" value="<?php print filter_var($user->email, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
    <label for="edit-email">Email address</label><br>
  </div>
  
  <input type="submit" value="Save">
</form>

<?php include 'html/footer.php'; ?>

