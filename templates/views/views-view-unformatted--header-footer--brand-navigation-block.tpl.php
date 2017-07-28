<?php 
$cart_teaser = module_invoke('jo_ajax_add_cart', 'block_view', 'ajax_shopping_cart_teaser');
$vars = array('jo-search-text-classes' => 'CLASSS' , 'jo-search-submit-classes' => 'CLASSSEESSSS', 'placeholder'=>t('What are you looking for?'));
$search_form = theme('jo_search_form', array('vars'=> $vars));
?>
<div class="navigation-menu">
	<div class="section-full-width">
		<div class="section-padding">
			<div class="eureka-menu row">
				<div class="siteLogo col-xs-5 col-sm-3">
					<a href="/" title="<?php print variable_get('site_name', "Default site name"); ?>">
					<?php

						$logopublic = theme_get_setting('logo_path');
						$logo = null;
						if(!empty($logopublic)){
							$logo = file_create_url($logopublic);
						}
						if (empty($logo)) {
							print '<img src="' .  base_path()  .  path_to_theme() . '/logo.png" alt="'.variable_get('site_name', "Default site name").'" />';
						}
						else {
							print '<img src="' . $logo . '" alt="'.variable_get('site_name', "Default site name").'" />'; // this prints out path to you uploaded logo
						}
					?>
					</a>
				</div>

				<div class="mobileNav col-xs-7 col-sm-9 col-lg-4">
					<div class="mobileNav_container row">
						<a href="#" class="mobileNav__btn mobileNav__search icon-icon-search icon col-xs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></a>
						<!--<a  href="/cart" class="mobileNav__btn mobileNav__cart col-xs-4 icon-icon-cart"><span class="count">3</span></a>-->
						<?php print render($cart_teaser['content']);?>
						<span class="mobileNav__btn mobileNav__trigger col-xs-4 icon-icon-menu"></span>
					</div>
				</div>
				<div class="nav__menu col-xs-12 col-md-6 col-lg-6">
					<ul>
						<?php
							//Get the navigation node
							$query = new EntityFieldQuery();
								$node = $query->entityCondition('entity_type', 'node')
								->propertyCondition('type', 'header_footer')
								->execute();

							//Get the node ID
							$nid = $query->ordered_results[0]->entity_id;

							//Wrap node with Entity API
							$node_wrapper = entity_metadata_wrapper('node', $nid);

							//Get items from utility nav or global nav
							$ItemsUtilityLvl1 = $node_wrapper->field_global_navigation_link->value();

							//Get items from level 1
							$itemsLvl1 = $node_wrapper->field_brand_navigation_link->value();

							//Build the items
							foreach ($itemsLvl1 as $index => $itemLvl1){

								$itemsLvl2 = $node_wrapper->field_brand_navigation_link[$index]->field_brand_child_link->value();
								$subChilds = '';

								//Build the items second level
								foreach ($itemsLvl2 as $index2 => $itemLvl2){

									$subChilds2 = '';


									if($itemLvl2->field_brand_sub_child){
										$itemsLvl3Pic = file_create_url($itemLvl2->field_child_background_image['und'][0]['uri']);
										$subChilds2 = '<div class="nav__submenu nav__tertiary"><div class="navSelected__title">'.$itemLvl2->field_bn_link['und'][0]['title'].'</div><ul><li class="back nav__tertiary_back">Back</li>';
										$itemsLvl3 = $itemLvl2->field_brand_sub_child['und'];

										//Build the items third level
										foreach ($itemsLvl3 as $index3 => $itemLvl3) {
											$subChilds2 .= '<li class="child__lvl2"><a href="'.$itemLvl3['url'].'">'.$itemLvl3['title'].'</a></li>';
										}

										$subChilds2 .= '</ul><div class="element__pic"><a href="'.$itemLvl3['url'].'"><img src="'.$itemsLvl3Pic.'" /></a></div></div>';
									}

									if($itemLvl2->field_bn_link){
										$subChilds .= '<li class="child__lvl1"><a href="'.$itemLvl2->field_bn_link['und'][0]['url'].'">';
										$subChilds .= $itemLvl2->field_bn_link['und'][0]['title'];
										$subChilds .= '</a>';
										$subChilds .= $subChilds2;
										$subChilds .= '</li>';
									}
								}

								$html  = '<li><a class="dropdown" href="'.$itemLvl1->field_bn_main_link['und'][0]['url'].'">';
								$html .= $itemLvl1->field_bn_main_link['und'][0]['title'];
								$html .= '</a>';
								$html .= '<div class="nav__submenu nav__secondary"><div class="navSelected__title">'.$itemLvl1->field_bn_main_link['und'][0]['title'].'</div><ul><li class="back nav__secondary_back">Back</li>'.$subChilds.'</ul></div>';
								$html .= '</li>';

								echo $html;
							}
						?>
						<?php
							//Check if utility nav has items and show it
							if(!empty($ItemsUtilityLvl1)){
							?>
							<li class="visible-xs visible-sm subNavMobile">
								<span>Shop by Brand</span>
								<ul class="subnav">
									<?php
									//Build the items
									foreach ($ItemsUtilityLvl1 as $index => $ItemUtilityLvl1){

										$itemsLvl2 = $node_wrapper->field_global_navigation_link[$index]->field_child_link->value();
										$subChilds = '';

										//Build the items second level
										foreach ($itemsLvl2 as $index2 => $itemLvl2){

											$subChilds2 = '';


											if (isset($itemLvl2->field_child_link)) {
												//$itemsLvl3Pic = file_create_url($itemLvl2->field_child_background_image['und'][0]['uri']);
												$subChilds2 = '<div class="nav__submenu nav__tertiary"><div class="navSelected__title">'.$itemLvl2->field_bn_link['und'][0]['title'].'</div><ul><li class="back nav__tertiary_back">Back</li>';
												$itemsLvl3 = $itemLvl2->field_child_link['und'];

												//Build the items third level
												foreach ($itemsLvl3 as $index3 => $itemLvl3) {
													$subChilds2 .= '<li class="child__lvl2"><a href="'.$itemLvl3['url'].'">'.$itemLvl3['title'].'</a></li>';
												}

												//$subChilds2 .= '</ul><div class="element__pic"><img src="'.$itemsLvl3Pic.'" /></div></div>';
											}

											if($itemLvl2->field_link){

												//Check if come logo images to add or not on nav
												if($itemLvl2->field_child_image) {
													$subChilds .= '<li class="child__lvl1 utility-logos"><a href="'.$itemLvl2->field_link['und'][0]['url'].'">';
													$subChilds .= "<img src='" . file_create_url($itemLvl2->field_child_image['und'][0]['uri']) . "'>";
												}else{
													$subChilds .= '<li class="child__lvl1"><a href="'.$itemLvl2->field_link['und'][0]['url'].'">';
													$subChilds .= $itemLvl2->field_cl_title['und'][0]['title'];
												}
												$subChilds .= '</a>';
												$subChilds .= $subChilds2;
												$subChilds .= '</li>';
											}
										}

										$html  = '<li><a class="dropdown" href="'.$ItemUtilityLvl1->field_gn_link['und'][0]['url'].'">';
										$html .= $ItemUtilityLvl1->field_gn_link['und'][0]['title'];
										$html .= '</span></a>';
										$html .= '<div class="nav__submenu nav__secondary"><div class="navSelected__title">'.$ItemUtilityLvl1->field_gn_link['und'][0]['title'].'</div><ul><li class="back nav__secondary_back">Back</li>'.$subChilds.'</ul></div>';
										$html .= '</li>';

										echo $html;
									}
								?>
								</ul>
							</li>
						<?php } ?>
						<li class="visible-xs visible-sm subNavMobile">
							<span>Account</span>
							<ul class="subnav">
								<li>
									<a href="#">Sign in</a>
								</li>
								<li>
									<a  href="#" class="dropdown">Language Selector</a>
									<div class="nav__submenu nav__secondary">
										<div class="navSelected__title">Language Selector</div>
										<ul>
											<li class="back nav__secondary_back">Back</li>
											<li class="child__lvl1"><a href="#">USA | English</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>

				<div class="searchBox col-xs-12 col-md-3">
            <?php print $search_form ?>
				</div>

			</div>
		</div>
	</div>
</div>
