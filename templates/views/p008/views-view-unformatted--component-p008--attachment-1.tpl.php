<?php

/**
 *
 * Wrapper of last 4 related items
 * see> http://dev-acquia.eurekacamping.com/admin/structure/views/view/component_p008/edit/attachment_1
 *
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
