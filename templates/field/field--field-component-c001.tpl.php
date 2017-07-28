<div class="c001-container" >
	<!-- Video Display -->
	<div class="section-padding">
		<div class="row">
			<div class="col-md-12 no-padding">
				<div class="c001__video-display-wrapper">
					<div class="c001__video-display"><div id="video-placeholder"></div></div>
					<div class="c001__video-poster hidden-xs"><span class="c001__video-poster-icon"></span></div>
					<div class="c001__video-display-info hidden-xs"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 c001__slick-display"></div>
		<!-- carousel -->
		<div class="col-md-12 c001__video-carousel-container">
			<div class="row">
				<div class="col-lg-10 col-md-12 col-lg-offset-1 c001__video-carousel-main-col">
					<div class="c001__video-carousel-images">
						<?php foreach ($items as $delta => $item):?>
			            	<?php print render($item); ?>
			            <?php endforeach; ?>
					</div>
				</div>
				<span class="c001__video-carousel-fader"></span>
			</div>
		</div>
	</div>
</div>