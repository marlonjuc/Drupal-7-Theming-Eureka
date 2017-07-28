<?php
/**
 * @file
 * Template of the header of each colon for comparison table.
 */
$product_wrapper = entity_metadata_wrapper('commerce_product', $commerce_product->product_id);
$amount = $product_wrapper->commerce_price->amount->value();
$currency_code = $product_wrapper->commerce_price->currency_code->value();
$images = $product_wrapper->field_image->value();
$image = (!isset($images['uri'])) ? array_shift($images) : $images;
$image_html = theme('image_style', array(
  'style_name' => 'compare_header',
  'path' => $image['uri'],
  'attributes' => array('class' => 'compare_product_image_item'))
);

?>
<div class="col-xs-6 col-sm-4 col-md-3 item">
    <div class="compare_product-item thumbnail product-tile compare-page">
        <?php print $delete_link; ?>
        <div class="content-tile">
            <div class="image-thumb"> <?php print $image_html; ?> </div>
            <div class="title"> <?php print $commerce_product_title; ?> </div>
            <div class="price"><?php print commerce_currency_format($amount, $currency_code); ?></div>
            <div class="rating-stars">3.5 </div> <!-- TODO: it must use moe rating module-->
            <div class="add-cart-btn">
                <?php
                    $add_to_cart_form['#attributes'] = array('class' => 'pdp-button pdp-button-white');
                    print drupal_render($add_to_cart_form);
                ?>
            </div>
        </div>
    </div>
</div>
