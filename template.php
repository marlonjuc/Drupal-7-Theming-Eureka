<?php
  function eureka_preprocess_html(&$variables) {
    // Viewport!
  $viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1',
    ),
  );
  drupal_add_html_head($viewport, 'viewport');
  }

  /**
   *
   * @param type $vars
   */
  function eureka_preprocess_page(&$vars) {
  $header = drupal_get_http_header("status");
  if ($header == "404 Not Found") {
    $vars['theme_hook_suggestions'][] = 'page__404';
  }
  elseif ($header == "403 Forbidden") {
    $vars['theme_hook_suggestions'][] = 'page__403';
  }
}

/**
 * Override or insert variables into the node template.
 */
function eureka_preprocess_node(&$variables) {
  if($variables['node']->type  == 'content_page'){
	drupal_add_js(drupal_get_path('theme', 'eureka') . '/menu.js', 'theme');
	drupal_add_css(drupal_get_path('theme', 'eureka') . '/g.css');
  }
  $variables['social_links'] = $social_links = module_invoke('widgets', 'block_view', 's_socialmedia_profile-default');
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
}
/**
 * Override or insert variables into the entity template.
 */
function eureka_preprocess_entity(&$variables) {
  $entity_type = $variables['elements']['#entity_type'];
  $entity = $variables['elements']['#entity'];
  list(, , $bundle) = entity_extract_ids($entity_type, $entity);
  // Add suggestions.
  $variables['theme_hook_suggestions'][] = $entity_type;
  $variables['theme_hook_suggestions'][] = $entity_type . '__' . $bundle;
  $variables['theme_hook_suggestions'][] = $entity_type . '__' . $bundle . '__' . $variables['view_mode'];
  if ($id = entity_id($entity_type, $entity)) {
    $variables['theme_hook_suggestions'][] = $entity_type . '__' . $id;
  }
}

/**
 * Implements theme_preprocess_block
 */
 function eureka_preprocess_block(&$vars) {

   switch ($vars['block']->delta) {
    case 'top-component-s001':
      $vars['theme_hook_suggestions'][] = 'jo_banners_s001';
       break;
   case 'jo-need-help':
      $vars['theme_hook_suggestions'][] = 'jo_commerce_cart_need_help';
    default:
       break;
   }

  if (module_exists('jo_core')) {
    if (in_array(str_replace('-hero', '', $vars['block']->delta), jo_core_get_product_list_heros())) {
      $vars['theme_hook_suggestions'][] = 'jo_core_plp_hero';
      $vars['plp_id'] = str_replace("-", "_", $vars['block']->delta);
    }
  }

}


function eureka_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Adding the title of the current page to the breadcrumb.
    $breadcrumb[] = drupal_get_title();
    $output = '<div class="breadcrumb">' . implode(' › ', $breadcrumb) . '</div>';
  }

  if(arg(0) == 'search-no-results') {
    return '';
  }

  return $output;
}



/*  hide facet counts */
function eureka_facetapi_link_inactive($variables) {
  // Builds accessible markup.
  // @see http://drupal.org/node/1316580
  $accessible_vars = array(
    'text' => $variables['text'],
    'active' => FALSE,
  );
  $accessible_markup = theme('facetapi_accessible_markup', $accessible_vars);

  // Sanitizes the link text if necessary.
  $sanitize = empty($variables['options']['html']);
  $variables['text'] = ($sanitize) ? check_plain($variables['text']) : $variables['text'];

  // Adds count to link if one was passed.
  /*if (isset($variables['count'])) {
    $variables['text'] .= ' ' . theme('facetapi_count', $variables);
  }*/

  // Resets link text, sets to options to HTML since we already sanitized the
  // link text and are providing additional markup for accessibility.
  $variables['text'] .= $accessible_markup;
  $variables['options']['html'] = TRUE;
  return theme_link($variables);
}


/**
 * Theme a list of sort options.
 *
 * @param array $variables
 *   An associative array containing:
 *   - items: The sort options
 *   - options: Various options to pass
 */
function eureka_search_api_sorts_list(array $variables) {
  $items = array_map('render', $variables['items']);
  $options = $variables['options'];

  return $items ? theme('item_list', array('items' => $items) + $options) : '';
}


/**
 * Theme a single sort item.
 *
 * @param array $variables
 *   An associative array containing:
 *   - name: The name to display for the item.
 *   - path: The destination path when the sort link is clicked.
 *   - options: An array of options to pass to l().
 *   - active: A boolean telling whether this sort filter is active or not.
 *   - order_options: If active, a set of options to reverse the order
 * @return string
 */
function eureka_search_api_sorts_sort(array $variables) {

  $name = $variables['name'];
  $path = $variables['path'];
  // force order for sorts.
  if ($name == 'Newest' || $name == 'Lowest Price' || $name == 'Highest Price') {
    $order = ($name == 'Lowest Price' || $name == 'Newest') ? 'asc' : 'desc';
    $iorder = ($order == 'desc') ? 'asc' : 'desc';

    if (!empty($variables['order_options']['query'])) {
      $variables['order_options']['query']['order'] = $order;
    }
    if (!empty($variables['options']['query'])) {
      $variables['options']['query']['order'] = $order;
    }
    foreach (array('options','order_options') as $value) {
      if (isset($variables[$value]['attributes']['class']['sort-'.$iorder]) ) {
        unset($variables[$value]['attributes']['class']['sort-'.$iorder]);
        $variables[$value]['attributes']['class'][] = 'sort-'.$order;
      }
    }
   }

  $options = $variables['options'] + array('attributes' => array());
  $options['attributes'] += array('class' => array());

  $order_options = $variables['order_options'] + array('query' => array(), 'attributes' => array(), 'html' => TRUE);
  $order_options['attributes'] += array('class' => array());



  if ($variables['active']) {
    $return_html = '<span class="search-api-sort-active">';
    $return_html .= l(t($name) . theme('tablesort_indicator', array('style' => $order_options['query']['order'])), $path, $order_options);
    $return_html .= '</span>';
  }
  else {
    $return_html = l($name, $path, $options);
  }

  return $return_html;
}




function eureka_form_alter(&$form, &$form_state, $form_id) {

  $is_add_to_cart_form = strpos($form_id, 'commerce_cart_add_to_cart_form');
  $is_add_to_cart_form_incompare = strpos($form_id, 'jo_commerce_product_comparison_add_product_to_cart_form');

  if ($is_add_to_cart_form !== false ) {
    $form['submit']['#isAddtoCart'] = TRUE;
  }




  if ($form_id == 'views_form_commerce_cart_form_default' ) {
    $form['actions']['submit']['#isUpCart'] = TRUE;
  }


  if ($is_add_to_cart_form_incompare !== false) {
    if ($form['add_to_cart']['#type'] == 'submit') {
      $form['add_to_cart']['#isAddtoCart'] = TRUE;
    }
  }
}


function eureka_button($variables) {

  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
  $button = '';
  // force to use BUTTON html tag in Add to Cart form
  if (isset($element['#isAddtoCart'])) {
    $tag = 'button';
    //if it's search results product tile
    if($element['#button_type'] == "submit")
    {
        $element['#attributes']['class'][] = 'button secondary wg circle-button arrow';
    }
    //else it's Update cart button
    else {
        $element['#attributes']['class'][] = 'button secondary wg plus circle-button cart circle-only-mobile';
    }
    //form-submit button secondary wg plus circle-button cart
    $after = $element['#value'];
    $button = '<'.$tag . drupal_attributes($element['#attributes']) .'>'. $after.'</button>' ;
  } elseif (isset($element['#isUpCart'])) {
    $tag = 'button';
    $element['#attributes']['class'][] = 'button secondary wg';
    $after = $element['#value'];
    $button = '<'.$tag . drupal_attributes($element['#attributes']) .'>'. $after.'</button>' ;
  }

  else {
    $tag = 'input';
    $after = '';
    $button = '<'.$tag . drupal_attributes($element['#attributes']) .'>'. $after;
  }
    return $button;

}

/**
 *
 * @param type $variables
 * @return type
 */
function eureka_checkbox($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'checkbox';

  $label = (isset($element['#attributes']['label'])) ? $element['#attributes']['label'] : '';
  unset($element['#attributes']['label']);
  element_set_attributes($element, array('id', 'name', '#return_value' => 'value',));

  // Unchecked checkbox has #value of integer 0.
  if (!empty($element['#checked'])) {
    $element['#attributes']['checked'] = 'checked';
  }
  _form_set_class($element, array('form-checkbox'));

  return '<div class="check-box"><input' . drupal_attributes($element['#attributes']) . ' /> <span class="mask"></span><label for="'.$element['#id'].'">'.$label.'</label></div>';
}


/**
 * Returns HTML for the deactivation widget.
 *
 * @param $variables
 *   An associative array containing the keys 'text', 'path', and 'options'. See
 *   the l() function for information about these variables.
 *
 * @see l()
 * @see theme_facetapi_link_active()
 *
 * @ingroup themable
 */
function eureka_facetapi_deactivate_widget($variables) {
  return '<span class="icon icon-icon-close"></span>';
}


/**
 * Theme function for the view_load_more_pager theme hook.  Based loosely on
 * theme_pager, outputs markup needed for the Load More pager.
 */
function eureka_views_load_more_pager($vars) {
  global $pager_page_array, $pager_total;

  $tags = $vars['tags'];
  $element = $vars['element'];
  $parameters = $vars['parameters'];
  $pager_classes = array('pager', 'pager-load-more');

  $li_next = theme('pager_next',
    array(
      'text' => (isset($tags[3]) ? $tags[3] : t($vars['more_button_text'])),
      'element' => $element,
      'interval' => 1,
      'parameters' => $parameters,
    )
  );

  if (empty($li_next)) {
    $li_next = empty($vars['more_button_empty_text']) ? '&nbsp;' : t($vars['more_button_empty_text']);
    $pager_classes[] = 'pager-load-more-empty';
  }
  // Compatibility with tao theme's pager
  elseif (is_array($li_next) && isset($li_next['title'], $li_next['href'], $li_next['attributes'], $li_next['query'])) {
    $li_next = l($li_next['title'], $li_next['href'], array('attributes' => $li_next['attributes'], 'query' => $li_next['query']));
  }

  if ($pager_total[$element] > 1) {
    $items[] = array(
      'class' => array('pager-next show-more-cta'),
      'data' => $li_next,
    );
    return theme('item_list',
      array(
        'items' => $items,
        'title' => NULL,
        'type' => 'ul',
        'attributes' => array('class' => $pager_classes),
      )
    );
  }
}

function eureka_pager_link($variables) {
  $text = $variables['text'];
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];
  // add custom JO classes
  $attributes['class'][] = 'show-more-link show-link';

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, array());
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  // Set each pager link title
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = array(
        t('« first') => t('Go to first page'),
        t('‹ previous') => t('Go to previous page'),
        t('next ›') => t('Go to next page'),
        t('last »') => t('Go to last page'),
      );
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    elseif (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', array('@number' => $text));
    }
  }
  // @todo l() cannot be used here, since it adds an 'active' class based on the
  //   path only (which is always the current path for pager links). Apparently,
  //   none of the pager links is active at any time - but it should still be
  //   possible to use l() here.
  // @see http://drupal.org/node/1410574
  $attributes['href'] = url($_GET['q'], array('query' => $query));
  return '<a' . drupal_attributes($attributes) . '>' . check_plain($text) . '</a>';
}

/*function eureka_block_view_alter(&$data, $block) {

    if(find_comonent_name_block($block->delta,'_wr')) {
        if (is_array($data['content'])) {
            $data['content']['#prefix'] = '<div class="my-class">';
            $data['content']['#suffix'] = '</div>';
        } else {
            $data['content'] = '<div class="my-class">' . $data['content'] . '</div>';
        }
    }
}

function find_comonent_name_block($delta,$component){
    return strpos($delta,$component);
}*/
