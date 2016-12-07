<div class="small-12 medium-6 large-3 columns">
	<div <?php post_class('post style1'); ?>>
		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('werkstatt-blog'); ?>
			</a>
		<?php } ?>
		<header class="post-title entry-header">
			<?php the_title('<h6 class="entry-title" itemprop="name headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h6>'); ?>
		</header>
	</div>
</div>