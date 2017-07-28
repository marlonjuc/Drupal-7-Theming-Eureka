<?php

/**
 * @file
 * Default theme implementation to display a block.
 *
 * Available variables:
 * - $block->subject: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be 'block-user'.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>


<!-- newsletter modal -->

<?php // print $content ?>

<div class="modal fade default-modal" id="newsletter-modal" tabindex="-1" role="dialog" aria-labelledby="Newsletter modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">

				<img class="logo hidden-sm hidden-md hidden-lg" src="<?php echo base_path().path_to_theme() ?>/assets/img/eureka-logo-white_copy.png">
				<img class="logo hidden-xs" src="<?php echo base_path().path_to_theme() ?>/assets/img/eureka-logo-tablet.png">
				<div class="title">
					<span> YOUR JOURNEY <br class="hidden-xs">STARTS HERE.</span>
				</div>

				<p class="description">
					Get the latest on Eureka! gear, discount codes, and all<br class="hidden-xs"> kinds of other good stuff to fuel your adventure.
				</p>

				<div class="row icons">
					<div class="col-xs-12">
						<!-- www.123contactform.com script begins here -->

						<?php print $content ?>

                        <!-- www.123contactform.com script ends here -->

					</div>
				</div>

			</div>

		</div>
    </div>
</div>

<!-- END newsletter modal -->