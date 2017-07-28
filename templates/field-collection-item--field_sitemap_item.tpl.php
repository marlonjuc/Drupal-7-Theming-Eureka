<div class="sitemap__item col-xs-12 col-sm-6 col-md-4">
    <div class="col col-xs-10 col-md-8">
        <div class="sitemap__item-link">
            <a href="<?php print render($content['field_sitemap_item_url']['#items'][0]['url']) ?>">
                <?php print render($content['field_sitemap_item_url']['#items'][0]['title']) ?>
            </a>
        </div>
        <div class="sitemap__item-description">
            <?php print render($content['field_sitemap_item_description']) ?>
        </div>
    </div>
</div>
