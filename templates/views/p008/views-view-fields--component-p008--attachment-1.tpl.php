<?php

/**
 * Prints last 4 related items
 * see > http://dev-acquia.eurekacamping.com/admin/structure/views/view/component_p008/edit/attachment_1
 *
 */

?>

<div class="image-thumb"> <?php print $fields['field_image']->content; ?> </div>
<div class="header"> <?php print $fields['field_description_short']->content; ?> </div>
<div class="title"> <?php print $fields['title']->content; ?> </div>
<div class="price"> <?php print $fields['commerce_price']->content; ?> </div>
<div class="rating-stars">3.5</div>
<div class="date"> <?php print $fields['field_new_product']->content; ?> </div>
<div class="add-cart-btn"> <?php print $fields['add_to_cart_form']->content; ?> </div>
