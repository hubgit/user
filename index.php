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

<div id="links">
  <?php if ($_SESSION['uid']): ?>
    <p><?php print l('logout.php', 'Sign out'); ?></p>
  <?php else: ?>
    <p>If you already have an account, <?php print l('login.php', 'sign in', array('name' => $name)); ?>.</p>
    <p>If not, <?php print l('register.php', 'register',  array('name' => $name)); ?> first.</p>
  <?php endif; ?>
</div>