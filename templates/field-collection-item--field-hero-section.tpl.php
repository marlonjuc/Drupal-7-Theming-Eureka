<div class="carousel-item-content">
	<div class="background">
		<?php if (isset($content) && isset($content['field_background_image'])) { print render($content['field_background_image']); } ?>
	</div>
	<?php if (isset($content) && isset($content['field_video'])) { print render($content['field_video']); }?>
	<div class="hero-content">
		<?php if (isset($content) && isset($content['field_title'])) { ?>
		<div class="hero-title">
			<?php print render($content['field_title']);?>
		</div>
		<?php  } ?>
		<?php if (isset($content) && isset($content['field_body_copy'])) { ?>
		<div class="hero-copy">
			<?php print render($content['field_body_copy']); ?>
		</div>
		<?php  } ?>
		<?php if (isset($content) && isset($content['field_cta'])) { ?>
		<div class="hero-cta">
			<?php unset($content['field_cta']['#prefix']); ?>
			<?php unset($content['field_cta']['#suffix']); ?>
			<?php print render($content['field_cta']); ?>
		</div>
		<?php  } ?>
	</div>
</div>