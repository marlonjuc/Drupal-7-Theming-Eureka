<div class="components">
	<div class="main-page-content">
		<?php 
		unset($content['field_sub_section']['#prefix']);
		unset($content['field_sub_section']['#suffix']);
		print render($content['field_sub_section']);
		?>
		<?php 
		$theme = drupal_get_path('theme', 'eureka');
		$imgPath = $theme.'/assets/img';
		?>
	</div>
</div>