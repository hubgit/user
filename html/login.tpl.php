<form id="login" action="" method="POST">
  <input type="text" name="name" id="login-name" value="<?php if (array_key_exists('name', $_REQUEST)) print filter_var($_REQUEST['name'], FILTER_SANITIZE_SPECIAL_CHARS); ?>">
  <label for="login-name">Username</label><br>
  
  <input type="password" name="password" id="login-password">
  <label for="login-password">Password</label><br>
  
  <input type="hidden" name="form-token" value="<?php print $_SESSION['form-token']; ?>">
  <input type="submit" value="Sign in">
</form>

<ul id="links">
  <li>If you haven't already got an account, <?php print l('register', 'register',  $link_vars); ?> first.</li>
  <li>Forgot your password? <?php print l('reset', 'Reset it',  $link_vars); ?> now.</li>
</ul>