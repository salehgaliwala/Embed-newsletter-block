<?php
/*
Plugin Name: Embed Newsletter Block
Plugin URI: https://www.unimaxsystems.info/
Description: Embeds post into the content using shortcode
Version: 1.0
Author: Saleh Galiwala
Author URI: https://www.unimaxsystems.info/
License: GPLv2 or later
Text Domain: unimaxSYSTEMS
Domain Path: /languages
*/

// Make sure we don't expose any info if called directly
if ( !defined( 'ABSPATH' ) ){
	exit;
}

define( 'TWD__VERSION', '0.3' );
define( 'TWD__PLUGIN_URL', plugin_dir_url( __FILE__ ) );


function embednewsletter_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'image_url' => '',   
		'heading_txt' => '',      
		'link' => '',
    ), $atts,'embednewsletter');

    ob_start();
    echo '<div class="relnew gutter"><div class="container"><div class="relnew-inner"><div class="relnew-left"><a href="'. $atts['link'] .'"><img class=" lazyloaded" decoding="async" src="'.  $atts['image_url']  .'" data-src="'. $atts['image_url'] .'"></a></div><div class="relnew-right"><a href="'. $atts['link'] .'"><span>RELATED:</span></a><a href="'.  $atts['link']  .'"><h3>'. $atts['heading_txt'] .'</h3></a></div></div></div></div>';
return ob_get_clean();
}
add_shortcode( 'embednewsletter', 'embednewsletter_shortcode' );

function embednewsletter_scripts() {
	wp_enqueue_style( 'embedpost-css', plugins_url('/style.css',__FILE__),'', '20181010' );
	}
add_action( 'wp_enqueue_scripts', 'embednewsletter_scripts' );	

function custom_tinymce_button() {
   if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
      return;
   }
   if ( get_user_option( 'rich_editing' ) !== 'true' ) {
      return;
   }
   add_filter( 'mce_external_plugins', 'add_custom_tinymce_plugin' );
   add_filter( 'mce_buttons', 'register_custom_tinymce_button' );
}

function add_custom_tinymce_plugin( $plugin_array ) {
   $plugin_array['custom_tinymce_button'] = TWD__PLUGIN_URL . '/mce.js'; // path to your JS file
   return $plugin_array;
}

function register_custom_tinymce_button( $buttons ) {
   array_push( $buttons, 'custom_tinymce_button' );
   return $buttons;
}

add_action( 'admin_init', 'custom_tinymce_button' );
