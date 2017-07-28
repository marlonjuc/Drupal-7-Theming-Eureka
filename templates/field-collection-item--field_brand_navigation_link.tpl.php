
<?php print render($content['field_bn_main_link']); ?>
<?php if (!empty($content['field_brand_child_link'])) { ?>
<div class="shopcamping-menu">
	<div class="items-menu">
		<ul class="shopcamping-list">
			<?php
				unset($content['field_brand_child_link']['#prefix']);
				unset($content['field_brand_child_link']['#suffix']);
				print render($content['field_brand_child_link']);
			?>
		</ul>
		<div class="nav-separator">
			<span class="arrow"></span>
		</div>
		<div class="base-background-image">
			<?php print render($content['field_base_background_image']); ?>
		</div>
	</div>
</div>
<?php } ?>
