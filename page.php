<?php 

get_header(); ?>
		

		<?php if (have_posts()) : ?>

			<div class="pagetitle">
				<h2><?php the_title(); ?></h2>
			</div>

			<?php while (have_posts()) : the_post(); ?>
				<div class="single page"><div class="content">
					<?php the_content(); ?>
				</div></div>
			<?php endwhile; ?>

		<?php else : ?>
			<p>Page not found.</p>
		<?php endif; ?>

<?php get_footer(); ?>