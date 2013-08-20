<?php 

if ( get_field('cover') ) :

	$category_id = get_field('cover_category');

	if ( $category_id ) :

		$category_link = get_category_link( $category_id );

		wp_redirect($category_link, 301);
	
		exit;

	endif;

endif;

get_header(); ?>
		
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php if ( in_category_or_subcategory_of('journal') ) : 
			$post_categories = wp_get_post_categories($post->ID);
			
			
			foreach($post_categories as $post_category) :
				$category = get_category( $post_category );
				$categoryID = $category->term_id; ?>
				<div class="pagetitle">
				<h2><a href="<?php echo get_category_link( $categoryID ); ?>"><?php echo $category->name; ?></a></h2>
				<?php 
				wrapped_category_description($categoryID); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>

		<div class="metablock">
			<?php get_template_part('parts/metas'); ?>

			<?php $comments_count = wp_count_comments( get_the_ID() ); if ( $comments_count->approved > 0 ) : ?>
				<p class="commentcount"><?php echo $comments_count->approved; ?></p>
			<?php endif; ?>

			<?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
			<?php exclude_post_categories('recent') ?>

<?php if ( lessThanOneTwentyDays( get_post_time('U') ) ) : ?>
 	<ul><li><a href="/recent">Recent</a></li></ul>
<?php endif; ?>

		</div>


		<div id="content" class="single">
			<h3 <?php if ( get_field('subtitle') ) echo 'class="withsubtitle"' ?> ><?php the_title(); ?></h3>

			<?php if ( get_field('subtitle') ) : ?>
				<p class="subtitle"><?php the_field('subtitle'); ?></p>
			<?php endif; ?>

			<?php the_content(); ?>
		</div>


	<?php endwhile; ?>

<?php else : ?>
	<p>Page not found.</p>
<?php endif; ?>

<?php get_footer(); ?>