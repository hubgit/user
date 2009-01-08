<?php

if ($_SESSION['uid'])
  goto('index');
  
$name = array_key_exists('name', $_POST) ? trim($_POST['name']) : NULL;

if ($name && array_key_exists('password', $_POST))
  user_register($name, $_POST['password']);
  
if ($_SESSION['uid'])
  goto('edit', sprintf(
    '<p>Welcome <b>%s</b></p>
    <p>Edit your profile here if you like (an email address would be nice).</p>
    <p>Otherwise, <a href="%s">continue to the front page</a>.</p>', filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS), $config['site']['root']));

$title = 'Register a new account';

