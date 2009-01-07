<?php

require 'includes/main.inc.php';

if ($_SESSION['uid']){
  $user = user_load($_SESSION['uid']);
  messages('Hello ' . $user->name);
}

include 'includes/output.inc.php'; 
