<div class="small-12 medium-10 large-9 columns">
	<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style2'); ?> role="article">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-gallery">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('werkstatt-blog-large'); ?>
			</a>
		</figure>
		<?php } ?>
		<div class="blog-post-container">
			<aside class="post-category">
				<?php the_category(', '); ?>
			</aside>
			<header class="post-title entry-header">
				<?php the_title('<h2 class="entry-title" itemprop="name headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h2>'); ?>
			</header>
			<aside class="post-meta">
				<?php the_author_posts_link(); ?> <?php esc_html_e('on', 'werkstatt'); ?> <?php echo get_the_date(); ?>
			</aside>
		</div>
	</article>
</div>