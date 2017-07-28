<?php
/**
 * @file
 * Template file
 * Variables * 
 */

$default_text = t(variable_get('jo_banners_s001_text'));
$hidden_xs_text = t(variable_get('jo_banners_s001_text_hidden_xs'));
$link = t(variable_get('jo_banners_s001_link'));

?>
<div class="component-s001">
	<div class="row promo-banner-wrapper animate">
		<div class="promo-banner">
			<a href="<?php print $link;?>" class="promo-banner-title">
				<h2> <span class="hidden-xs"> <?php print $hidden_xs_text;?></span> <?php print $default_text;?></h2>				
			</a>
		</div>
	</div>
</div>