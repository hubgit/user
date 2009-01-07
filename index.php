<?php

require 'includes/functions.inc.php';

if ($_SESSION['uid']){
  $user = user_load($_SESSION['uid']);
  messages('Welcome ' + $user->name); // TODO: screen name
}
?>

<?php include 'html/header.html'; ?>
  
<dl>
 <dt><?php print $user->id; ?></dt>
 <dd><?php print $user->name; ?></dd>
</dl>

<ul id="links">
  <?php if ($_SESSION['uid']): ?>
    <li><?php print l('edit.php', 'Edit your profile'); ?></li>
    <li><?php print l('logout.php', 'Sign out'); ?></li>
  <?php else: ?>
    <li>If you already have an account, <?php print l('login.php', 'sign in', array('name' => $name)); ?>.</li>
    <li>If not, <?php print l('register.php', 'register',  array('name' => $name)); ?> first.</li>
  <?php endif; ?>
</ul>