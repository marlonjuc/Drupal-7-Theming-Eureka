<?php
    //TODO move this code into the Drupal core
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>

<?php
/**
 * @file
 * Default theme implementation to display a block.
 *
 * Available variables:
 * $plp_id
 */

?>
<?php
    $plp_title = t(variable_get('jo_core_'.$plp_id.'_title'));
    //image
    $image_file = file_load(variable_get('jo_core_'.$plp_id.'_image_1'));
    $image_alt = variable_get('jo_core_'.$plp_id.'_image_1_alt', 'product type hero');
?>
<div id="<?php print ($block_html_id) ? $block_html_id  : 'plp-'.$plp_id ; ?>" class="<?php print $classes; ?> component-h003 row"<?php print t($attributes); ?>>
    <div class="plp-hero-wrapper">

        <div class="plp-hero-img-container">
            <div class="plp-hero-image" style="background-image: url('<?php print file_create_url($image_file->uri);?>')">

            </div>
        </div>

        <div class="plp-hero-text">
            <div class="plp-hero-text-wrapper animations">
                <h1 data-animate="start-animation">
                    <span class="line line-1">
                        <span class="line__content">
                            <?php print $plp_title;?>
                        </span>
                    </span>
                </h1>
            </div>
        </div>
    </div>
</div>
