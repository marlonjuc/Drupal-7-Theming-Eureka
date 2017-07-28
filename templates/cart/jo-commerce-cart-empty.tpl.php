<?php

/**
 * @file
 * Add to cart message template file.
 *
 */
?>
<div class="empty-cart row section-full-width">
	<div class="section-padding">
		<div class="empty-cart-content row">
			<div class="col-md-8">
				<a href="/tents" class="back-link"><span class="icon icon-back-arrow-icon"></span> CONTINUE SHOPPING</a>
				<h2 class="title">YOUR CART (0)</h2>
				<div class="description">
					<h3 class="sub-title">YOUR CART IS EMPTY</h3>
					<p class="text">Funny thing is, we have bunch of tents that are, too!</p>
					<a href="/tents" class="button secondary cta">SHOP ALL TENTS</a>
				</div>
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
