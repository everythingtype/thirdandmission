<div class="brick <?php ybca_wrapper_style(); ?>">
	<?php if ( get_field('cover') && !in_category_or_subcategory_of('events') ) : ?>
		<div class="coveritem"><div class="coverinner">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">3rd &amp; Mission <span><?php the_title(); ?></span></a></h3>

			<?php if ( has_post_thumbnail() ) : ?>
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_ybca_thumbnail(); ?></a></p> 
			<?php endif; ?>

		</div>
		<div class="topnotch"></div><div class="bottomnotch"></div>
		</div>
	<?php else : ?>
	<?php $comments_count = wp_count_comments( get_the_ID() ); ?>
	<div class="item <?php if ( in_category_or_subcategory_of('events') ) echo 'eventitem'; ?>">

		<div class="iteminner">

		<?php if ( $comments_count->approved > 0 ) : ?>
			<div class="corner <?php ybca_corner_color(); ?>"><p><?php echo $comments_count->approved; ?></p></div>
		<?php endif; ?>

		<?php if ( has_tag('art') && has_post_thumbnail() ) : ?>
			<p class="thumbnail"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_ybca_thumbnail(true); ?></a></p> 

		<?php elseif ( has_tag('video') ) : ?>
			<?php the_content(); ?>
		<?php else : ?>

			<?php if ( has_post_thumbnail() ) : ?>
				<p class="thumbnail"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_ybca_thumbnail(); ?></a></p> 
			<?php endif; ?>

			<?php if ( in_category_or_subcategory_of('events') ) : ?>
				<p class="meta">Event <?php if ( get_field('date_range') ) : ?>&bull; <?php the_field('date_range'); ?><?php endif; ?></p>
			<?php elseif ( has_tag('text') ) : ?>
				<p class="meta">Text &bull; <?php the_time('j/n/y'); ?></p>
			<?php elseif ( has_tag('exhibition') ) : ?>
				<p class="meta">Exhibition <?php if ( get_field('date_range') ) : ?>&bull; <?php the_field('date_range'); ?><?php endif; ?></p>
			<?php endif; ?>

			<h3 class="<?php if ( $comments_count->approved > 0 ) echo 'hascomments '; if ( get_field('subtitle') ) echo 'withsubtitle ' ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

			<?php if ( get_field('subtitle') ) : ?><p class="subtitle"><?php the_field('subtitle'); ?></p><?php endif; ?>
			<?php the_excerpt(); ?>

		<?php endif; ?>

		</div>

		<?php get_template_part('parts/metas'); ?>

	</div>
	<?php endif; ?>
</div>