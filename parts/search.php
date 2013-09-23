<div class="search"><span class="amp">+</span> <form method="get" action="<?php bloginfo('home'); ?>/">

<!--[if lte IE 8]>

<span class="searchinput"><input type="text" class="iepadding" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" /><input class="icon" type="image" src="<?php echo get_stylesheet_directory_uri() ?>/images/search.gif" /></span>

<![endif]-->

<!--[if gt IE 8]>

 <form method="get" action="<?php bloginfo('home'); ?>/"><label for="s"><span class="imagelabel"><?php include( TEMPLATEPATH . "/images/search.svg"); ?></span><span class="textlabel">Search</span></label><span class="searchinput"><input type="text" class="iepadding" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" /><input class="icon" type="image" src="<?php echo get_stylesheet_directory_uri() ?>/images/search.svg" /></span>

<![endif]-->


<!--[if !IE]><!-->

<label for="s"><span class="imagelabel"><?php include( TEMPLATEPATH . "/images/search.svg"); ?></span><span class="textlabel">Search</span></label><span class="searchinput"><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" /><input class="icon" type="image" src="<?php echo get_stylesheet_directory_uri() ?>/images/search.svg" /></span></form>

<!--<![endif]-->

</form></div>