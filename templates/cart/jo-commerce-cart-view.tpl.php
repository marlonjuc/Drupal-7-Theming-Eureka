<?php

/**
 * @file
 * Add to cart message template file.
 *
 */
?>
<div class="section-full-width">
    <div class="section-padding">

        <div class="add-to-cart row" id="add-to-cart-view">

            <div class="add-to-cart--cart-form col-md-8">
                
                <?php print $cart_form; ?>
            </div>
            <div class="add-to-cart--right col-md-4">
                <div class="add-to-cart--summary">
                    <?php print $summary; ?>
                </div>
                <div class="free-shipping-block">
                    <?php if (TRUE) : ?>
                      <h4 class="sub_headline qualified"><?php print t("You've qualified"); ?></h4>
                      <p><?php print t("Free Shipping on all orders over $99"); ?></p>
                    <?php endif; ?>
                </div>
                <div class="add-to-cart--blocks row">
                    <?php print render($help_block['content']); ?>
                </div>
            </div>
        </div>

    </div>
</div>
