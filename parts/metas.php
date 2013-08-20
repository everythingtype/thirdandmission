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