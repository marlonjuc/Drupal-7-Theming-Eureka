<!-- children of More Eureka -->
<ul class="about-menu-menu_items">
	<?php foreach ($items as $delta => $item): ?>
		<?php if (!empty($item)){ ?>
				<li>
				<?php if (!empty($item['#element']['url'])){ ?>
					<?php $target = "_self";
					if(isset($item['#element']['attributes']['target'])){
						$target = $item['#element']['attributes']['target'];
					} ?>
					<a href="<?php print $item['#element']['url']; ?>" title="<?php print $item['#element']['title']; ?>" target="<?php print $target; ?>"><?php print_r($item['#element']['title']); ?></a>
				<?php }else{ ?>
					<a href="#" class="dropdown" onclick="return false;"><?php print $item['#element']['title']; ?><span class="caret"></span></a>
				<?php } ?>
				</li>
		<?php } ?>
	<?php endforeach; ?>
</ul>