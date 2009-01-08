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
  
  <input type="hidden" name="facebook" id="edit-facebook" value="<?php print filter_var($user->facebook, FILTER_SANITIZE_SPECIAL_CHARS); ?>">
  
  <input type="hidden" name="form-token" value="<?php print $_SESSION['form-token']; ?>">
  <input type="submit" value="Save">
</form>

<?php 
  require_once 'libs/facebook/client/facebook.php';
?>

<div id="facebook-connect">
  <h3>Facebook Connect</h3>
  
  <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>

  <?php if (!$user->facebook): ?>
    <fb:login-button size="large" length="long" onlogin="facebook.attach();"></fb:login-button>
  <?php endif; ?>
  
  <script>
    FB.init("<?php print $config['facebook']['api-key']; ?>", "libs/facebook/connect/crossdomain.html");
  </script>
  
  <?php if ($user->facebook): ?>
    <div class="info">
    </div>
    <script src="js/facebook.js"></script>
    <script>
      FB.Connect.requireSession(facebook.loggedin);
    </script>
  <?php endif; ?>
  
  <!-- TODO: reset link -->
</div>

