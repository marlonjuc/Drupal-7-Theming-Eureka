<?php

/**
 * @file
 * Add to cart message template file.
 *
 */

$image = (!isset($product_image[LANGUAGE_NONE][0]['uri'])) ? array_shift($product_image) : $product_image;
$image_html = theme('image_style', array(
  'style_name' => 'compare_header',
  'path' => $image[LANGUAGE_NONE][0]['uri'],
  'attributes' => array('class' => 'add_to_cart_image_item'))
);

?>
<div class="add-to-cart-overlay" id="add-to-cart-overlay">
  <div class="add-cart-message-wrapper">
    <div class="row">
      <div class="col-xs-12 wrapper-close">
        <a class="add-to-cart-close" data-dismiss="add-cart-message">
                <?php print t('X'); ?>
        </a>
      </div>
    </div>
    <div class="row add-cart-container">
      <div class="col-sm-6 product_detail">
              <h4 class="headline"><?php print $configuration['success_message']; ?></h4>
                <?php print $image_html; ?>
              <p><?php print $product_name; ?></p>
              <?php if (!empty($product_field_product_size)) : ?>
              <p>Size: <?php print $product_field_product_size[LANGUAGE_NONE][0]['safe_value']; ?>
              <?php endif; ?>
              QTY: 1 @ <?php print $product_per_unit_price; ?></p>
              <a href="#" class="button secondary">View cart</a>
      </div>

      <div class="col-sm-6">
                <h4 class="headline"><?php print t('Subtotal'); ?>: <span><?php print $product_price_total; ?></span></h4>
                <h6 class="sub_headline"><span><?php print $product_quantity; ?> <?php print t('items'); ?></span> <?php print t('in shopping cart'); ?></h6>
                <?php print $checkout_link; ?>
                <!-- p class="text-uppercase"><?php print t('or'); ?></p -->
                <?php 
                //removing paypal button from here as it should appear only on step 2 of the checkout
                //print $paypal_link; ?>


                <?php if ($product_price_total >= (FLOAT) str_replace($product_currency['code'],'',$product_price_total)) : ?>
                 <h4 class="sub_headline qualified"><?php print t("You've qualified"); ?></h4>
                  <p><?php print t("Free Shipping on all orders over $99"); ?></p>
                <?php endif; ?>

      </div>
    </div>

  </div>
</div>
