
<?php 
	$theThing = $content['field_sub_section_type']['#items'][0]['value'];
	$subSectionType = strtolower($theThing);
	if ($subSectionType == "hero"){
		unset($content['field_hero_section']['#prefix']);
		unset($content['field_hero_section']['#suffix']);
		if (isset($content) && $content['field_hero_section']) { print render($content['field_hero_section']); }
	}
?>