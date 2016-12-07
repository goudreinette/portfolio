<?php function thb_iconbox( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_iconbox', $atts );
  extract( $atts );
    
 	$out ='';
	ob_start();
	$element_id = 'thb-iconbox-' . mt_rand(10, 99);
	$link = vc_build_link($link);
	$el = 'div';
	if($link['url']) {
		$el = 'a';
		$el_class[] = 'has-link';
	}
	$el_class[] = 'thb-iconbox';
	$el_class[] = $type;
	
	$description = vc_value_from_safe( $description );
	$description = nl2br( $description );
	
	$image = '';
	if ($bg_image) {
		$image = wp_get_attachment_image_src( $bg_image, 'full' );
	}
	?>
	<<?php echo esc_attr($el); ?> id="<?php echo esc_attr($element_id); ?>" class="<?php echo implode(' ', $el_class); ?>" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>">
		<?php if ($type == 'top type3') {?>
		<span class="thb-iconbox-bg" style="background-image:url(<?php echo esc_attr($image[0]); ?>)"></span>
		<?php } ?>
		<figure>
			<?php get_template_part( 'assets/svg/'.$icon ); ?>
		</figure>
		<div class="iconbox-content">
			<?php if ($heading) { ?><h5><?php echo esc_html($heading); ?></h5><?php } ?>
			<?php echo wp_kses_post(wpautop($description)); ?>
		</div>
	</<?php echo esc_attr($el); ?>>
	<?php
	
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	   
	return $out;
}
thb_add_short('thb_iconbox', 'thb_iconbox');