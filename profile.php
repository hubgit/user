<?php
require 'includes/functions.inc.php';

if (!$_SESSION['uid'])
  goto('login.php');
  
$user = user_load($_SESSION['uid']);

$name = array_key_exists('name', $_GET) ? $_GET['name'] : $user->name;

$profile = user_load(NULL, $name);
if (!$profile){
  header('HTTP/1.0 404 Not Found');
  header('Content-Type: text/html');
  print 'User not found'; 
}

$items = array(
  'name' => $profile->name,
  'email' => $profile->email,
  );
?>

<?php 
$title = $profile->name;
include 'html/header.php'; 
?>

<dl>
  <?php foreach ($items as $dt => $dd): ?>
    <dt><?php print $dt; ?></dt><dd><?php print $dd; ?></dd>
  <?php endforeach; ?>
</dl>

<ul id="links">
  <?php if ($profile->id == $user->id): ?>
    <li><?php print l('edit.php', 'Edit your profile'); ?></li>
  <?php endif; ?>
</ul>

<?php include 'html/footer.php'; ?>

