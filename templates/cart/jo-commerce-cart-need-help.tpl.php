<?php

/**
 * @file
 * Add to cart message template file.
 *
 */

?>
<div class="component-c007">
    <h2 class="title"><?php print variable_get('jo_commerce_cart_contact_title', ''); ?></h2>
    <?php $menu_tree = menu_tree(variable_get('jo_commerce_cart_contact_menu', '')); ?>
    <?php print render($menu_tree); ?>

    <?php
    	$phone_number = variable_get('jo_commerce_cart_contact_phone', '');
		$contact_number =  preg_replace("/[^0-9,.]/", "", $phone_number );
	?> 
    <p><a href="tel:+<?php print $contact_number ?>" class="help-contact"><span class="icon-phone-icon contact-icons"></span><?php print variable_get('jo_commerce_cart_contact_phone', ''); ?></a></p>

    <p><a href="mailto:<?php print variable_get('jo_commerce_cart_contact_email', ''); ?>" class="help-contact"><span class="icon-email-icon contact-icons"></span><?php print variable_get('jo_commerce_cart_contact_email', ''); ?></a></p>

	<?php
		$contact_support = variable_get('jo_commerce_cart_contact_support', '');
	?>   

    <?php if($contact_support != ''){?>
    	<p><a href="" class="help-contact"><span class="icon-question-mark contact-icons"></span><?php print $contact_support ?></a></p>
    <?php }?>

</div>





