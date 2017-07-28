
<?php print render($content['field_gn_link']); ?>
<?php if (!empty($content['field_child_link'])) { ?>
	<ul class="johnson-family-list">
		<?php
			unset($content['field_child_link']['#prefix']);
			unset($content['field_child_link']['#suffix']);
			print render($content['field_child_link']);
		?>
	</ul>
<?php } ?>