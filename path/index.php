<?php

if ($_SESSION['uid']){
  $user = user_load($_SESSION['uid']);
  messages('Hello ' . $user->name);
}
