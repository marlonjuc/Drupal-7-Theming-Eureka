<?php foreach ($items as $delta => $item): ?>
	<?php if (!empty($item['#element']['url'])){ ?>
		<?php $target = "_self";
		if(isset($item['#element']['attributes']['target'])){
			$target = $item['#element']['attributes']['target'];
		} ?>
		<a href="<?php print $item['#element']['url']; ?>" title="<?php print $item['#element']['title']; ?>" target="<?php print $target; ?>"><?php print_r($item['#element']['title']); ?><span class="active"></span></a>
	<?php }else{ ?>
		<a href="#" class="dropdown" onclick="return false;"><?php print $item['#element']['title']; ?><span class="active"></span></a>
	<?php } ?>
<?php endforeach; ?>
