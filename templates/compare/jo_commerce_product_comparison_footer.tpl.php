<?php
/**
 * @file
 * Template of the footer the grid.
 */

?>

<div class="col-xs-6 col-sm-4 col-md-3">
    <p class="compare_add-title"><?php print $commerce_product_title;?></p>
    <p class="compare_add-cta">
      <?php print drupal_render($add_to_cart_form); ?>
    </p>
    
</div>
