<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package blanq
 * @since blanq 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since blanq 1.0
 */
function blanq_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'blanq_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since blanq 1.0
 */
function blanq_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'blanq_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since blanq 1.0
 */
function blanq_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'blanq_enhanced_image_navigation', 10, 2 );



// /**
//  * Filter the Gallery output to bootify it.
//  *
//  * @since blanq 1.0
//  */
// remove_shortcode( 'gallery' );
// add_shortcode( 'gallery' , 'my_own_gallary' );
// function my_own_gallary($attr) {
//     global $post;

//     static $instance = 0;
//     $instance++;

//     // Allow plugins/themes to override the default gallery template.
//     $output = apply_filters('post_gallery', '', $attr);
//     if ( $output != '' )
//         return $output;

//     // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
//     if ( isset( $attr['orderby'] ) ) {
//         $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
//         if ( !$attr['orderby'] )
//             unset( $attr['orderby'] );
//     }

//     extract(shortcode_atts(array(
//         'order'      => 'ASC',
//         'orderby'    => 'menu_order ID',
//         'id'         => $post->ID,
//         'itemtag'    => 'div',
//         'icontag'    => '',
//         'captiontag' => 'div',
//         'columns'    => 3,
//         'size'       => 'large',
//         'include'    => '',
//         'exclude'    => ''
//     ), $attr));

//     $id = intval($id);
//     if ( 'RAND' == $order )
//         $orderby = 'none';

//     if ( !empty($include) ) {
//         $include = preg_replace( '/[^0-9,]+/', '', $include );
//         $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

//         $attachments = array();
//         foreach ( $_attachments as $key => $val ) {
//             $attachments[$val->ID] = $_attachments[$key];
//         }
//     } elseif ( !empty($exclude) ) {
//         $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
//         $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
//     } else {
//         $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
//     }

//     if ( empty($attachments) )
//         return '';

//     if ( is_feed() ) {
//         $output = "\n";
//         foreach ( $attachments as $att_id => $attachment )
//             $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
//         return $output;
//     }

//     $itemtag = tag_escape($itemtag);
//     $captiontag = tag_escape($captiontag);
//     $columns = intval($columns);
//     $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
//     $float = is_rtl() ? 'right' : 'left';

//     $selector = "carousel-{$instance}";

//     $gallery_style = $gallery_div = '';
//     if ( apply_filters( 'use_default_gallery_style', true ) )
//         $gallery_style = "";
//     $size_class = sanitize_html_class( $size );
//     $gallery_div = '<div id="' . $selector . '" class="carousel slide carouselid-' . $id . "\">\n<div class=\"carousel-inner\">\n";
//     $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

//     $i = 0;
//     foreach ( $attachments as $id => $attachment ) {
//         $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);
        
//         if ( $i === 0 ) {
//         	$output .= "<{$itemtag} class=" . '"item active"' . ">";
//         }
//         else
//         {
//         	$output .= "<{$itemtag} class=" . '"item"' . ">";
//         }
        
//         $output .= "\n$link\n";
//         if ( $captiontag && trim($attachment->post_excerpt) ) {
//             $output .= "";
//         }
//         $output .= "</{$itemtag}>\n";
//         if ( $columns > 0 && ++$i % $columns == 0 )
//             $output .= '';
//     }

//     $output .= '<a class="left carousel-control" href="' . $selector . '" data-slide="prev">&lsaquo;</a>';
//     $output .= '<a class="right carousel-control" href="' . $selector . '" data-slide="next">&rsaquo;</a>';
//     $output .= '</div></div>';

//     return $output;
// }