<div class="metablock">
	<p><strong>Date</strong><br />
	<?php 
		if ( get_field('date_range') ) : 
			the_field('date_range'); 
		else : 
			the_time('M n, Y'); 
		endif; 
		if ( get_field('time') ) echo '<br />' . get_field('time'); 
		if ( get_field('price') ) echo '<br />' . get_field('price');
	?>
	</p>

	<?php $comments_count = wp_count_comments( get_the_ID() ); if ( $comments_count->approved > 0 ) : ?>
		<p class="commentcount"><?php echo $comments_count->approved; ?></p>
	<?php endif; ?>

	<?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
	<?php exclude_post_categories('recent') ?>

	<?php if ( lessThanOneTwentyDays( get_post_time('U') ) ) : ?>
	 	<ul><li><a href="/recent">Recent</a></li></ul>
	<?php endif; ?>

</div>