<?php

if (array_key_exists('token', $_GET))
  user_confirm_email($_GET['token']);

if (!$_SESSION['uid'])
  goto('login');

$user = user_load($_SESSION['uid']);

foreach (array('password', 'name', 'email', 'facebook') as $key)
  if (array_key_exists($key, $_POST) && $_POST[$key] && $_POST[$key] != $user->{$key})
    user_set_profile($_SESSION['uid'], $key, $_POST[$key]);

$user = user_load($_SESSION['uid'], NULL, NULL, FALSE); // load fresh

$title = 'Edit your profile';
