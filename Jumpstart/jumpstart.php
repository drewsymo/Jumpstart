<?php
/**
 * @package Jumpstart
 * @version 1.0
 */
/*
Plugin Name: Jumpstart
Plugin URI: http://drewsymo.com/wordpress/jumpstart
Description: Jumpstart helps to unclutter and <strong>strengthen</strong> your WordPress project by removing stray output. Read the <a href="http://drewsymo.com/wordpress/jumpstart">documentation</a> for a closer look at how Jumpstart benefits your project. 
Author: Drew Morris
Version: 1.0
Author URI: http://drewsymo.com
License: GPL2
*/

/*  Copyright 2012  Drew Morris  (email : drewsy.morris@gmail.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! function_exists( 'jumpstart_clean_header' ) ):

	/*
	 * Clean the WordPress Header
	 */

	function jumpstart_clean_header() {

		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'rsd_link'); 
		remove_action( 'wp_head', 'wlwmanifest_link');
		remove_action( 'wp_head', 'index_rel_link');
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action( 'wp_head', 'locale_stylesheet');
		remove_action( 'wp_head', 'noindex');
		remove_action( 'wp_head', 'wp_print_styles');
		remove_action( 'wp_head', 'wp_print_head_scripts');
		remove_action( 'wp_head', 'wp_generator');
	}

	jumpstart_clean_header(); 

endif;

if ( ! function_exists( 'jumpstart_remove_recent_comments_style' ) ) :

	/*
	 * Clean Widget Output
	 */

	function jumpstart_remove_recent_comments_style() {  
		global $wp_widget_factory;  
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
	}

add_action( 'widgets_init', 'jumpstart_remove_recent_comments_style' );

endif;

if ( ! function_exists( 'jumpstart_remove_more_jump_link' ) ) :

	/*
	 * Remove the unsightly 'jump' from the read-more link
	 */

	function jumpstart_remove_more_jump_link($link) { 
		$offset = strpos($link, '#more-');
		if ($offset) {
			$end = strpos($link, '"',$offset);
		}
		if ($end) {
			$link = substr_replace($link, '', $offset, $end-$offset);
		}
		return $link;
	}

add_filter('the_content_more_link', 'jumpstart_remove_more_jump_link');

endif;

/*
 * Remove miscellaneous items
 */

add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'login_errors', '__return_false' );


?>
