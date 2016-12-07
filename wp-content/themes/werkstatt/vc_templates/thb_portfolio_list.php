<?php function thb_portfolio_list( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_portfolio_list', $atts );
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
		<div class="row expanded thb-portfolio thb-list-portfolio <?php echo esc_attr($thb_style); ?>" id="portfolio-section-<?php echo esc_attr($rand); ?>">
			<div class="small-12 medium-6 columns thb-content-side">
				<div class="row align-center">
					<div class="small-12 large-6 columns">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php
								$id = get_the_id();
								$image_id = get_post_thumbnail_id($id);
								$image_url = wp_get_attachment_image_src($image_id, 'full');
								
								$categories = get_the_term_list( $id, 'portfolio-category', '', ', ', '' ); 
								$categories = strip_tags($categories);
								
								$portfolios[] = array(
									'image_url' => $image_url
								);
							?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="type-portfolio <?php if($i == 0) { echo 'active'; } ?>" id="portfolio-<?php the_ID(); ?>">
								<h3><?php the_title(); ?> <span class="next"><?php get_template_part( 'assets/img/general-next.svg' ); ?></span></h3>
								<aside class="thb-categories"><?php echo esc_html($categories); ?></aside>
							</a>
							
						<?php $i++; endwhile; // end of the loop. ?>
					</div>
				</div>
			</div>
			<div class="small-12 medium-6 columns thb-image-side">
				<?php 
					 foreach ($portfolios as $portfolio) {
					 	$image_url = $portfolio["image_url"];
					 	echo '
					 	<div class="portfolio-image" style="background-image:url('. esc_attr($image_url[0]) .')"></div>';
					 }
				?>
			</div>
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
thb_add_short('thb_portfolio_list', 'thb_portfolio_list');