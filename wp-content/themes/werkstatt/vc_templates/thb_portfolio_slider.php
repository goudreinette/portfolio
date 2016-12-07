<?php function thb_portfolio_slider( $atts, $content = null ) {
	$thb_subtitles = $thb_header_colors = $slider_style = '';
	$slider_style = 'slider_style1';
  $atts = vc_map_get_attributes( 'thb_portfolio_slider', $atts );
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
 	
 	$arrow_style = $slider_style === 'slider_style2' ? 'arrow-style2' : '';
 	$classes[] = 'swiper-container full-page thb-portfolio carousel slider';
 	$classes[] = $slider_style;
 	$classes[] = $thb_header_colors;
 	$classes[] = $arrow_style;
 	
 	ob_start();
 	
	$portfolios = array();
	if ( have_posts() ) { ?>
		<div class="<?php echo implode(' ', $classes); ?>" id="portfolio-section-<?php echo esc_attr($rand); ?>">
		   <div class="swiper-wrapper">
				<?php while ( have_posts() ) : the_post(); // start of the loop
					set_query_var( 'thb_button_style', $button_style);
					set_query_var( 'thb_subtitles', $thb_subtitles);
					if ($slider_style === 'slider_style2') {
						get_template_part( 'inc/templates/portfolio/style5' );
					} else {
						get_template_part( 'inc/templates/portfolio/style4' );
					}
					$portfolios[] = array(
						'title' => get_the_title()
					);
				$i++; endwhile; // end of the loop. ?>
				</div>
				<?php if ($slider_style !== 'slider_style2') { do_action('thb_swiper_pagination'); } else { do_action('thb_swiper_nav', $arrow_style);}?>
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
thb_add_short('thb_portfolio_slider', 'thb_portfolio_slider');