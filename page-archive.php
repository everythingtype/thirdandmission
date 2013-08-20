<?php 
/* Template Name: Archive page */

get_header(); ?>

	<div class="pagetitle">
		<h2><?php the_title(); ?></h2>
	</div>

		<ul class="archive">
		<?php wp_get_archives(array( 
			'type' => 'yearly',
			'before' => '<li><span class="item"><span class="corner black"></span>',
			'after' => '</span></li>' )); ?>
		</ul>

<?php get_footer(); ?>