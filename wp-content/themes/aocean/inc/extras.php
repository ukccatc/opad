<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Modern WP Themes
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function modernwpthemes_page_menu_args( $args ) {
	$args['show_home'] = true;
	$args['menu_class'] = 'clearfix container sf-menu';
	return $args;
}
add_filter( 'wp_page_menu_args', 'modernwpthemes_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function modernwpthemes_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'modernwpthemes_body_classes' );

/**
 * Add an "active" class to the first carousel item.
 */
function modernwpthemes_featured_post_class( $class = '', $post_id = null ) {
	global $featured;
 
	if ( $class ) {
		$class .= ' ';
	}
	if ( $featured->current_post === 0 ) {
		$class .= 'active';
		return post_class( $class, $post_id );
	}
	else {
		return post_class( $class, $post_id );
	}
}

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function modernwpthemes_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'modernwpthemes_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and _continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function modernwpthemes_auto_excerpt_more( $more ) {
	return '&hellip;' . modernwpthemes_continue_reading_link();
}
add_filter( 'excerpt_more', 'modernwpthemes_auto_excerpt_more' );

/**
 * Returns a "Continue Reading" link for excerpts
 */

function modernwpthemes_continue_reading_link() {
	return ' <p><a href="'. esc_url( get_permalink() ) . '" class="readmore-button">' . __( 'Continue Reading', '' ) . '</a></p>';
}

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function modernwpthemes_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= modernwpthemes_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'modernwpthemes_custom_excerpt_more' );

function modernwpthemes_limit_string($string, $limit) {
	if (strlen($string) < $limit)
		return $string;
	$reg ="/^(.{1," . $limit . "}[^\s]*).*$/s";
	return preg_replace($reg, '\\1', $string);
}

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function modernwpthemes_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'modernwpthemes_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function modernwpthemes_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'modernwpthemes' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'modernwpthemes_wp_title', 10, 2 );


/*  Add Script Tag
/* ------------------------------------ */

/*
 * This is an example of how to override a default filter
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 */
add_action('admin_init','modernwpthemes_optionscheck_change_santiziation', 100);
function modernwpthemes_optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'modernwpthemes_custom_sanitize_textarea' );
}
function modernwpthemes_custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
      "width" => array()
      );
      $custom_allowedtags["script"] = array();
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}
/*  Theme Options Background Options
/* ------------------------------------ */

add_action('wp_head', 'modernwpthemes_print_customstyles', 1000);
function modernwpthemes_print_customstyles() {
    echo '<style type="text/css">';
    echo '/* Custom style output by Modern WP Themes */';
    modernwpthemes_print_background('header_color', '.site-header');
    modernwpthemes_print_background('footer_widget_color', '.site-extra');
    modernwpthemes_print_background('footer_color', '.site-footer');
   echo '</style>';
}
function modernwpthemes_print_background( $option, $selector ) {
    $bg = of_get_option($option, false);
    if ($bg) {
        $bg_img = $bg['image'] ? 'background-image:url('.$bg['image'].')!important;' : '';
		$bg_repeat = $bg['repeat'] ? 'background-repeat:'.$bg['repeat'].'!important;' : '';
		$bg_position = $bg['position'] ? 'background-position:'.$bg['position'].'!important;' : '';
		$bg_attachment = $bg['attachment'] ? 'background-attachment:'.$bg['attachment'].'!important;' : '';
        $bg_color = $bg['color'] ? 'background-color:'.$bg['color'].'!important;' : ''; 
        if ($bg_img || $bg_repeat || $bg_position || $bg_attachment || $bg_color) {
            echo $selector.' { '.$bg_img.$bg_repeat.$bg_position.$bg_attachment.$bg_color.' }';
        }
    } 
}

/*  Theme Options Primary Color
/* ------------------------------------ */

if (!function_exists('modernwpthemes_theme_color'))  {
    function modernwpthemes_theme_color(){

      echo '<style type="text/css">';

      if ( of_get_option('theme_primary_color')) {
        echo '#main-navigation, .mean-container .mean-bar, .entry-summary a:hover.readmore-button, .widget_modernwpthemes_tabs .widget-tab-nav li.active a, .site-content [class*="navigation"] a, .site-footer, .page-header, #main-navigation .sf-menu li:hover li a:hover, #main-navigation .sf-menu li.sfHover li a:hover, #main-navigation .sf-menu li li a:hover, #main-navigation .sf-menu li li.sfHover > a, #main-navigation .sf-menu li li.current_page_item > a, #main-navigation .sf-menu li li.current-menu-item > a, #main-navigation .sf-menu li li.current-menu-parent > a, #main-navigation .sf-menu li li.current-page-parent > a, #main-navigation .sf-menu li li.current-page-ancestor > a, #main-navigation .sf-menu li li.current_page_ancestor > a, #main-navigation .sf-menu li li.current-menu-ancestor > a, #reply-title, button, a.button, input[type="button"], input[type="reset"], input[type="submit"] {background:' . of_get_option('theme_primary_color', '#43c6a9').'} 
		
		#back-top a {background-color: '.of_get_option('theme_primary_color', '#43c6a9').'}
		 
		a, .entry-title a:hover, .entry-meta a time:before, .entry-meta .byline:before, .entry-meta .author a:before, .entry-meta [class^="fa-"]:before, .comments-link a:hover, .widget_modernwpthemes_tabs .widget-entry-content h4 a, .widget_modernwpthemes_tabs .widget-entry-summary h4 a, .widget_modernwpthemes_tabs .widget-tab-nav li a:hover, .widget_modernwpthemes_tabs .widget-tab-nav li a:focus, .widget_recent_entries li a:before, .widget li a:hover, .widget_archive li a:before, .widget_recent_comments li:before, .widget_categories li a:before, .widget_modernwpthemes_tabs #widget-tab-tags a:hover, .site-extra .widget a:hover, .site-content [class*="navigation"] a:hover, .wp-pagenavi a:hover, .wp-pagenavi a:active, .wp-pagenavi span.current, .paging-navigation .wp-pagenavi a:hover, .paging-navigation .wp-pagenavi a:active, .paging-navigation .wp-pagenavi span.current, .author-info .author-content h3, .comment-list li.comment .reply a, .widget_nav_menu li a:before {color: '.of_get_option('theme_primary_color', '#43c6a9').'} 
		
		.widget-title span, .widget_modernwpthemes_tabs .widget-tab-nav { border-bottom:1px solid '.of_get_option('theme_primary_color', '#43c6a9').'; } 
		
		.entry-summary a.readmore-button, .paging-navigation .wp-pagenavi a:hover, .paging-navigation .wp-pagenavi a:active, .paging-navigation .wp-pagenavi span.current { border-bottom:3px solid '.of_get_option('theme_primary_color', '#43c6a9').';} 
		
		.entry-summary a.readmore-button, .paging-navigation .wp-pagenavi a:hover, .paging-navigation .wp-pagenavi a:active, .paging-navigation .wp-pagenavi span.current { border-bottom:3px solid '.of_get_option('theme_primary_color', '#43c6a9').';} 
		
		#main-navigation .sf-menu li:hover ul, #main-navigation .sf-menu li.sfHover ul, .site-sidebar .widget, .hentry, .single-post .hentry, .comment-list li.comment .comment-body, #commentform  { border-bottom:4px solid '.of_get_option('theme_primary_color', '#43c6a9').';} 
		
		#main-navigation .sf-menu li:hover ul, #main-navigation .sf-menu li.sfHover ul  { border-top:4px solid '.of_get_option('theme_primary_color', '#43c6a9').';} 
		
		.widget_modernwpthemes_social_icons li a [class^="fa-"]:before{ border-bottom:2px solid '.of_get_option('theme_primary_color', '#43c6a9').';} 
		
		blockquote{ border-left:5px solid '.of_get_option('theme_primary_color', '#43c6a9').';}';
      }

	if ( of_get_option('logo_text_color')) {
        echo '.site-title a { color: '.of_get_option('logo_text_color', '#2e3944').';} ';
	}
	
	if ( of_get_option('site_description_color')) {
        echo '.site-description { color: '.of_get_option('site_description_color', '#999999').';} ';
	}

	if ( of_get_option('footer_widget_text_color')) {
        echo '.site-extra .widget-title span { color: '.of_get_option('footer_widget_text_color', '#2e3944').';} ';
	}

	if ( of_get_option('footer_widget_link_color')) {
        echo '.site-extra .widget a { color: '.of_get_option('footer_widget_link_color', '#2e3944').';} ';
	}

	if ( of_get_option('social_icon_bg_color')) {
        echo '.widget_modernwpthemes_social_icons li a [class^="fa-"]:before { background: '.of_get_option('social_icon_bg_color', '#2e3944').';} ';
	}


   if ( of_get_option('custom_css')) {
        echo of_get_option( 'custom_css', 'no entry' );
      }    
        echo '</style>';
    }   
}
add_action('wp_head','modernwpthemes_theme_color',10);

