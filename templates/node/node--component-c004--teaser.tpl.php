<?php
    $active_download = !empty($content['field_download_c004']);

    $image_url = null;
    if( isset($content['field_background_c004'])) {
        $image_url = $content['field_background_c004'];
    }

?>
<!--Boostrap-->
<div class="c004-banner col-xs-12 col-sm-6">
  <div class="banner-body bg-zoom <?php echo ($active_download)?'banner-body-grey':'banner-body-bg'; ?>">

    <?php if($image_url): ?>
        <div class="img-zoom" style="background-image: url(<?php print render($image_url); ?>)"></div>
    <?php endif;?>

    <div class="banner-content">
      <h2> <?php print render($content['field_title_c004']); ?> </h2>

      <span class="separator"></span>

      <?php if($active_download) { ?>

        <h3 class="hidden-xs <?php echo (!$active_download)?"hidden-sm":"";?>">
          <?php print render($content['field_subtitle_c004']); ?>
        </h3>

        <?php print render($content['field_download_c004']); ?>

        <h4 class="hidden-xs <?php echo (!$active_download)?"hidden-sm":"";?>">
          <?php print render($content['field_description_c004']); ?>
        </h4>

      <?php } else { ?>

        <div class="banner-hide02 hidden-xs hidden-sm">
          <p> <?php print render($content['field_paragraph_c004']); ?> </p>
        </div>

      <?php } ?>

      <?php print render($content['field_link_c004']); ?>
    </div>

  </div>
</div>
