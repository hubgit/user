<form id="reset" action="" method="POST">
  <input type="text" name="name" id="reset-name" value="<?php print filter_var(array_key_exists('name', $_GET) ? $_GET['name'] : NULL, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
  <label for="reset-name">Username or email address</label><br>
  
  <input type="hidden" name="form-token" value="<?php print $_SESSION['form-token']; ?>">
  <input type="submit" value="Reset your password">
</form>
