<?php
// $Id: block.tpl.php,v 1.1.2.2.2.4 2009/01/16 21:53:32 tombigel Exp $

/**
* @file block.tpl.php
*
* Theme implementation to display a block.
*
* Available variables:
* - $block->subject: Block title.
* - $block->content: Block content.
* - $block->module: Module that generated the block.
* - $block->delta: This is a numeric id connected to each module.
* - $block->region: The block region embedding the current block.
*
* Helper variables:
* - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
* - $zebra: Same output as $block_zebra but independent of any block region.
* - $block_id: Counter dependent on each block region.
* - $id: Same output as $block_id but independent of any block region.
* - $is_front: Flags true when presented in the front page.
* - $logged_in: Flags true when the current user is a logged-in member.
* - $is_admin: Flags true when the current user is an administrator.
*
* Tendu Specific:
* - $block_region_placement: Outputs 'block-first and 'block-last' to the first and the last blocks on each block region.
*
* Suport for "block-class" and "block-theme" modules (Not included in the theme):
* - $blocktheme: Blocktheme's machine readable block name.
* - block_class($block): Block classes defined in admin/build/block
*
* @see template_preprocess()
* @see template_preprocess_block()
*/
// Here we override specific blocks based on their name and delta, more specifically by which view provides the block
// There is a limitation in Views module which keeps one from doing block-views-[VIEWNAME].tpl.php for all blocks from a particular view.
// As a workaround we simply check the VIEWNAME here to override the template as needed.
?>
<div class="block block-views-n009-block block-views component-n009 section-full-width"<?php print $content_attributes; ?>>
	<div class="section-padding">
	    <h2 class="n009-title"><?php print render($block->subject); ?></h2>
	    <div class="content">
		   <?php print render($content); ?>
	    </div>
    </div>
</div>
