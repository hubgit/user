<?php

require 'includes/functions.inc.php';

if ($_SESSION['uid'])
  $user = user_load($_SESSION['uid']);
else
  goto('login.php');

include 'html/header.html';
?>

<dl>
 <dt><?php print $user->id; ?></dt>
 <dd><?php print $user->name; ?></dd>
</dl>
 
