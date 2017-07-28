<?php
/**
 * @file
 * Template for PDP Gallery
 * 
 * variables
 * 
 * $items  array of images.
 * 
Array
(
    [0] => Array
        (
            [fid] => 601
            [uid] => 1
            [filename] => tent1-large1_0.png
            [uri] => public://tent1-large1_0_0.png
            [filemime] => image/png
            [filesize] => 203847
            [status] => 1
            [timestamp] => 1468431397
            [type] => image
            [field_file_image_alt_text] => Array
                (
                )

            [field_file_image_title_text] => Array
                (
                )

            [rdf_mapping] => Array
                (
                )

            [metadata] => Array
                (
                    [height] => 537
                    [width] => 992
                )

            [alt] => 
            [title] => 
            [height] => 537
            [width] => 992
        )

)
 * 
 * 
 * 
 * 
 * $slide = cloud_zoom_get_img_tag($variables['slide_style'], $item);
    $thumb = cloud_zoom_get_img_tag($variables['thumb_style'], $item);
 * 
 * 
 * 
 */
?>



<?php foreach ($items as $delta => $item):?>
      <?php print jo_flex_zoom_get_img_tag('large', $item); ?>
<?php endforeach; ?>





