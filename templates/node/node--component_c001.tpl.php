<div class="c001__video-image-wrapper <?php print drupal_html_id('c001-video'); ?>" data-video-id="<?php print trim(render($content['field_video_id'])); ?>" data-poster-url="http://dev-acquia.eurekacamping.com/sites/eurekacamping/files/KWP_6869.png">
	
	<?php print render($content['field_videoimage']); ?>
	<span class="c001__video-image-play"> </span>
	<span class="c001__video-image-darkbg"> </span>
	<span class="c001__video-image-caption"><?php print $title; ?></span>
	<span class="c001__video-image-description"><?php print render($content['body']);?></span>
	<span class="c001__video-image-time"><?php print render($content['field_videolength']); ?></span>
</div>