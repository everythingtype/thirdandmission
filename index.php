<?php get_header(); ?>

		<div class="gridblock">

		
		<?php if ( !is_home() ) :?>
		<div class="pagetitle">
			<?php if ( is_category()  || is_tag() ) : ?>
				<h2><?php single_cat_title(); ?></h2>
			<?php elseif ( is_archive() ) :?>
				<h2><?php echo the_time('Y'); ?></h2>
			<?php endif; ?>

			<?php if ( is_category() && !is_paged() )  wrapped_category_description(); ?>

		</div>
		<?php endif; ?>

		<?php
		
		if ( is_category('recent') ) :
		
			$recentArgs = array(
				'category__in' => 0,
				'posts_per_page' => -1
			);
		
			query_posts( $recentArgs );

		endif;

		?>

		<?php if (have_posts()) : ?>

			<div class="masonry">

			<?php while (have_posts()) : the_post(); ?>
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
						<?php if ( $comments_count->approved > 0 ) : ?>
							<div class="corner <?php ybca_corner_color(); ?>"><p><?php echo $comments_count->approved; ?></p></div>
						<?php endif; ?>

						<?php if ( has_post_thumbnail() ) : ?>
							<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_ybca_thumbnail(); ?></a></p> 
						<?php endif; ?>

						<?php if ( has_tag('art') || has_tag('video') ) : ?>
							<?php the_content(); ?>
						<?php else : ?>

							<?php if ( in_category_or_subcategory_of('events') ) : ?>
								<p class="meta">Event <?php if ( get_field('date_range') ) : ?>&bull; <?php the_field('date_range'); ?><?php endif; ?></p>
							<?php elseif ( has_tag('text') ) : ?>
								<p class="meta">Text &bull; <?php the_time('j/n/y'); ?></p>
							<?php elseif ( has_tag('exhibition') ) : ?>
								<p class="meta">Exhibition <?php if ( get_field('date_range') ) : ?>&bull; <?php the_field('date_range'); ?><?php endif; ?></p>
							<?php endif; ?>

							<h3 <?php if ( $comments_count->approved > 0 ) echo 'class="hascomments"'; ?>><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

							<?php if ( get_field('subtitle') ) : ?><p class="subtitle"><?php the_field('subtitle'); ?></p><?php endif; ?>
							<?php the_excerpt(); ?>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>

			</div>

		<?php else : ?>
			<p>Page not found.</p>
		<?php endif; ?>
	</div>

	</div>

<?php get_footer(); ?>