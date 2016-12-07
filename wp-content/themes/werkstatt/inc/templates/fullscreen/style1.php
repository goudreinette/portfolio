<?php 
	$id = get_the_ID();
	$fs_all = get_post_meta($id, 'fs_all', true);
	$fs_slides = get_post_meta($id, 'fs_slides', true);
	$fs_autoplay_speed = get_post_meta($id, 'fs_autoplay_speed', true) ? get_post_meta($id, 'fs_autoplay_speed', true) : 5000;
	$fs_autoplay = get_post_meta($id, 'fs_autoplay', true) == 'on' ? $fs_autoplay_speed : false;
	$total = sizeof($fs_slides);
	$portfolios = array();
?>
<div class="swiper-container full-page style1 thb-portfolio" data-autoplay="<?php echo esc_attr($fs_autoplay); ?>">
   <div class="swiper-wrapper">
		<?php $i = 1; foreach ($fs_slides as $slide) { 
			$id = $slide['portfolio'];
			$image_id = get_post_thumbnail_id($id);
			$image_url = wp_get_attachment_image_src($image_id, 'full');
			
			$main_color = get_post_meta($id, 'main_color', true);
			$main_color_title = get_post_meta($id, 'main_color_title', true);
			
			$categories = get_the_term_list( $id, 'portfolio-category', '', ', ', '' ); 
			if ($categories !== '') {
				$categories = strip_tags($categories);
			}
			
			$title = get_the_title($id);
			
			$main_listing_type = get_post_meta($id, 'main_listing_type', true);
			$permalink = '';
			if ($main_listing_type == 'link') {
				$permalink = get_post_meta($id, 'main_listing_link', true);	
			} else {
				$permalink = get_the_permalink();	
			}
			
			$portfolios[] = array(
				'title' => $title,
				'image_id' => $image_id,
				'cats' => $categories
			);
			
		?>
			<div class="swiper-slide center-contents type-portfolio <?php echo esc_attr($main_color_title); ?>" data-color="<?php echo esc_attr($main_color_title); ?>" style="background-color:<?php echo esc_attr($main_color); ?>">
				<figure class="slider-inner" style="background-image:url(<?php echo esc_attr($image_url[0]); ?>)">
					<figcaption>
						<h1><span><a href="<?php echo esc_attr($permalink); ?>"><?php echo get_the_title($id); ?></a></span></h1>
						<aside class="thb-categories"><span><?php echo esc_html($categories); ?></span></aside>
					</figcaption>
				</figure>
			</div>
		<?php $i++; } ?>
	</div>
	<div class="swiper-navigation">
		<?php get_template_part( 'assets/img/full-screen-up-arrow.svg' ); ?>
		<?php get_template_part( 'assets/img/full-screen-down-arrow.svg' ); ?>
	</div>
	<?php if ($fs_all !== 'off') { ?>
	<a href="#" title="<?php esc_attr('All Projects','werkstatt'); ?>" class="show-all fixed">
		<?php esc_html_e('All Projects','werkstatt'); ?>
	</a>
	<?php } ?>
	<div class="swiper-pagination"></div>
</div>
<?php do_action('thb_show_all', $portfolios); ?>