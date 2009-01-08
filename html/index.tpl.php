<ul id="links">
  <?php if ($_SESSION['uid']): ?>
  <?php else: ?>
    <li>If you already have an account, <?php print l('login', 'sign in', $link_vars); ?>.</li>
    <li>If not, <?php print l('register', 'register', $link_vars); ?> first.</li>
  <?php endif; ?>
</ul>

<div id="facebook-connect">
  <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
  
  <script type="text/javascript">
    var facebook = {
      connected: function(){
         alert("Connected"); 
      } 
    }

    FB.init("<?php print $config['facebook']['api-key']; ?>", "facebook-crossdomain.xml");
    FB.Connect.ifUserConnected(facebook.connected);    
  </script>
</div>