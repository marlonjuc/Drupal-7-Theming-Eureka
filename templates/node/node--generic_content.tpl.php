<?php if(empty($content['field_page_background'])){  ?>

<div class="generic-page ">
	<div class="section-full-width">
		<div class="section-padding">

			<div class="row">
				<?php if(!empty($content['field_include_support_block'])){  ?>
				<div class="col-xs-11 col-xs-offset-1 col-md-6 text-panel">
				<?php } else { ?>
				<div class="col-xs-12 text-panel">
				<?php } ?>
					<h1><?php print render($title); ?> </h1>
					<?php print render($content['body']); ?>
					<?php print render($content['field_link']); ?>
					<?php print render($content['field_body_text2']); ?>
				</div>	
				
				<?php if(!empty($content['field_include_support_block'])){  ?>
				<div class="col-xs-12 col-md-4 right-panel">
					<div class="right-panel__inner-wrapper clearfix">
						<?php print render($content['field_include_support_block']); ?>
					</div>
				</div>
				<?php } ?>
			
			</div><!-- ./ row -->
			
		</div> <!--  ./ section-padding -->
	</div> <!--  ./ section-full-width -->	
</div> <!-- ./ generic-page -->

<?php } else { ?>

<div class="error-page full-bg-page">
	<div class="full-background">
		<?php print render($content['field_page_background']); ?>
	</div>

	<div class="above-text">
		<div class="section-full-width">
			<div class="section-padding">
				<div class="row content-404">
					<div class="col-xs-12">
						<?php print render($content['body']); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?php } ?>