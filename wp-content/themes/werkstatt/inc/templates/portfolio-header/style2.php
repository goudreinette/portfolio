<figure class="post-gallery parallax">
	<?php 
		$image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id, 'full'); 
		$portfolio_header_bg_type = get_post_meta(get_the_ID(), 'portfolio_header_bg_type', true);
		$portfolio_header_video = get_post_meta(get_the_ID(), 'portfolio_header_video', true);
	?>
	<?php if ($portfolio_header_bg_type === 'video' && $portfolio_header_video !== '') { 
		do_action('thb_portfolio_video', $portfolio_header_video);
	?>
		 
	<?php } else { ?>
	<div class="parallax_bg" 
				data-top-bottom="transform: translate3d(0px, 40%, 0px);"
				data-top="transform: translate3d(0px, 0%, 0px);"
				style="background-image: url(<?php echo esc_html($image_url[0]); ?>);"></div>
	<?php } ?>
	<?php if (get_post_meta(get_the_ID(), 'portfolio_header_arrow', true) !== 'off') { ?>
	<div class="scroll-bottom"><div></div></div>
	<?php } ?>
</figure>
<header class="portfolio-title style2 entry-header">
	<div class="row">
		<div class="small-12 columns">
			<?php the_title('<h1 class="entry-title" itemprop="name headline">', '</h1>'); ?>
			<?php if ($portfolio_subtitle = get_post_meta(get_the_ID(), 'portfolio_subtitle', true)) { ?>
				<h4><?php echo esc_html($portfolio_subtitle); ?></h4>
			<?php } ?>
			<?php if (has_excerpt()) { the_excerpt(); } ?>
			<?php if (get_post_meta(get_the_ID(), 'portfolio_header_attributes', true) !== 'off') { do_action( 'thb_portfolio_attributes'); } ?>
		</div>
	</div>
</header>