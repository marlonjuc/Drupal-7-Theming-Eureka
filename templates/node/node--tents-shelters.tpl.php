<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
$product_id = $node->field_product[LANGUAGE_NONE][0]['product_id'];
?>
<div id="node-<?php print $node->nid; ?>" class="pdp-p003 <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

    <div class="product">

        <div class="container pdp-sales-banner__sub">
            <div class="row">
                <div class="col-xs-7">

                </div>

                <div class="col-xs-5 text-right">
                    <div class="">
                        <div class="">
                            <div class="pinterest-btn"></div>
                            <div class="twitter-btn"></div>
                            <div class="facebook-btn"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="pdp-wrapper clearfix section-full-width">

            <!-- Main container -->
            <div class="section-padding">
            <div class="row">
                <div class="pdp-head-container col-xs-12 col-md-4">
                    <div class="pdp-details-container">

                        <div class="row">

                        <div class="col-xs-12">
                            <div class="pdp-new">
                                <?php print render($content['product:field_new_product_intro_year']); ?>
                            </div>
                        </div>

                            <div class="pdp-manufacturingproductname col-xs-4 col-sm-4">
                                <?php print $title; ?>
                            </div>

                            <!-- Carousel for Mobile & tablet -->
                            <div class="col-xs-12 pdp-carousel-wrapper visible-xs visible-sm">
                                <div class="pdp-carousel-wrapper_mobile ">

                                </div>
                                <span class="pdp-carousel__freecountry-logo"></span>
                            </div>

                            <!--Prints Add to cart form and attributes-->
                            <div class="col-xs-12 pdp-colors-controlers">
                                <?php print render($content['field_product']); ?>
                            </div>

                            <div class="pdp-product-description col-xs-12">
                                <?php print render($content['product:field_description_short']); ?>
                            </div>


                            <!--this will replaced by rating module-->
                            <div class="pdp-rating col-xs-12">
                                <div class="pdp-certlevel">
                                    3.5
                                </div>
                                <div class="pdp-catalogstatus">
                                    &#40; 30 &#41;
                                </div>
                                <div class="pdp-itemnumber">
                                    &#35; <?php print render($content['product:field_item_number']); ?>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-8">
                                <div class="pdp-pricing" style="clear:both">
                                    <div class="pdp-retailprice"><!--this will replaced by discount module-->
                                        $249.95 <span class="line-through"></span>
                                    </div>
                                    <div class="pdp-commerceprice">
                                        <?php print render($content['product:commerce_price']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <!-- TODO:
                                This Quantity widget should alter by js this hidden input.
                                <input type="hidden" name="quantity" value="1">-->
                                <div class="pdp-quantity" style="clear:both">
                                    <select name="select-custom">
                                        <?php foreach (range(1, 12) as $i): ?>
                                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div style="clear:both"></div>


                        <div class="pdp-offer-disclaimer">
                            <p>Free Shipping on All Orders Over $99</p>
                        </div>

                        <div class="module-buttons pdp-buttons">
                            <!-- This adds the "add to cart" button -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-12">
                                    <div class="button primary pdp-button__addToCart-placeholder">Add to cart</div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-12">
                                    <?php print render($content['field_find_in_store_link']); ?>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End Details Div-->

                </div>

                <div class="col-md-6 hide-on-mobile"></div>
                <div class="pdp-carousel-wrapper pdp-photo-wrapper col-xs-12 col-md-6 hide-on-mobile">
                    <div class="pdp-carousel-display"></div>
                    <span class="pdp-carousel__freecountry-logo"></span>
                </div>


                <!-- <div class="pdp-technical-specifications col-md-3"> -->
                <!-- class pdp-carousel-wrapper taken out from next div -->
                <div class="pdp-carousel__zoom--wrapper col-xs-12 col-md-1">

                    <span class="pdp-carousel__zoom--controlers"></span>
                    <div class=" hide-on-mobile pdp-carousel__drupal--placeholder pdp-carousel-thumbnails hide-on-mobile--disable ">
                        <div class="pdp-carousel-modal-controller hide-on-mobile">
                            <a href="#" class="pdp-carousel__zoom--close"></a>
                            <a href="#" class="pdp-carousel__zoom-in"></a>
                            <a href="#" class="pdp-carousel__zoom-out"></a>
                        </div>
                        <?php //print render($content['field_component_p005']); ?>
                        <?php print render($content['product:field_image']); ?>
                    </div>
                    <span class="pdp-carousel__zoom--magnify-glass" data-toggle="modal" data-target="#pdp-modal__desktop"></span>
                </div>

            </div>
            </div> <!-- End container -->
        </div> <!-- End Wrapper Div-->


        <!-- Modal for Desktop -->
        <div class="pdp-modal__desktop">

        </div>
        <!-- ./ Modal for Desktop -->

        <!-- Modal for Mobile & Tablet -->
        <div class="modal fade" id="pdp-modal__mobile" tabindex="-1" role="dialog" aria-labelledby="pdp-modal__mobile--label">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="pdp-modal__mobile--label"></h4>
              </div>
              <div class="modal-body">
                <!-- body data here -->
              </div>
              <div class="modal-footer">
                <!-- Footer data here -->
              </div>
            </div>
          </div>
        </div>
        <!-- ./ Modal for Mobile & Tablet -->


        <div class="pdp-technical-specifications section-full-width">
            <?php print render($content['field_component_p005']); ?>
        </div>

        <!-- Video -->
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

        <div class="pdp-accessories clearfix section-full-width test2">
            <div>
                <?php print views_embed_view('component_p007', 'block_component_p007_accesories', array($product_id)); ?>
            </div>
        </div>

        <div class="pdp-related-products clearfix section-full-width">
            <div >
                <?php print views_embed_view('component_p008', 'block_component_p008_relatedproducts', array($product_id)); ?>
            </div>
        </div>


    </div>

<?php print render($content['links']); ?>
</div>



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

