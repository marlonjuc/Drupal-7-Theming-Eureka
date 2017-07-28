<?php
/**
 * @file
 * Template of the header of each colon for comparison table.
 *
 * variables:
 * $delta
 * $add_another_item
 *
 */
$variables = array(
      'path' => drupal_get_path('theme',$GLOBALS['theme']).'/assets/img/icon-close.png',
      'alt' => 'Close',
      'title' => 'Close',
      'width' => '100%',
      'height' => '100%',
      'attributes' => array('class' => 'compare_delete-item'),
      );
  $img_close = theme('image', $variables);

?>
<div class="col-sm-4 col-md-3 item item-hide">
  <div class="compare_product-item thumbnail product-tile compare-page not-set">
    <div class="content-tile">
      <p class="compare_product-title"><?php print $delta; ?></p>
      <p class="compare_product-description"><?php print t('Compare another'); ?><br><?php print t('product'); ?></p>
      <div class="add-cart-btn">
        <?php print l(t('Add products'), $add_another_item, array('attributes' => array('class' => array('button secondary wg plus')))); ?>
      </div>
    </div>
  </div>
</div>