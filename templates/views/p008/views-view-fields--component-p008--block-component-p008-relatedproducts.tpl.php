<?php
/**
 * Prints firt related product
 */
$html_atc = $fields['add_to_cart_form']->content;
$html_atc = str_replace('button secondary wg plus circle-button cart circle-only-mobile', 'button circle-button arrow', $html_atc)
?>

<div class="image-thumb"> <?php print $fields['field_image']->content; ?> </div>
<div class="label-header"> <?php print $fields['field_description_short']->content; ?> </div>
<div class="title"> <?php print $fields['title']->content; ?> </div>
<div class="price"> <?php print $fields['commerce_price']->content; ?> </div>
<div class="rating-stars">3.5</div>
<div class="date"> <?php print $fields['field_new_product']->content; ?> </div>
<div class="add-cart-btn"> <?php print $html_atc; ?> </div>
