<ul id="links">
  <?php if ($_SESSION['uid']): ?>
  <?php else: ?>
    <li>If you already have an account, <?php print l('login', 'sign in', $link_vars); ?>.</li>
    <li>If not, <?php print l('register', 'register', $link_vars); ?> first.</li>
  <?php endif; ?>
</ul>