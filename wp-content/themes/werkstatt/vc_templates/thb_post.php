<?php function thb_post( $atts, $content = null ) {
	$style = '';
	$atts = vc_map_get_attributes( 'thb_post', $atts );
	extract( $atts );
	
 	$args = array(
 		'posts_per_page' => $item_count, 
 		'nopaging' => 0, 
 		'post_type'=>'post', 
 		'post_status' => 'publish', 
 		'ignore_sticky_posts' => 1,
 		'no_found_rows' => true
 	);
 	
 	$posts = new WP_Query( $args );
 	$style = $style === '' ? 'style6-alt' : $style;
 	ob_start();
 	?>
 	<div class="row posts-shortcode align-stretch <?php echo esc_attr($style); ?>">
		<?php $i = 0; if ($posts->have_posts()) :  while ($posts->have_posts()) : $posts->the_post(); ?>
			<?php 
			if ($style !== 'style8') { 
				set_query_var( 'columns', $columns );
				get_template_part( 'inc/templates/postbit/'.$style); 
			} else if ($style == 'style8') { 
				set_query_var( 'columns', $style8_columns );
				if ($i == 0) { 
					get_template_part( 'inc/templates/postbit/style8-first'); 
				} else {
					get_template_part( 'inc/templates/postbit/style8'); 
				}
			}
			?>
		<?php $i++; endwhile; else : endif; ?>
	</div>
	<?php
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	
	wp_reset_query();
	wp_reset_postdata();
	 
	return $out;
}
thb_add_short('thb_post', 'thb_post');