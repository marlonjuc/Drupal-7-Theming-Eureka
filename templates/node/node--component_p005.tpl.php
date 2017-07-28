<?php 
    if (!function_exists('render_attributes_table')):
        function render_attributes_table($data, $initialAttributesToShow){
?>
            <table class="attributes-table">
                <tbody>
                    <?php
                        $index = 0;
                        $rowNumber = 0;
                    ?>
                    <?php foreach($data as $key => $item ): ?>
                        <?php $isEven = $index%2 == 0; ?>

                        <?php if($isEven): ?>
                            <?php $rowNumber += 1; ?>
                            <tr class="<?php echo ($rowNumber>$initialAttributesToShow)?'hidden-row':''; ?>">
                        <?php endif; ?>

                            <?php if(isset($item)){ ?>
                                <td class="<?php echo $isEven?'attr-name':'attr-value'; ?>">
                                    <?php print render($item['value']); ?>
                                </td>
                            <?php } ?>

                        <?php if( !$isEven ): ?>
                            </tr>
                        <?php endif; ?>

                        <?php $index+=1; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
<?php
            return $rowNumber;
        }
    endif;
?>


<?php
  if(!function_exists('render_show_more')):
    function render_show_more(){
?>
        <div class="show-more-cta hidden-md hidden-lg col-xs-12">
          <a href="#" class="show-more-link show-link" data-more-text="Show More" data-less-text="Show Less">Show More</a>
          <!--<a href="#" class="show-less-link show-link hidden">Show Less <span class="arrow open"></span></a>-->
        </div>
<?php
    }
  endif;
?>
<div class="p005-container row">

  <div class="tab-button col-xs-6" >
    <div class="title-tab" data-tab="details-container">
      <?php print render($content['field_detail_p005_title']); ?>
    </div>
  </div>

  <div class="tab-button col-xs-6">
    <div class="title-tab" data-tab="materials-container">
      <?php print render($content['field_material_p005_title']); ?>
    </div>
  </div>

  <div class="separator col-xs-12">
    <div class="separator-active"></div>
  </div>

  <?php $initialVisibleRows = 4; ?>

    <div class="tab details-container col-xs-12">
      <div class="row">
        <div class="tab-content col-xs-12 col-sm-6">
          <?php $rowNumber = render_attributes_table($content['field_detail_p005_fields']['#items'], $initialVisibleRows); ?>
        </div>
        <div class="tab-image hidden-xs col-sm-6">
          <?php print render($content['field_detail_p005_image']); ?>
        </div>
        <?php
            if($rowNumber>$initialVisibleRows)
                render_show_more();
        ?>
      </div>
    </div>

    <div class="tab materials-container col-xs-12">
      <div class="row">
        <div class="tab-content col-xs-12 col-sm-6">
          <?php $rowNumber = render_attributes_table($content['field_material_p005_fields']['#items'], $initialVisibleRows); ?>
        </div>
        <div class="tab-image hidden-xs col-sm-6">
          <?php print render($content['field_material_p005_image']); ?>
        </div>
        <?php
            if($rowNumber>$initialVisibleRows)
                render_show_more();
        ?>
      </div>
    </div>
</div>
