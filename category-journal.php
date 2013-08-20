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

					<div class="brick <?php ybca_wrapper_style(); ?>">
						<?php $comments_count = wp_count_comments( get_the_ID() ); ?>
						<div class="item">

							<?php if ( $comments_count->approved > 0 ) : ?>
								<div class="corner <?php ybca_corner_color(); ?>"><p><?php echo $comments_count->approved; ?></p></div>
							<?php endif; ?>

							<?php if ( has_post_thumbnail() ) : ?>
								<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_ybca_thumbnail(); ?></a></p> 
							<?php endif; ?>

							<?php if ( has_tag('art') || has_tag('video') ) : ?>
								<?php the_content(); ?>
							<?php else : ?>

								<?php if ( has_tag('text') ) : ?>
									<p class="meta">Text &bull; <?php the_time('j/n/y'); ?></p>
								<?php elseif ( has_tag('exhibition') ) : ?>
									<p class="meta">Exhibition <?php if ( get_field('date_range') ) : ?>&bull; <?php the_field('date_range'); ?><?php endif; ?></p>
								<?php endif; ?>						

								<h3 <?php if ( $comments_count->approved > 0 ) echo 'class="hascomments"'; ?>><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

								<?php if ( get_field('subtitle') ) : ?><p class="subtitle"><?php the_field('subtitle'); ?></p><?php endif; ?>
								<?php the_excerpt(); ?>
							<?php endif; ?>

						</div>

					</div>

		    	<?php endwhile; ?> 

				</div>

			<?php endif; ?>
		
			</div>
		
		<?php endforeach; ?>



<?php get_footer(); ?>