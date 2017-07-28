<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
$n007_position = variable_get('jo_plp_tents_n007_position',-2) + 1;
$n007 = node_view(node_load(variable_get('jo_plp_tents_n007_id',0)), 'teaser');
$views_pager = $view->query->pager->current_page;
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
  <?php if ($id == $n007_position && $views_pager == 0): ?>
  <?php print render($n007); ?>
  <?php endif; ?>
  <div<?php if ($classes_array[$id]) { print ' class="col-xs-12 col-sm-6 col-md-3 ' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
