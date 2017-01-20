<?php

/**
 * Cot Multipurpose Wp theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cot_Multipurpose_Wp_theme
 */
if (!function_exists('cot_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function cot_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Cot Multipurpose Wp theme, use a find and replace
         * to change 'cot' to the name of your theme in all the template files.
         */
        load_theme_textdomain('cot', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_image_size('cot_380x300', 380, 300, true);        // cot_380x300 Gallery
        add_image_size('cot_371x226', 371, 226, true);        // cot_371x226 Blog
        add_image_size('cot_80x65', 80, 65, true);            // cot_80x65 gallery Widget
        add_image_size('cot_270x260', 270, 260, true);        // cot_270x260 Team
        add_image_size('cot_1200x320', 1200, 320, true);      // cot_1200x320 Blog Pages
        add_image_size('cot_190x120', 190, 120, true);        // cot_190x120 product carousel
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'cot'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'cot_custom_background_args', array(
//		'default-color' => 'ffffff',
//		'default-image' => '',
//	) ) );
    }

endif;
add_action('after_setup_theme', 'cot_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cot_content_width() {
    $GLOBALS['content_width'] = apply_filters('cot_content_width', 640);
}

add_action('after_setup_theme', 'cot_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cot_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'cot'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'cot'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1st Column', 'cot'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'cot'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2nd Column', 'cot'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'cot'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3rd Column', 'cot'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'cot'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 4th Column', 'cot'),
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'cot'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));
    //Register the front page widgets
    if (function_exists('siteorigin_panels_activate')) {
        register_widget('Cot_Cover_Section');
        register_widget('Cot_Heading');
        register_widget('Cot_List_Widget');
        register_widget('Cot_Video_Button');
        register_widget('Cot_Heading_Two');
        register_widget('Cot_Portfolio');
    }
}

add_action('widgets_init', 'cot_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function cot_scripts() {
    /*
     * Style Enqueue
     */
    wp_enqueue_style('cot-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto|Slabo+27px|Open+Sans');

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap/css/bootstrap.min.css');

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css');

    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
    
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css');
    
    wp_enqueue_style('cot-style', get_stylesheet_uri());

    wp_enqueue_style('shortcodes', get_template_directory_uri() . '/css/shortcodes.css');

    wp_enqueue_style('cot-media-query', get_template_directory_uri() . '/css/media-queries.css');
    

    /*
     *   Script Enqueue
     */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);
    
    wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), false, true);
    
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), false, true);

    wp_enqueue_script('cot-bootstrap-hover-dropdown', get_template_directory_uri() . '/js/bootstrap-hover-dropdown.js', array('jquery', 'bootstrap'), false, true);

    wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.min.js', array(), false, true);

    wp_enqueue_script('SmoothScroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.js', array(), false, true);
    
    wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, false);

    wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), false, false);

    wp_enqueue_script('cot-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('script-init', get_template_directory_uri() . '/js/scripts.js', array(), null, true);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'cot_scripts');

function cot_add_admin_scripts( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'page' === $post->post_type ) {     
            wp_enqueue_style('widget-form', get_template_directory_uri() . '/css/widget-form-style.css');
        }
    }
}
add_action( 'admin_enqueue_scripts', 'cot_add_admin_scripts', 10, 1 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
 * Enable Redux Framework
 */
if (!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/ReduxFramework/ReduxCore/framework.php')) {
    include_once( dirname(__FILE__) . '/ReduxFramework/ReduxCore/framework.php' );
}
if (!isset($redux_demo) && file_exists(dirname(__FILE__) . '/inc/helpers/redux-framework/option/config.php')) {
    include_once( dirname(__FILE__) . '/inc/helpers/redux-framework/option/config.php' );
}

/**
 * Load required file loader.
 */
require get_template_directory() . '/inc/loader.php';

