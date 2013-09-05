<?php

function queue_scripts() {

	// Remove Unnecessary Code
	// http://www.themelab.com/2010/07/11/remove-code-wordpress-header/
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');

	if(!wp_script_is('jquery')) wp_enqueue_script("jquery");

	// Packery
	$packeryjs = get_template_directory_uri() . '/js/packery.pkgd.min.js';
	wp_register_script('packeryjs',$packeryjs);
	wp_enqueue_script( 'packeryjs',array('jquery'));

	// Cookie
	$cookiejs = get_template_directory_uri() . '/js/jquery.cookie.js';
	wp_register_script('cookiejs',$cookiejs);
	wp_enqueue_script( 'cookiejs',array('jquery'));

	// Theme
	$themejs = get_template_directory_uri() . '/js/ybcablog.js';
	wp_register_script('themejs',$themejs);
	wp_enqueue_script( 'themejs',array('packeryjs','cookiejs','jquery'));

	// Styles
    $defaultstyle = get_bloginfo('stylesheet_url'); 
    wp_register_style('defaultstyle',$defaultstyle);
    wp_enqueue_style( 'defaultstyle');

}

add_action('wp_enqueue_scripts', 'queue_scripts');



function ybca_logic( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {

		// The homepage should not include posts from Journal, sub cats of Journal, or sub cats of Events...
		$journalCat = get_category_by_slug('journal'); 
		$journalId = $journalCat->term_id;
		$journalSubs = (array) get_term_children($journalId, 'category');

		$eventsCat = get_category_by_slug('events'); 
		$eventsId = $eventsCat->term_id;
		$eventsSubs = (array) get_term_children($eventsId, 'category');

		$excludeArgs = array(
			'category__not_in' => array_merge(array($journalId), $journalSubs, $eventsSubs),
		);

		$homePosts = new WP_Query($excludeArgs);

		$visiblePostsIds = array();

		while ( $homePosts->have_posts() ) : $homePosts->the_post();
			$thisID = get_the_ID();
			array_push($visiblePostsIds, $thisID );
		endwhile;

		// ... Except when those posts are marked "visible", in which case they should float up 
		$markedArgs = array(
			'numberposts' => -1,
			'meta_key' => 'visibility',
			'meta_value' => true
		);

		$markedPosts = new WP_Query( $markedArgs );
		while ($markedPosts->have_posts()) : $markedPosts->the_post();
			$thisID = get_the_ID();
			array_push($visiblePostsIds, $thisID );
		endwhile;

        $query->set( 'post__in' , $visiblePostsIds );

    }

	if ( $query->is_archive() && $query->is_main_query() ) :

		$query->set( 'posts_per_page', -1 );

	endif;

	if ( $query->is_category('recent') && $query->is_main_query() ) :

		add_filter('posts_where', 'filter_where');

	endif;

}
add_action( 'pre_get_posts', 'ybca_logic' );


function filter_where($where = '') {
  $where .= " AND post_date >= '" . date('Y-m-d', strtotime('-120 days')) . "'";
  return $where;
}


function exclude_post_categories($excl=''){
   $categories = get_the_category($post->ID);
      if(!empty($categories)){
      	$exclude=$excl;
      	$exclude = explode(",", $exclude);
		$thecount = count(get_the_category()) - count($exclude);
      	foreach ($categories as $cat) {
//			print_r($cat);

      		$html = '';
      		if(!in_array($cat->slug, $exclude)) {
				$html .= '<li><a href="' . get_category_link($cat->cat_ID) . '" ';
				$html .= 'title="' . $cat->cat_name . '">' . $cat->cat_name . '</a></li>';
			$thecount--;
      		if ( $html != '' ) echo '<ul>' . $html . '</ul>';
      		}
	      }
      }
}


function lessThanOneTwentyDays($postTime) {

	$mylimit = 120 * 86400; //days * seconds per day
	$post_age = date('U') - $postTime;
	if ($post_age < $mylimit) return true;

}

function ybca_wrapper_style() {
	global $post;

	if ( get_field('cover') && !in_category_or_subcategory_of('events') ) :
		echo 'coverwrapper';
	elseif ( has_tag('art') || has_tag('video') ) :	
		echo 'widewrapper';
	else :	
		echo 'wrapper';
	endif;
}



function ybca_corner_color() {
	global $post;

	if ( in_category_or_subcategory_of('events') ) :
		echo 'pink';
	elseif ( in_category_or_subcategory_of('journal') ) :	
		echo 'yellow';
	else :	
		echo 'green';
	endif;
}


// Category description
function wrapped_category_description($id = null) {
	if ( category_description($id) !== '' ) {
		echo '<div class="description">' . category_description($id) . '</div>';
	}
}

/*
	Image Functions
*/


// Featured Images / Post Thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
} 

//http://speakinginbytes.com/2012/11/responsive-images-in-wordpress/
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


function the_ybca_thumbnail($showcaption = false) {

	global $post;

	echo get_ybca_thumbnail($post->ID, $showcaption);
	
}


function get_ybca_thumbnail($post_id, $showcaption) {

	$thumbnail_id = get_post_thumbnail_id($post_id);
	$images = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	if ( count($images) > 0 ) :
		foreach ($images as $attachment_id => $image) :
			
			$img_title = $image->post_title;   // title.
			$img_caption = $image->post_excerpt; // caption.
			$img_description = $image->post_content; // description, unused

			$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true); //alt
			if ($img_alt == '') : $img_alt = $img_title; endif;

			$big_array = image_downsize( $image->ID, 'giantfeature' );
	 		$img_url = $big_array[0];
			
			$output .= '<img src="' . $img_url . '" alt="' . $img_alt . '" />';

			if ( $showcaption && $img_caption) : 
				$output .= '<div class="wp-caption">' . wpautop($img_caption) . '</div>'; 
			endif; 
			
		endforeach;
	endif;

	return $output;

}





?>