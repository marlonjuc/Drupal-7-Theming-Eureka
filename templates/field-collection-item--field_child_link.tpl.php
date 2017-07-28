
<?php
	$target = "_self";
	if($content['field_open_in_new_window']){
		$target = "_blank";
	} 
?>
<li>
	<a href="<?php print render($content['field_link']); ?>" title="<?php print render($content['field_cl_title']); ?>" target="<?php print $target;?>">
		<?php print render($content['field_child_image']); ?>
		<span><?php print render($content['field_cl_title']); ?></span>
	</a>
</li>