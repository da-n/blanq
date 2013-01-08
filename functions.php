<?php
/**
 * blanq functions and definitions
 *
 * @package blanq
 * @since blanq 1.0
 */
function blanq_version()
{
  /**
   * Current theme version.
   */
  return '1.0'; 
} 

if ( ! function_exists( 'blanq_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since blanq 1.0
 */
function blanq_setup() 
{
  /**
   * Custom hooks.
   */
  require( get_template_directory() . '/inc/hooks.php' );
  
  /**
   * Custom template tags for this theme.
   */
  require( get_template_directory() . '/inc/template-tags.php' );

  /**
   * Custom functions that act independently of the theme templates
   */
  require( get_template_directory() . '/inc/tweaks.php' );

  /**
   * Custom Theme Options
   */
  require( get_template_directory() . '/inc/theme-options/theme-options.php' );

  /**
   * Make theme available for translation
   * Translations can be filed in the /languages/ directory
   */
  load_theme_textdomain( 'blanq', get_template_directory() . '/languages' );

  /**
   * Add default posts and comments RSS feed links to head
   */
  add_theme_support( 'automatic-feed-links' );

  /**
   * Enable support for Post Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  /**
   * Add support for the Aside Post Formats
   */
  add_theme_support( 'post-formats', array( 'aside', ) );
  
  /**
   * Add default image sizes
   */
  add_image_size( 'large', 700, '', true ); // Large Thumbnail
  add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
  add_image_size( 'small', 120, '', true ); // Small Thumbnail
  add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
}
endif; // blanq_setup
add_action( 'after_setup_theme', 'blanq_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since blanq 1.0
 */
function blanq_widgets_init() 
{
  register_sidebar( array(
    'name' => __( 'Sidebar', 'sidebar' ),
    'id' => 'sidebar-1',
    'description' => 'This sidebar is a general sidebar shown on blog pages, archive pages, search.',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h5 class="widget-title">',
    'after_title' => '</h5>',
  ) );
}
add_action( 'widgets_init', 'blanq_widgets_init' );

/**
 * Enqueue JavaScript
 *
 * @since blanq 1.0
 */
function blanq_scripts() 
{
  wp_deregister_script( 'jquery' ); // Unregister WordPress jQuery
  wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', 'jquery', '1.8.1', true); // load CDN jQuery
  wp_enqueue_script('jquery');
  
  wp_enqueue_script( 'blanq', get_template_directory_uri() . '/js/blanq.min.js', array(), blanq_version(), true );  

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'blanq_scripts' );

/**
 * Enqueue CSS
 *
 * @since blanq 1.0
 */
function blanq_styles()  
{ 
  wp_register_style( 'blanq', get_template_directory_uri() . '/css/blanq.css', array(), blanq_version() );
  wp_enqueue_style( 'blanq' );
}
add_action('wp_enqueue_scripts', 'blanq_styles');

/**
 * Remove default actions.
 *
 * @since blanq 1.0
 */
remove_action( 'wp_head', 'wp_generator' ); // Remove WP version for security.