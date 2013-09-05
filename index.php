<?php get_header(); ?>

		<div class="gridblock">

		
		<?php if ( !is_home() ) :?>
		<div class="pagetitle">
			<?php if ( is_category()  || is_tag() ) : ?>
				<h2><?php single_cat_title(); ?></h2>
			<?php elseif ( is_archive() ) :?>
				<h2><?php echo the_time('Y'); ?></h2>
			<?php elseif ( is_search() ) :?>
				<h2>&ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>
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
				<?php get_template_part('parts/brick'); ?>
			<?php endwhile; ?>

			</div>

		<?php else : ?>
			<p>Page not found.</p>
		<?php endif; ?>
	</div>

	</div>

<?php get_footer(); ?>