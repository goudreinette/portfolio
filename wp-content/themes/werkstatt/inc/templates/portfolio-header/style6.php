<div class="thb-fixed">
	<header class="portfolio-title style6 entry-header">
		<div class="row max_width">
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
	<div class="sticky-content-spacer"></div>
</div>
