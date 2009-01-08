<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">

<head>
  <title><?php
    if ($title)
      print filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS) . ' | '; 
    print filter_var($config['site']['name'], FILTER_SANITIZE_SPECIAL_CHARS);
  ?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <link rel="stylesheet" href="css/style.css"/>
  <script src="js/jquery.js"></script>
  <script src="js/script.js"></script>
</head>

<body>
  <ul id="navigation">
    <li><?php print l($config['site']['root'], $config['site']['name']); ?>
    <?php if ($_SESSION['uid']): ?>
      <li><?php print l('profile', $user->name); ?></li>
      <li><?php print l('logout', 'Sign out'); ?></li>
    <?php endif; ?>
  </ul>
  
  <?php if (!empty($_SESSION['messages'])): ?>
  <ul id="messages">
    <?php foreach ($_SESSION['messages'] as $key => $message): ?>
       <li class="message"><?php print $message; unset($_SESSION['messages'][$key]); ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
  
  <?php if ($title): ?>
    <h1><?php print filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS); ?></h1>
  <?php endif; ?>
 
 <?php include $template; ?>
</body>

</html>