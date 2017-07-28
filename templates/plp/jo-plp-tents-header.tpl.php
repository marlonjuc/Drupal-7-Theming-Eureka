<?php
/**
 * @file
 * Template file
 * Variables *
 */
?>
<div class="pdp-controls plp_filters section-full-width">
    <div class="section-padding">
        <div class="filter-buttons row">
            <div class="filters filter col-xs-6 col-md-2" data-filter="filter">
                <?php print t('Filters');?>
                <span class="icon icon-icon-plus"></span>
            </div>
            <div class="filters sort col-xs-6 hidden-md" data-filter="sort">
                <?php print t('Sort');?>
                <span class="icon icon-icon-plus"></span>
            </div>
            <div class="sort-filters col-md-8 hidden-xs hidden-sm ">
                <?php print render($sorts['content']); ?>
            </div>
        </div>

        <div class="filter-content filter-box">
            <div class="clear-all-btn top">
                <?php
                if (isset($currentsearch)): ?>
                <?php print render($currentsearch['content']); ?>
                <?php endif; ?>

                <div class="button secondary clear">
                    <?php print l(t('Clear All'), '/tents', array('attributes' => array('class' => 'clear-all-link'))); ?>
                </div>
            </div>

            <div class="ux-container">
                <div class="row">
                    <?php foreach ($filters as $facet_block) : ?>
                        <div class="col-xs-12 col-md-2 col-lg-1 box-filter">
                            <div class="title"><?php print $facet_block['title']; if (!empty($facet_block['info']['value'])){?> <span  class="icon icon-question-mark visible-md-inline visible-lg-inline tooltip-help" title="<?php print $facet_block['info']['value']; ?>" data-html="true" data-toggle="tooltip" data-placement="bottom"></span><?php }?><span class="icon toggle-box icon-icon-light-down"></span></div>
                            <?php /*if (!empty($facet_block['info']['value'])):
                                  print $facet_block['info']['value']; ?>
                                  endif;*/
                            ?>
                            <?php print render($facet_block['facet']['content']); ?>
                            <?php if (!empty($facet_block['info']['value'])){ ?>
                                <span class="tooltip-help visible-xs visible-sm" title="<?php print $facet_block['info']['value']; ?>" data-html="true" data-placement="bottom" data-toggle="tooltip">Need help choosing a <span><?php print $facet_block['title'];?>?</span></span>
                            <?php }?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="sort-content filter-box hidden-md">
            <?php print render($sorts['content']); ?>
        </div>

        <div class="clear-all-btn bottom">
            <?php
            if (isset($currentsearch)): ?>
            <?php print render($currentsearch['content']); ?>
            <?php endif; ?>

            <div class="separator-buttons"> </div>
            <div class="button secondary clear clear-all hide">
                <?php print l(t('Clear All'), '/tents', array('attributes' => array('class' => 'clear-all-link'))); ?>
            </div>

            <div class="button secondary clear compare">
                <?php print l(t('Compare'), 'properties/compare', array('attributes' => array('class' => 'compare-link'))); ?>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</div>
