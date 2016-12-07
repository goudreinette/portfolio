<?php 
	$id = get_the_ID();
	$fs_all = get_post_meta($id, 'fs_all', true);
	$fs_slides = get_post_meta($id, 'fs_slides', true);
	$total = sizeof($fs_slides);

	$portfolios = array();
?>
<ol class="curtains vertical-deck thb-portfolio">
		<?php $i = 1; if (!empty($fs_slides)) { foreach ($fs_slides as $slide) { 
			$id = $slide['portfolio'];
			$image_id = get_post_thumbnail_id($id);
			$image_url = wp_get_attachment_image_src($image_id, 'full');
			
			$main_color = get_post_meta($id, 'main_color', true);
			$main_color_title = get_post_meta($id, 'main_color_title', true);
			
			$categories = get_the_term_list($id, 'portfolio-category', '', ', ', '' ); 
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
			<li class="vertical-page cover type-portfolio <?php echo esc_attr($main_color_title); ?>" data-color="<?php echo esc_attr($main_color_title); ?>">
				<div class="thb-bg" style="background-image:url(<?php echo esc_attr($image_url[0]); ?>)"></div>
				<div class="thb-container">					
					<h1><a href="<?php echo esc_attr($permalink); ?>"><?php echo get_the_title($id); ?></a></h1>
					<aside class="thb-categories"><?php echo esc_html($categories); ?></aside>
					
				</div>
			</li>
		<?php $i++; } } ?>
</ol>
<div class="swiper-pagination swiper-pagination-fraction">
	<span class="swiper-pagination-current">1</span>
	-
	<span class="swiper-pagination-total"><?php echo sizeof($fs_slides); ?></span>
</div>
<?php if ($fs_all !== 'off') { ?>
<a href="#" title="<?php esc_attr('All Projects','werkstatt'); ?>" class="show-all fixed">
	<?php esc_html_e('All Projects','werkstatt'); ?>
</a>
<?php } ?>
<div class="thb-shadow"></div>
<?php do_action('thb_show_all', $portfolios); ?>