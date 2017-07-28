<div class="p006-container row">
  <div class="p006-header">
    <div class="body-content-left col-xs-12 col-md-5">
      <h2> <?php print render($content['field_title_reviews']); ?> </h2>
      <span class="h2-separator"></span>
      <div class="rating-data hidden-xs visible-md visible-lg">
        <div class="rating-stars">
          <?php print render($content['field_average_rating']); ?>
        </div>
        <div class="rating-text">
          <?php print number_format(render($content['field_average_rating']), 1); ?>
        </div>
        <span class="rating-separator"></span>
        <div class="total-votes">
          &#40; <span><?php print render($content['field_average_votes']); ?> </span>&#41;
        </div>
      </div>
      <p class="hidden-xs visible-md visible-lg">
        <?php print render($content['field_copy_review']); ?>
      </p>
      <p class="hidden-xs visible-md visible-lg">
        <?php print render($content['field_write_review']); ?>
      </p>
    </div>

    <?php
      $ratings = [
        array(
          "class"   => "rating-total-five-stars",
          "average" => $content['field_average_five_stars'],
          "number"  => 5
        ),
        array(
          "class"   => "rating-total-four-stars",
          "active"  => "active",
          "average" => $content['field_average_four_stars'],
          "number"  => 4
        ),
        array(
          "class"   => "rating-total-three-stars",
          "average" => $content['field_average_three_stars'],
          "number"  => 3
        ),
        array(
          "class"   => "rating-two-five-stars",
          "average" => $content['field_average_two_stars'],
          "number"  => 2
        ),
        array(
          "class"   => "rating-total-one-star",
          "average" => $content['field_average_one_star'],
          "number"  => 1
        )
      ];
    ?>
      <div class="body-content-right col-xs-12 col-md-5">
        <div class="row">
          <ul class="graphics col-xs-12">
            <?php foreach ($ratings as $key => $rating_data): ?>
            <?php $rating_active = isset($rating_data['active'])? $rating_data['active']:""; ?>
            <li class="row <?php echo $rating_active; ?>">
              <span class="rating-row col-xs-1"><?php echo $rating_data['number']; ?></span>
              <span class="icon-star col-xs-1"></span>
              <div class="charts col-xs-8">
                <div class="rating-bar-bg"></div>
                <div class="rating-bar-active"></div>
              </div>
              <span class="rating-total col-xs-1 <?php echo $rating_data['class']; ?>">
                <?php print render($rating_data['average']); ?>
              </span>
            </li>
            <?php endforeach; ?>
          </ul>
          
          <div class="col-xs-12">
            <a href="#" class="sort-link">Sort Your Results</a>
            <p class="hidden-md hidden-lg write-review-cta">
                <?php print render($content['field_write_review']); ?>
            </p>
          </div>

        </div>

      </div>

      <div class="reviews col-xs-12">
        <ul class="row">
            <?php print render($content['field_product_review']);?>
        </ul>

        <div class="row">
          <div class="show-more-cta col-xs-12">
            <a href="#" class="show-more-link show-link" data-more-text="Show More" data-less-text="Show Less">Show More</a>
          </div>
        </div>
      </div>
    </div>
</div>
