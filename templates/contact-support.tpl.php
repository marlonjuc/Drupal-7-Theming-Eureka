<p class="right-panel__title"><?php print render($content['field_cs_title']); ?></p>

<div class="right-panel__item ">
	<p class="right-panel__image"><?php print render($content['field_contact_by_phone_icon']); ?> </p>
	<p class="right-panel__subtitle"><?php print render($content['field_contact_number']); ?> <?php print render($content['field_contact_number_country']); ?></p>
</div>

<div class="right-panel__item ">
	<p class="right-panel__image"><?php print render($content['field_contact_by_e_mail_icon']); ?></p>
	<p class="right-panel__subtitle"><?php print render($content['field_contact_e_mail']); ?></p>
</div>

<div class="right-panel__item ">
	<p class="right-panel__image"><?php print render($content['field_more_support_icon']); ?></p>
	<a href="#"><?php print render($content['field_more_support_copy']); ?> <span class="right-panel__arrow-gray"></span></a>
</div>
