<dl>
  <?php foreach ($items as $dt => $dd): ?>
    <dt><?php print $dt; ?></dt><dd><?php print $dd; ?></dd>
  <?php endforeach; ?>
</dl>

<ul id="links">
  <?php if ($profile->id == $user->id): ?>
    <li><?php print l('edit', 'Edit your profile'); ?></li>
  <?php endif; ?>
</ul>