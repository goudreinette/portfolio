<?php function thb_portfolio_masonry( $atts, $content = null ) {
	$filter_style = 'style1';
	$animation_style = 'thb-animate-from-bottom';
  $atts = vc_map_get_attributes( 'thb_portfolio_masonry', $atts );
  extract( $atts );
  $portfolio_id_array = explode(',', $portfolio_ids);
  $filter_categories_array = $filter_categories ? explode(',',$filter_categories) : false;
  
	$args = array(
		'posts_per_page' => -1, 
		'post_type' =>'portfolio', 
		'post__in' => $portfolio_id_array,
		'orderby' => 'post__in'
	);
 	$posts = query_posts( $args );
 	$rand = rand(0,1000);
 	$i = 0;
 	ob_start();
	
	$classes[] = 'row expanded thb-portfolio masonry';
	$classes[] = $masonry_layout;
	$classes[] = $style;
	$classes[] = $thb_margins == 'margins' ? 'thb-margins' : false;
	if ( have_posts() ) { ?>
		<?php do_action('thb-render-filter', $filter_categories_array, $rand, $filter_style ); ?>
		<div class="<?php echo implode(' ', $classes); ?>" id="portfolio-section-<?php echo esc_attr($rand); ?>" data-thb-animation="<?php echo esc_attr($animation_style); ?>" data-filter="thb-filter-<?php echo esc_attr($rand); ?>">
			<?php while ( have_posts() ) : the_post(); // start of the loop
				set_query_var( 'thb_hover_style', $hover_style);
				if ($style == 'style1') {
					$column_size = thb_get_portfolio_size($masonry_layout, $i);
					set_query_var( 'thb_size', $column_size );
				} else {
					set_query_var( 'thb_size', $columns );
					set_query_var( 'thb_masonry', true );	
				}
				set_query_var( 'thb_title_position', $title_position);
				set_query_var( 'thb_animation', $animation_style );
				get_template_part( 'inc/templates/portfolio/'.$style );
			$i++; endwhile; // end of the loop. ?>
			<?php do_action('thb_portfolio_preloader'); ?>
		</div>	
	<?php } else {
		get_template_part( 'inc/templates/not-found' );
	}

	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	
	wp_reset_query();
	wp_reset_postdata();
     
  return $out;
}
thb_add_short('thb_portfolio_masonry', 'thb_portfolio_masonry');