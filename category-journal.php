<?php get_header(); ?>
		

		<?php
		
		$journalCat = get_category_by_slug('journal'); 
		$journalId = $journalCat->term_id;
		$categories = get_categories( array (
			'child_of'                 => $journalId,
			'orderby'                  => 'name',
			'order'                    => 'DESC'
		) );
				
		?>

		<?php foreach ($categories as $category) : ?>

			<div class="gridblock">

			<div class="pagetitle">
				<h2><?php echo $category->name; ?></h2>
				<?php wrapped_category_description($category->term_id); ?>
			</div>

			<?php query_posts( array ( 'category_name' => $category->slug, 'showposts' => '-1' ) ); ?>

			<?php if ( have_posts() ): ?>

				<div class="masonry">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('parts/brick'); ?>
		    	<?php endwhile; ?> 

				</div>

			<?php endif; ?>
		
			</div>
		
		<?php endforeach; ?>



<?php get_footer(); ?>