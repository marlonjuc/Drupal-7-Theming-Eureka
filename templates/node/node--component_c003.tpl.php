<div class="c003-banner row">
    <?php
        $image_url = file_create_url($content['field_background']['#items'][0]['uri']);
    ?>
	<div class="banner-body">
        <div class="img" style="background-image: url(<?php print render($image_url); ?>)"></div>
    	<div class="banner-content col-xs-12 col-sm-9 col-md-6 col-sm-offset-1">
            <h2> <?php print render($content['field_product_banner_title']); ?> </h2>
            <h3 class="hidden-xs"> <?php print render($content['field_product_banner_description']); ?> </h3>
            <?php print render($content['field_product_banner_link']); ?>
        </div>
    </div>
</div>
