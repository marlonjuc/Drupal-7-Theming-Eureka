<?php
$product_id = $node->field_product[LANGUAGE_NONE][0]['product_id'];
?>

<div class="product">

	<div class="pdp-social-bar global-wrapper">
		<div class="pdp-social-icons">
			<div class="pinterest-btn"></div>
			<div class="twitter-btn"></div>
			<div class="facebook-btn"></div>
		</div>
	</div>

	<div class="pdp-wrapper clearfix global-wrapper">
		<?php print render($content['field_component_p009']); ?>

		<div class="pdp-description">
			<?php /* print render($content['field_component_p004']); */ ?>
		</div>

	</div> <!-- End Wrapper Div-->

	<div class="pdp-technical-specifications section-full-width">
		<?php print render($content['field_component_p005']); ?>
	</div>
	<!--
		TODO: Create all container sections below
	-->

	<div class="pdp-videos clearfix section-full-width">
		<?php print render($content['field_component_c001']); ?>
	</div>

	<div class="pdp-banner clearfix section-full-width">
		<div class="section-padding">
			<?php print render($content['field_component_c003']); ?>
		</div>
	</div>

	<div class="pdp-ctas clearfix section-full-width">
		<div class="section-padding">
			<div class="row">
				<?php print render($content['field_component_c004']); ?>
			</div>
		</div>
	</div>

	<div class="pdp-reviews clearfix section-full-width">
		<div class="section-padding">
			<?php print render($content['field_component_p006']); ?>
		</div>
	</div>


	<div class="pdp-accessories clearfix section-full-width">
		<div class="section-padding">
			<?php print views_embed_view('component_p007', 'block_component_p007_accesories', array($product_id)); ?>
		</div>
	</div>

	<div class="pdp-related-products clearfix section-full-width">
		<div class="section-padding">
		<?php print views_embed_view('component_p008', 'block_component_p008_relatedproducts', array($product_id)); ?>
		</div>
	</div>

	<!------------------------------------------------------------------------>

	<div class="pdp-links">
		<div class="pdp-fieldbrand"> <?php print render($content['product:field_brand']); ?> </div>
		<div class="pdp-category"> <?php print render($content['product:field_category']); ?> </div>
		<div class="pdp-subcategory"> <?php print render($content['product:field_sub_category']); ?> </div>
		<div class="pdp-class"> <?php print render($content['product:field_class']); ?> </div>
		<div class="pdp-producttype"> <?php print render($content['product:field_product_type']); ?> </div>
		<div class="pdp-marketingbrand"> <?php print render($content['product:field_marketing_brand']); ?> </div>
		<div class="pdp-marketingcategoryl1"> <?php print render($content['product:field_marketing_category_l1']); ?> </div>
		<div class="pdp-fieldmarketingcategoryl3"> <?php print render($content['product:field_marketing_category_l3']); ?> </div>
		<div class="pdp-marketingbrand"> <?php print render($content['product:field_marketing_brand']); ?> </div>
		<div class="pdp-fieldfamilyseries"> <?php print render($content['product:field_family_series']); ?> </div>
		<div class="pdp-fieldbestfor"> <?php print render($content['product:field_best_for']); ?> </div>
		<div class="pdp-fieldproducttag"> <?php print render($content['product:field_product_tag']); ?> </div>
		<div class="pdp-fieldplace"> <?php print render($content['product:field_place']); ?> </div>
		<div class="pdp-fieldfamilyseries"> <?php print render($content['product:field_family_series']); ?> </div>
	</div>

	<!--
		All this data don't needed for this page
	-->

	<div class="pdp-dont-used">
		<div class="pdp-bullets">
			<div class="pdp-featurebullet1"> <?php print render($content['product:field_feature_bullet_1']); ?> </div>
			<div class="pdp-featurebullet2"> <?php print render($content['product:field_feature_bullet_2']); ?> </div>
			<div class="pdp-featurebullet3"> <?php print render($content['product:field_feature_bullet_3']); ?> </div>
			<div class="pdp-featurebullet4"> <?php print render($content['product:field_feature_bullet_4']); ?> </div>
			<div class="pdp-featurebullet5"> <?php print render($content['product:field_feature_bullet_5']); ?> </div>
			<div class="pdp-featurebullet6"> <?php print render($content['product:field_feature_bullet_6']); ?> </div>
		</div>
	</div>

	<!--
		All this data comes empty !
	-->

	<div class="pdp-empty">
		<div class="pdp-sku"> <?php print render($content['product:sku']); ?> </div>
		<div class="pdp-altnoimagesrequired"> <?php print render($content['product:field_alt_noimages_required']); ?> </div>
		<div class="pdp-altnoimagesrequired"> <?php print render($content['product:field_alt_noimages_requiredd']); ?> </div>
		<div class="pdp-situationno_imagesrequir"> <?php print render($content['product:field_situation_no_images_requir']); ?> </div>
		<div class="pdp-situationimage"> <?php print render($content['product:field_situation_image']); ?> </div>
		<div class="pdp-fieldstyle"> <?php print render($content['product:field_style']); ?> </div>
		<div class="pdp-status"> <?php print render($content['product:status']);?> </div>
		<div class="pdp-upc"> <?php print render($content['product:field_upc']); ?> </div>
		<div class="pdp-rebateavailable"> <?php print render($content['product:field_rebate_available']); ?> </div>
		<div class="pdp-promotionavailable"> <?php print render($content['product:field_promotion_available']); ?> </div>
		<div class="pdp-shortdescription"> <?php print render($content['product:field_short_description']); ?> </div>
		<div class="pdp-width"> <?php print render($content['product:field_width']); ?> </div>
		<div class="pdp-widthm"> <?php print render($content['product:field_width_m']); ?> </div>
		<div class="pdp-widthshoulders"> <?php print render($content['product:field_width_shoulders']); ?> </div>
		<div class="pdp-widthatshouldersm"> <?php print render($content['product:field_width_at_shoulders_m']); ?> </div>
		<div class="pdp-widthatfeet"> <?php print render($content['product:field_width_at_feet']); ?> </div>
		<div class="pdp-shouldergirth"> <?php print render($content['product:field_shoulder_girth']); ?> </div>
		<div class="pdp-shouldergirthm"> <?php print render($content['product:field_shoulder_girth_m']); ?> </div>
		<div class="pdp-zipperlength"> <?php print render($content['product:field_zipper_length']); ?> </div>
		<div class="pdp-zipperlengthm"> <?php print render($content['product:field_zipper_length_m']); ?> </div>
		<div class="pdp-fieldsize"> <?php print render($content['product:field_size']); ?> </div>
		<div class="pdp-productweight"> <?php print render($content['product:field_product_weight']); ?> </div>
		<div class="pdp-productweightm"> <?php print render($content['product:field_productweight_m']); ?> </div>
		<div class="pdp-ratingf"> <?php print render($content['product:field_temp_rating_f']); ?> </div>
		<div class="pdp-tempratingc"> <?php print render($content['product:field_temp_rating_c']); ?> </div>
		<div class="pdp-zipperside"> <?php print render($content['product:field_zipper_side']); ?> </div>
		<div class="pdp-zipperstyle"> <?php print render($content['product:field_zipper_style']); ?> </div>
		<div class="pdp-zipperdescription"> <?php print render($content['product:field_zipper_description']); ?> </div>
		<div class="pdp-fieldvideos"> <?php print render($content['product:field_videos']); ?> </div>
		<div class="pdp-insulcoreicon"> <?php print render($content['product:field_insulcore_icon']); ?> </div>
		<div class="pdp-synthesisicon"> <?php print render($content['product:field_synthesis_icon']); ?> </div>
		<div class="pdp-thermashieldicon"> <?php print render($content['product:field_thermashield_icon']); ?> </div>
		<div class="pdp-hipping"> <?php print render($content['product:field_shipping']); ?> </div>
		<div class="pdp-stockingtype"> <?php print render($content['product:field_stocking_type']); ?> </div>
		<div class="pdp-purchaseavailability"> <?php print render($content['product:field_purchase_availability']); ?> </div>
	</div>

</div> <!-- End Product Div-->


<!--
	login modal
-->


<div class="modal fade default-modal" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	    <div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    </div>

      <div class="modal-body">

			  	<img class="logo hidden-sm hidden-md hidden-lg" src="<?php echo base_path().path_to_theme() ?>/assets/img/eureka-logo-white_copy.png">
			  	<img class="logo hidden-xs visible-sm-*" src="<?php echo base_path().path_to_theme() ?>/assets/img/eureka-logo-tablet.png">
			    <div class="title">
			    	ONE ACCOUNT. <span>640 MILLION ACRES</span> OF POSSIBILITY.
			    </div>
			    <p class="description">
			    	Sign up and sign in with just one step.
			    	<span></span>
			    	Then get equipped to find your Freecountry.
			    </p>

			    <div class="row icons">
			    	<div class="col-xs-4 col-sm-2 col-sm-offset-3"><div class="social-icon icon-fb"></div></div>
			    	<div class="col-xs-4 col-sm-2"><div class="social-icon icon-amazon"></div></div>
			    	<div class="col-xs-4 col-sm-2"><div class="social-icon icon-google"></div></div>
			    </div>


			   	<div class="check-box keep-me-in">
			   		<input id="true" class="input-place " type="checkbox" value="true" name="receive_emails" checked="true">
			   		<span class="mask"></span><label for="true">Keep me logged in</label>
			   	</div>

				  <div class="disclaimers">
				  	<div class="disclaimer">By logging in, you agree to Johnson Outdoors’ <span> <a href="#PrivacyPolicy">Privacy Policy</a> and
				  		<a href="#TermsOfUse">Terms of Use</a>. </span> </div>
				  </div>


      </div>

    </div>
  </div>
</div>


<!--
	END login modal
-->
