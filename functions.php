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
  return '0.2.0'; 
} 

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since blanq 1.0
 */
if ( ! isset( $content_width ) )
  $content_width = 640; /* pixels */

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
   * Custom classes
   */
  require( get_template_directory() . '/inc/classes.php' );

  /**
   * Make theme available for translation
   * Translations can be filed in the /languages/ directory
   * If you're building a theme based on blanq, use a find and replace
   * to change 'blanq' to the name of your theme in all the template files
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
 * Registers a custom menu, create default menus, and assigns to theme locations
 * Credit: Jason Schuller http://theme.it/quick-tip-how-to-generate-a-default-custom-menu/
 * with modification from Melanie Karlik (from article comments)
 *
 * We use a class which extends Walker_Nav_Menu to create Twitter Bootstrap toolkit Dropdown menus. 
 * The class can be found in inc/classes.php. 
 */
function blanq_register_custom_menu() 
{
  register_nav_menu( 'blanq_twitter_navbar', __( 'Twitter Navbar' ) );

  if ( isset( $_GET['activated'] ) && $_GET['activated'] ) {
    if ( !is_nav_menu( 'Twitter Navbar' ) ) {
      $menu_id = wp_create_nav_menu( 'Twitter Navbar' );

      $menu_navbar = array( 'menu-item-type' => 'custom', 'menu-item-url' => get_home_url('/'),'menu-item-title' => 'Home', 'menu-item-attr-title' => 'Home', 'menu-item-status' => 'publish' ); // thanks to Melanie Karlik for adapting this to auto-publish http://www.karlikdesign.com/

      wp_update_nav_menu_item( $menu_id, 0, $menu_navbar );

      set_theme_mod( 'nav_menu_locations', array(
       'blanq_twitter_navbar' => $menu_id,
      ) );
    }
  }
}
add_action( 'after_setup_theme', 'blanq_register_custom_menu' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since blanq 1.0
 */
function blanq_widgets_init() 
{
  register_sidebar( array(
    'name' => __( 'Sidebar', 'blanq' ),
    'id' => 'sidebar-1',
    'description' => 'This sidebar is a general sidebar shown on blog pages, archive pages, search.',
    'class' => 'well',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );
}
add_action( 'widgets_init', 'blanq_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function blanq_scripts() 
{
  wp_deregister_script( 'jquery' ); // Unregister WordPress jQuery
  wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', 'jquery', '1.8.1', true); // load CDN jQuery
  wp_enqueue_script('jquery');
  
  wp_enqueue_script( 'blanq', get_template_directory_uri() . '/js/blanq.js', array(), blanq_version('1.0'), true );  

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  if ( is_singular() && wp_attachment_is_image() ) {
    wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/lib/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
  }
}
add_action( 'wp_enqueue_scripts', 'blanq_scripts' );

function blanq_styles()  
{ 
  wp_register_style( 'blanq', get_template_directory_uri() . '/css/blanq.css', array(), blanq_version() );
  wp_enqueue_style( 'blanq' );
}
add_action('wp_enqueue_scripts', 'blanq_styles');

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Remove Actions. Comment/uncomment as needed.
 */
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head',10, 0 );
remove_action( 'wp_head', 'rel_canonical');
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
// remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
// remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed

/**
 * Remove meta boxes from wordpress dashboard for all users, do normal users really care about plugins and wordpress news?
 */
function blanq_remove_dashboard_widgets()
{
    global $wp_meta_boxes;
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
}
add_action('wp_dashboard_setup', 'blanq_remove_dashboard_widgets' );
