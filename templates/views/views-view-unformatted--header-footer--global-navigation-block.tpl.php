<?php $cart_teaser = module_invoke('jo_ajax_add_cart', 'block_view', 'ajax_shopping_cart_teaser');?>
<div class="utility-container">
    <div class="section-full-width">
        <div class="section-padding">
            <div class="row clearfix">
                <div class="brands-items clearfix">
                    <?php foreach ($rows as $id => $row): ?>
                        <?php print $view->render_field('field_global_navigation_link', $id);?>
                    <?php endforeach; ?>
                </div>
                <div class="acount_items row">
                    <?php if (!user_is_logged_in()) : ?>
                        <a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a>
                    <?php endif; ?>
                    <a  href="#">USA | English</a>
                    <?php print render($cart_teaser['content']);?>
                </div>
            </div>
        </div>
    </div>
</div>
