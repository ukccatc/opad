<?php

/**
 * functions and definitions
 *
 * @package Modern WP Themes
 */

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
//require_once (ABSPATH . '/wp-content/themes/aocean/include/functions.php');

if ( ! function_exists( 'modernwpthemes_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     */
    function modernwpthemes_setup() {

//Initialize the update checker.
        require 'inc/theme-update-checker.php';
        $example_update_checker = new ThemeUpdateChecker(
            'aocean',  //Theme folder name "slug".
            'http://www.modernwpthemes.com/demo/aocean/metadata.json' //URL of the metadata file.
        );


        /**
         * Set the content width based on the theme's design and stylesheet.
         */

        global $content_width;

        /**
         * Global content width.
         */

        if ( ! isset( $content_width ) )
            $content_width = 640; /* pixels */


        // Enable automatic feed links
        add_theme_support( 'automatic-feed-links' );


        /**
         * Make theme available for translation
         * Translations can be filed in the /lang/ directory
         * If you're building a theme based on , use a find and replace
         * to change '' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'modernwpthemes', get_template_directory() . '/lang' );

        //Custom Background Options

        add_theme_support( 'custom-background' );

        /**
         * Enable support for Post Thumbnails on posts and pages
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'thumb-small', 70, 70, true );
        add_image_size( 'thumb-full', 650, 300, true );
        add_image_size( 'thumb-medium', 300, 135, true );
        add_image_size( 'thumb-featured', 250, 175, true );

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus( array(
            'main' => __( 'Main Menu', 'modernwpthemes' ),
        ) );
    }
endif; // Modern WP Themes_setup
add_action( 'after_setup_theme', 'modernwpthemes_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function modernwpthemes_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'modernwpthemes' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Sub Footer 1', 'modernwpthemes' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Sub Footer 2', 'modernwpthemes' ),
        'id'            => 'sidebar-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Sub Footer 3', 'modernwpthemes' ),
        'id'            => 'sidebar-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Sub Footer 4', 'modernwpthemes' ),
        'id'            => 'sidebar-5',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
}
add_action( 'widgets_init', 'modernwpthemes_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since  1.0
 */
function modernwpthemes_footer_sidebar_class() {
    $count = 0;

    if ( is_active_sidebar( 'sidebar-2' ) )
        $count++;

    if ( is_active_sidebar( 'sidebar-3' ) )
        $count++;

    if ( is_active_sidebar( 'sidebar-4' ) )
        $count++;

    if ( is_active_sidebar( 'sidebar-5' ) )
        $count++;

    $class = '';

    switch ( $count ) {
        case '1':
            $class = 'site-extra extra-one';
            break;
        case '2':
            $class = 'site-extra extra-two';
            break;
        case '3':
            $class = 'site-extra extra-three';
            break;
        case '4':
            $class = 'site-extra extra-four';
            break;
    }

    if ( $class )
        echo 'class="' . $class . '"';
}


/**
 * Enqueue scripts and styles
 */
function modernwpthemes_scripts() {
    $protocol = is_ssl() ? 'https' : 'http';
    $query_args = array(
        'family' => 'Open+Sans+Condensed:300,300italic,700',
    );
    wp_enqueue_style( 'fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ) );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', 'style');
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', 'style' );
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'style-billing', get_template_directory_uri() . '/css/style-billing.css', 'style' );


    wp_enqueue_script("jquery");
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
    wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ) );
    wp_enqueue_script( 'supersubs', get_template_directory_uri() . '/js/supersubs.js', array( 'jquery' ) );
    wp_enqueue_script( 'settings', get_template_directory_uri() . '/js/settings.js', array( 'jquery' ) );
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
    wp_enqueue_script( 'script-billing', get_template_directory_uri() . '/js/script-billing.js', array( 'jquery' ) );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'modernwpthemes_scripts' );

/**
 * Mobile Menu Enqueue scripts and styles
 */
function modernwpthemes_responsive_menu()
{

//meanmenu

    wp_enqueue_style('meanmenu', get_template_directory_uri() . '/css/meanmenu.css', 'style');
}

add_action('wp_enqueue_scripts', 'modernwpthemes_responsive_menu');

function modernwpthemes_custom_scripts_function() {
    if ( !is_admin() ) {

        wp_enqueue_script('jquery');  //Grabs the latest version of jQuery from WordPress

        wp_register_script('meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.js', array('jquery'), false );

        wp_enqueue_script('meanmenu');
    }
}

add_action('wp_enqueue_scripts', 'modernwpthemes_custom_scripts_function');


define('modernwpthemes_PATH', get_template_directory() );
/**
 * Custom functions that act independently of the theme templates.
 */
require modernwpthemes_PATH . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require modernwpthemes_PATH . '/inc/template-tags.php';

/**
 * Add social links on user profile page.
 */
require modernwpthemes_PATH . '/inc/user-profile.php';

/**
 * Add custom widgets
 */
require modernwpthemes_PATH . '/inc/custom-widgets.php';

/*  TGM plugin activation
/* ------------------------------------ */
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';
function modernwpthemes_plugins() {

    // Add the following plugins
    $plugins = array(
        array(
            'name' 				=> 'WP-PageNavi',
            'slug' 				=> 'wp-pagenavi',
            'required'			=> false,
            'force_activation' 	=> false,
            'force_deactivation'=> false,
        ),
    );
    tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'modernwpthemes_plugins' );

/*  Custom favicon
/* ------------------------------------ */
function modernwpthemes_favicon() {
    if ( of_get_option('favicon') ) {
        echo '<link rel="shortcut icon" href="'.of_get_option('favicon').'" />'."\n";
    }
}
add_filter( 'wp_head', 'modernwpthemes_favicon' );


/*  Tracking code
/* ------------------------------------ */
if ( ! function_exists( 'modernwpthemes_tracking_code' ) ) {

    function modernwpthemes_tracking_code() {
        if ( of_get_option('tracking_code') ) {
            echo ''.of_get_option('tracking_code').''."\n";
        }
    }

}
add_filter( 'wp_footer', 'modernwpthemes_tracking_code' );

get_template_part('/include/text','comment');

//Вывод всех рубрик (даже тех в которых нет записей)

add_filter( 'widget_categories_args', 'wpb_force_empty_cats' );
function wpb_force_empty_cats($cat_args) {
    $cat_args['hide_empty'] = 0;
    $cat_args['exclude'] = 1;
    return $cat_args;
}

//ini_set('display_errors', 0);
//phpinfo();
//wp_set_password( 'password', 1 );

add_action( 'admin_head', 'Show_count_users' );
function Show_count_users(){
    include_once(ABSPATH . '/wp-content/themes/aocean/include/database.php');
    // Количество членов профсоюза (где Член Профсоюза = 1)
        $dbh = getConnectionDB();
        $result = $dbh->query("SELECT * FROM Stats");
        $row = $result->fetchALL();
        $i = 0;
        foreach ($row as $key=>$value) {
            if ($value['Член-профсоюза'] == 1) {
                $i++;
            }
        }
    echo "<span style='position: absolute; color:green; left: 500px;'>Количество людей в профсоюзе - $i</span>";
}
