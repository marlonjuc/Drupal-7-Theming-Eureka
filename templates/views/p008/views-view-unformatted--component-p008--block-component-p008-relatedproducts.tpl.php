<?php

/**
 * Prints firt wrapper of related product
 */
?>
<div class="row">
    <div class="col-xs-12">
        <h2><?php print t('Related Products');?></h2>
        <div class="related-products">
            <ul class="row desktop-p008">
              <li class="col-md-6 first">
              </li>
              <li class="col-md-6 second">
              </li>
            </ul>
            <div class="row">
                <ul class="slides">
                    <?php foreach ($rows as $id => $row): ?>
                    <li class="col-xs-12">
                        <div class="product-tile">
                            <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
                                <?php print $row; ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <li><div class="views-row last"></div></li>
                </ul>
            </div>
        </div>
        <div class="gradient-right"></div>
    </div>
</div>
