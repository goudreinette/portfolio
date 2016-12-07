<?php

/* Custom Language Switcher */
function thb_language_switcher() {
	$thb_ls = ot_get_option('thb_ls', 'on');
	if ($thb_ls !== 'off') {
		if ( function_exists('icl_get_languages') || $_SERVER['HTTP_HOST'] === 'werkstatt.fuelthemes.net') {
			$permalink = get_permalink();
		?>
		<ul class="thb-full-menu thb-language-switcher">
			<li class="menu-item-has-children">
				<a href="#"><?php
					if ($_SERVER['HTTP_HOST'] === 'werkstatt.fuelthemes.net') {
						$languages = array(
							"en" => array(
								"code" => "en",
								"active" => 1,
								"url" => $permalink,
								"native_name" => "English"
							),
							"fr" => array(
								"code" => "fr",
								"active" => 0,
								"url" => $permalink,
								"native_name" => "Français"
							),
							"de" => array(
								"code" => "de",
								"active" => 0,
								"url" => $permalink,
								"native_name" => "Deutsch"
							)
						);
					} else {
						$languages = icl_get_languages('skip_missing=0');
					}
					
						if(1 < count($languages)){
							foreach($languages as $l){
								echo esc_attr($l['active'] ? $l['code'] : '');
							}
						}
					?></a>
				<ul class="sub-menu" id="thb_language_selector">
				<?php
					if(1 < count($languages)){
						foreach($languages as $l){
							
							if (!$l['active']) {
								echo '<li><a href="'.$l['url'].'" title="'.$l['native_name'].'">'.$l['native_name'].'</a></li>';
							}
						}
					} else {
						echo '<li>'.esc_html__('Add Languages', 'werkstatt').'</li>';	
					}
				?>
				</ul>
			</li>
		</ul>
		<?php 
		}
	}
}
add_action( 'thb_language_switcher', 'thb_language_switcher' );

/* Custom Language Switcher */
function thb_language_switcher_mobile() {
	$thb_ls = ot_get_option('thb_ls', 'on');
	if ($thb_ls !== 'off') {
		if ( function_exists('icl_get_languages') || $_SERVER['HTTP_HOST'] === 'werkstatt.fuelthemes.net') {
			$permalink = get_permalink();
		?>
		<div class="thb-language-switcher" id="thb_language_selector">
			<?php
				if ($_SERVER['HTTP_HOST'] === 'werkstatt.fuelthemes.net') {
					$languages = array(
						"en" => array(
							"code" => "en",
							"active" => 1,
							"url" => $permalink,
							"native_name" => "English"
						),
						"fr" => array(
							"code" => "fr",
							"active" => 0,
							"url" => $permalink,
							"native_name" => "Français"
						),
						"de" => array(
							"code" => "de",
							"active" => 0,
							"url" => $permalink,
							"native_name" => "Deutsch"
						)
					);
				} else {
					$languages = icl_get_languages('skip_missing=0');
				}
				if(1 < count($languages)){
					foreach($languages as $l){
							$class = $l['active'] ? ' class="active"' : '';  
							echo '<a href="'.$l['url'].'"'.$class.' title="'.$l['native_name'].'">'.$l['code'].'</a>';
	
					}
				} else {
					echo esc_html__('Add Languages', 'werkstatt');	
				}
			?>
		</div>
		<?php 
		}
	}
}
add_action( 'thb_language_switcher_mobile', 'thb_language_switcher_mobile' );