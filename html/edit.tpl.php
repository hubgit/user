<form id="edit" action="" method="POST">
  <div class="profile">
    <input type="text" name="name" id="edit-name" value="<?php print filter_var($user->name, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
    <label for="edit-name">Username</label><br>
    <input type="password" name="password" id="edit-password"> 
    <label for="edit-password">New password</label><br>
  </div>
  
  <div class="profile">
    <input type="text" name="email" id="edit-email" value="<?php print filter_var($user->email, FILTER_SANITIZE_SPECIAL_CHARS); ?>"> 
    <label for="edit-email">Email address</label><br>
  </div>
  
  <input type="hidden" name="form-token" value="<?php print $_SESSION['form-token']; ?>">
  <input type="submit" value="Save">
</form>