<div class="component-c022 col-xs-12 col-sm-6 col-md-3">
    <p class="image_container">
        <img src="<?php print render($content['field_image']);?>">
    </p>
    <?php if(render($title)){?>
        <h2><?php print render($title);?></h2>
    <?php }?>
    <?php if(render($content['field_sub_title'])){?>
        <p><?php print render($content['field_sub_title']);?></p>
    <?php }?>
    <?php if(render($content['field_sub_title'])){ ?>
        <p><?php print render($content['field_sub_title_2']);?></p>
    <?php }?>
</div>