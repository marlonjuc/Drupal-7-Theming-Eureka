<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div class="row">
    <div class="col-xs-12">
        <?php if (!empty($title)): ?>
        <h2><?php print $title; ?></h2>
        <?php endif; ?>
        <h2>Accessories</h2>
        <div class="accessories">
            <div class="row">
                <ul class="slides">
                    <?php foreach ($rows as $id => $row): ?>
                    <li class="col-xs-12">
                        <div class="product-tile">
                            <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
                                <?php print $row; ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="gradient-right"></div>
    </div>
</div>
