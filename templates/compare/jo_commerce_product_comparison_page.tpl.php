<?php
/**
 * @file
 * Template for comparison page.
 * variables:
 * $filters
 * $header_products
 * $differences_grid
 * $footer_products
 */
$social_links = module_invoke('widgets', 'block_view', 's_socialmedia_profile-default');
?>
<div class="compare container" data-action="compare">
    <!-- first row - social icons -->
    <div class="row ">
        <div class="col-xs-6 compare_goback">
            <p>
                <a href="#"><img src="/sites/all/themes/eureka/assets/img/arrow-down.svg" alt="show more"><span>Return to Shopping </span></a>
            </p>
        </div>
        <div class="col-xs-6 compare_social-icons">
            <!-- <?php print render($social_links['content']); ?> -->
            <a href="https://www.pinterest.com/"><img class="" src="/sites/all/themes/eureka/assets/img/social_icons/pinterest-logo.svg" ></a>
            <a href="https://twitter.com/"><img class="" src="/sites/all/themes/eureka/assets/img/social_icons/twitter-logo.svg" ></a>
            <a href="https://www.facebook.com/"><img class="" src="/sites/all/themes/eureka/assets/img/social_icons/facebook-logo-flat.png" ></a>
        </div>
    </div>
    <!-- second row - main title -->
    <div class="row">
        <div class="col-xs-12 compare_main-title">

            <p> <?php print t('TENT PRODUCT');?> <span><?php print t('COMPARISON');?></span></p>
        </div>
            <div class="col-xs-12 compare_products-items">
                <div class="row products-row">
                    <?php print $header_products;?>
                </div>
            </div>
        <div class="col-xs-12 compare_manage-hightlight">
            FEATURES: Differences highlighted in green <a href="#" class="compare_remove-hightlight">REMOVE HIGHLIGHT</a>
        </div>
    </div>
    <!-- third row - sleeps -->
    <p><span class="compare_row-divider"></span></p>
      <!-- 11th row - ADD TO CART   -->
      <?php print $differences_grid; ?>
    <div class="row compare_addtocart">
      <?php print $footer_products; ?>
    </div>

</div>
