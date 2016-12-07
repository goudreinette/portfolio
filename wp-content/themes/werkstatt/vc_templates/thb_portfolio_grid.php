<?php function thb_portfolio_grid( $atts, $content = null ) {
	$filter_style = 'style1';
	$style = 'style1';
  $atts = vc_map_get_attributes( 'thb_portfolio_grid', $atts );
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
	
	if ( have_posts() ) { ?>
		<?php do_action('thb-render-filter', $filter_categories_array, $rand, $filter_style ); ?>
		<div class="row expanded<?php if ($thb_margins !== 'margins') { ?> no-padding<?php } else { ?> thb-margins<?php }?> thb-portfolio masonry" id="portfolio-section-<?php echo esc_attr($rand); ?>" data-filter="thb-filter-<?php echo esc_attr($rand); ?>">
			<?php while ( have_posts() ) : the_post(); // start of the loop
				set_query_var( 'thb_hover_style', $hover_style);
				$column_size = thb_get_portfolio_size('grid', $i);
				set_query_var( 'thb_size', $columns .' '. $column_size );
				set_query_var( 'thb_title_position', $title_position);
				set_query_var( 'thb_animation', 'thb-animate-from-bottom' );
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
thb_add_short('thb_portfolio_grid', 'thb_portfolio_grid');