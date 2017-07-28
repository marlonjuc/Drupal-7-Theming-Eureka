<?php
/**
 * @file
 * Template for comparison page.
 * variables:
 * $field_title
 * $product_values
 *
 */

?>

<div class="row compare_s">
    <div class="col-xs-12">
        <p class="compare_row-title"><?php print $field_title; ?></p>
    </div>

    <!-- <div class="row"> -->
        <div class="col-xs-12 compare_pair">
            <div class="row">
                <?php foreach ($product_values as $html) : ?>
                  <?php if (isset($html)) : ?>
                    <div class="item-different">
                        <p><?php print $html; ?></p>
                    </div>
                    <?php else: ?>
                  <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <!-- </div> -->

</div>
<p>	<span class="compare_row-divider"></span></p>