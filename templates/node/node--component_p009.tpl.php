<div class="pdp-head-container row">

    <div class="pdp-details-container col-sm-12 col-md-12 hidden-lg">

        <div class="pdp-new">
            <?php echo strip_tags(render($content['field_header_p009'])); ?>
        </div>

        <div class="pdp-manufacturingproductname">
            <?php print render($content['field_title_p009']); ?>
        </div>

    </div>

    <div class="pdp-carousel-wrapper col-sm-12 col-md-12 col-lg-6 col-lg-push-4">
        <div class="pdp-component">
            <div class="flexslider slider" >
                <ul class="slides">
                    <?php foreach($content['field_carousel_images_p009']['#object']->field_carousel_images_p009['und'] as $image_item): ?>
                            <li >
                                <?php
                                    $zoom_image_url = file_create_url($image_item['uri']);
                                    $image_item['attributes']['data-zoom-image'][] = $zoom_image_url;
                                ?>
                                <img data-toggle="modal" data-target="#pdp-carousel_modal" src="<?php echo $zoom_image_url; ?>" data-zoom-image="<?php echo $zoom_image_url; ?>">
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal for <= tablet -->

        <!-- Modal -->
        <div class="modal fade in" id="pdp-carousel_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <!-- <h4 class="modal-title" id="myModalLabel">Modal title</h4> -->
                    </div>
                    <div class="modal-body">
                        <div class="pdp-carousel__mobile-display">
                            <?php foreach($content['field_carousel_images_p009']['#object']->field_carousel_images_p009['und'] as $image_item): ?>
                                <?php
                                    $zoom_image_url = file_create_url($image_item['uri']);
                                    $image_item['attributes']['data-zoom-image'][] = $zoom_image_url;
                                ?>
                                <img src="<?php echo $zoom_image_url; ?>" data-zoom-image="<?php echo $zoom_image_url; ?>">
                            <?php endforeach; ?>
                        </div>
                    </div>
                        
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-xs-12">
                                
                                <div class="pdp-carousel__mobile-container">
                                    <?php foreach($content['field_carousel_images_p009']['#object']->field_carousel_images_p009['und'] as $image_item): ?>
                                        <?php
                                            $zoom_image_url = file_create_url($image_item['uri']);
                                            $image_item['attributes']['data-zoom-image'][] = $zoom_image_url;
                                        ?>
                                        <img src="<?php echo $zoom_image_url; ?>" data-zoom-image="<?php echo $zoom_image_url; ?>">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <!-- ./ Modal -->

    <div class="pdp-details-container col-sm-12 col-md-12 col-lg-4 col-lg-pull-6">

        <div class="row">
            <div class="pdp-new visible-lg col-md-12">
                <?php echo strip_tags(render($content['field_header_p009'])); ?>
            </div>

            <div class="pdp-manufacturingproductname visible-lg col-md-12">
                <?php print render($content['field_title_p009']); ?>
            </div>

            <div class="pdp-product-description col-md-12">
                <?php print render($content['field_description_p009']); ?>
            </div>

            <div class="pdp-colors col-md-12">
                <ul>
                    <?php foreach($content['field_colors_p009']['#items'] as $key => $item ): ?>
                        <?php if(isset($item)){ ?>
                            <li class="pdp-color <?php print str_replace(' ', '', strip_tags(render($item['value']))); ?> "><div></div></li>
                        <?php } ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="pdp-rating col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="pdp-certlevel">
                            <?php print render($content['field_rating_p009']); ?>
                         </div>
                        <div class="pdp-catalogstatus">
                            &#40; <?php print render($content['field_votes_p009']); ?> &#41;
                        </div>
                    </div>
                    <div class="pdp-itemnumber col-md-4">
                        &#35; <?php print render($content['field_model_number_p009']); ?>
                    </div>
                </div>
            </div>

            <div class="pdp-pricing col-md-12">

                <div class="row">

                    <div class="pdp-retailprice col-md-4">
                        <?php print render($content['field_retail_price_p009']); ?><span class="line-through"></span>
                    </div>
                    <div class="pdp-commerceprice col-md-4">
                        <?php print render($content['field_commerce_price_p009']); ?>
                    </div>
                    <div class="pdp-quantity col-md-4">
                        <select name="select-custom">
                            <?php foreach(range(1, render($content['field_quantity_p009'])) as $i): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endforeach; ?>
                       </select>
                    </div>

                </div>

            </div>

            <div class="pdp-offer-disclaimer col-md-12">
                <p><?php print render($content['field_disclaimer_p009']); ?></p>
            </div>

            <div class="pdp-buttons col-md-12">
                <!-- This adds the "add to cart" button -->
                <div class="pdp-button pdp-button-grey">add to cart<span class="pdp-button-arrow-grey"></span></div>
                <div class="pdp-button pdp-button-white">find in store<span class="pdp-button-arrow-green"></span></div>
            </div>

        </div> <!-- End Details Div-->
    </div>


    <div class="pdp-carousel-wrapper col-lg-2 visible-lg">
        <div class="pdp-component">
            <div class="flexslider thumbs">
                <ul class="slides">
                    <?php foreach($content['field_carousel_images_p009']['#object']->field_carousel_images_p009['und'] as $imageItem): ?>
                        <li>
                            <?php
                                $zoom_image_url = file_create_url($imageItem['uri']);
                                $imageItem['attributes']['data-zoom-image'][] = $zoom_image_url;
                            ?>
                            <img src="<?php echo $zoom_image_url; ?>" data-zoom-image="<?php echo $zoom_image_url; ?>">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="zoomin"></div>
        </div><!--End of Component -->
        <div class="fc-approved">
            <?php print render($content['field_fc_approved_p009']); ?>
        </div>
    </div><!--End of Carousel Component Wrapper-->


</div>