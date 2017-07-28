<li class="product-review col-xs-12">
    <div class="content col-md-offset-1">
        <div class="review-rating"> <?php print render($content['field_review_rating']); ?> </div>
        <h3> <?php print render($content['field_review_title']); ?> </h3>
        <span class="date"> <?php print render($content['field_review_date']); ?> </span>
        <p> <?php print render($content['field_review_description']); ?> </p>
        <p> Written by <b> <?php print render($content['field_review_author']); ?> </b>,  <?php print render($content['field_review_location']); ?> </h2>
    </div>
</li>
