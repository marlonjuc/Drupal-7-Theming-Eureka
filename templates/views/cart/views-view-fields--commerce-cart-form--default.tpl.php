<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 *
 * line_item_title
 * commerce_unit_price
 * edit_quantity
 * edit_delete
 * commerce_total
 * field_image
 *
 *
 *
 */
?>
<?php foreach ($fields as $id => $field): //d($id);?>

<?php endforeach; ?>

<div class="cart-product-tile">
    <div class="ship-image-container col-lg-2 col-md-2 col-xs-6">
        <div class="product-image-thumb"><?php print $fields['field_image']->content; ?> </div>
    </div>

    <div class="ship-details col-md-10 col-xs-6">
        <div class="product-title col-xs-12 col-md-6 col-sm-3"><?php print $fields['line_item_title']->content; ?></div>
        <div class="product-offer-price col-xs-12 col-md-2 col-sm-3 visible-md visible-lg visible-sm"><?php print $fields['commerce_unit_price']->content; ?></div>
        <div class="dropdown-quantity col-xs-12 col-md-2 col-sm-3 visible-md visible-lg visible-sm">
            <?php print $fields['edit_quantity']->content; ?>
        </div>
        <div class="ship-total col-xs-12 col-md-2 col-sm-3 visible-md visible-lg visible-sm"><?php print $fields['commerce_total']->content; ?></div>
        <div class="dropdown-shipping col-xs-12">
            <select name="select-custom">
                <option value="">Shipping</option>
                <option value="Free">Standard</option>
                <option value="$20,00">Express</option>
                <option value="$40,00">Expedited</option>
           </select>
        </div>
        <div class="product-status col-xs-12">Low Stock </div>
        <div class="ship-product-prices col-xs-12 col-md-3">
            <span class="hidden-md hidden-lg hidden-sm">Price :</span>
            <div class="product-commerce-price desactive hidden-md hidden-lg hidden-sm"><?php print $fields['commerce_unit_price']->content; ?></div>
            <div class="product-offer-price hidden-md hidden-lg hidden-sm"><?php print $fields['commerce_unit_price']->content; ?></div>
            <div class="dropdown-quantity col-xs-12 col-md-3 visible-xs">
                <span>Qty: </span>
                <?php print $fields['edit_quantity']->content; ?>
                <div class="button-change hidden-md hidden-lg"><a href="#" class="change">Change</a></div>
               <span class="visible-xs visible-sm hidden-md">Total:&nbsp;</span>
               <div class="ship-total visible-xs visible-sm hidden-md"><?php print $fields['commerce_total']->content; ?></div>
           </div>
            <div class="product-style col-xs-12">Style: 1234<?php print isset($fields['field_product_style']) ? $fields['field_product_style']->content : NULL; ?></div>
            <div class="product-color col-xs-12">Color: Green</div>
            <div class="button-remove col-xs-12"><?php print $fields['edit_delete']->content; ?></div>
        </div>
        <?php
            /*print $fields['field_product_size']->content;*/
        ?>

        <div class="ship-total col-xs-12 col-md-3 visible-xs visible-sm hidden-xs ship-total-lg"><?php print $fields['commerce_total']->content; ?></div>
    </div>
</div>
