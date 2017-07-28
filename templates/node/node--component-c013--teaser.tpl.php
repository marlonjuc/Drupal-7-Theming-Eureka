<div class="component-c013 col-xs-12">
    <ul class="faqs-list row">
        <?php foreach($content['field_question']['#items'] as $key => $item ): ?>
            <li class="col-xs-12 col-sm-6 col-md-3">
                <a class="question" href="#" onclick="return false;"> <?php print render($item['value']); ?> <span></span></a>
                <p class="answer"> <?php print render($content['field_answer'][$key]); ?> </p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
