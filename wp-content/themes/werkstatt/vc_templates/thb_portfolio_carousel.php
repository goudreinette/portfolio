<?php function thb_portfolio_carousel( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_portfolio_carousel', $atts );
  extract( $atts );
  $portfolio_id_array = explode(',', $portfolio_ids);

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
		<div class="swiper-container full-page thb-portfolio carousel" id="portfolio-section-<?php echo esc_attr($rand); ?>">
		   <div class="swiper-wrapper">
				<?php while ( have_posts() ) : the_post(); // start of the loop
					set_query_var( 'thb_size', 'small-12 medium-6 '. $columns );
					set_query_var( 'thb_title_position', 'title-center');
					set_query_var( 'thb_hover_style', $hover_style);
					get_template_part( 'inc/templates/portfolio/'.$style );
				$i++; endwhile; // end of the loop. ?>
			</div>
			<?php do_action('thb_swiper_nav', $style); ?>
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
thb_add_short('thb_portfolio_carousel', 'thb_portfolio_carousel');