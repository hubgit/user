<html>
<head>
  <title><?php
    if ($title)
      print filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS) . ' | '; 
    print filter_var($config['site']['name'], FILTER_SANITIZE_SPECIAL_CHARS);
  ?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
  <ul id="navigation">
    <li><?php print l($config['site']['root'], $config['site']['name']); ?>
    <?php if ($_SESSION['uid']): ?>
      <li><?php print l('profile.php', $user->name); ?></li>
      <li><?php print l('logout.php', 'Sign out'); ?></li>
    <?php endif; ?>
  </ul>
  
  <?php if (!empty($_SESSION['messages'])): ?>
  <ul id="messages">
    <?php foreach ($_SESSION['messages'] as $key => $message): ?>
       <li class="message"><?php print $message; unset($_SESSION['messages'][$key]); ?></li>
    <?php endforeach; ?>
  </ul>
 <?php endif; ?>
 
 <?php include $body_template; ?>
</body>
</html>