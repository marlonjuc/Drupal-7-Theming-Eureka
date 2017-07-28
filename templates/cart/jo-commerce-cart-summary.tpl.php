<?php

/**
 * @file
 * Add to cart message template file.
 *
 */
?>
<div class="summary-box">
  <h5 class="headline"><?php print t('SUMMARY');?></h5>
  
  <ul class="items-list">
    <li>
      <span class="h7"><?php print t('SUBTOTAL');?></span>
      <span class="number"><?php print $vars['sub_total'];?></span>
    </li>
    <li>
      <span class="h7 plus"><?php print t('ESTIMATED');?> <?php print t('TAX')?></span>
      <span class="number"><?php print $vars['shipping_taxes'];?></span>

      <div class="detail-box">
        <input id="zipcode" type="text" placeholder="ZIP CODE" />
        <a href="#" id="update_zip" class="update_cart_detail"><?php print t('UPDATE');?></a>
        <p class="estimated_shipping">Estimated shipping & tax for Chicago, IL 60605</p>
      </div>
    </li>
    <li>
      <span class="h7 plus"><?php print t('ESTIMATED SHIPPING <br class="mobile"> BY BRAND');?></span>
      <span class="number"><?php print $vars['shipping_total'];?></span>

      <div class="detail-box">

      <ul class="brand-list">
      
        <li><span class="name">EUREKA!</span><span class="total"><?php print $vars['shipping_eureka'];?></span></li>
        <!-- 
        <li><span class="name">JETBOIL</span><span class="total"><?php print $vars['shipping_jetboil'];?></span></li>
        <li><span class="name">OLDTOWN</span><span class="total"><?php print $vars['shipping_oldtown'];?></span></li>
        -->
      </ul>

      </div>
    </li>
    <li>
      <span class="h7 plus"><?php print t('PROMOS');?></span>
      <span class="number"><?php print $vars['promos'];?></span>

      <div class="detail-box">
        <input id="promocode" type="text" placeholder="CODE" />
        <a id="update_promocode" href="#" class="update_cart_detail">APPLY</a>
      </div>
    </li>
    <li>
      <span class="h7">TOTAL</span>
      <span class="number"><?php print $vars['total'];?></span>
    </li>
  </ul>
  <?php print $vars['checkout'];?>
  <?php 
    // removing paypal checkout button that appear only in the checkout page on step 2
    //print $vars['paypal_checkout'];
  ?>
</div>
