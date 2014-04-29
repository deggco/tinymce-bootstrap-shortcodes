<?php
/**
 * Plugin Name: TinyMCE Bootstrap Button
 * Description: A plugin to add a custom button and shortcode to TinyMCE
 * Plugin URI:  https://github.com/zero4281/TinyMCE-shortcode-button
 * Version:     0.0.1
 * Author:      Joshua Rising
 * Author URI:  https://github.com/zero4281/
 * License:     GPLv2
 * License URI: ./assets/license.txt
 * Text Domain: 
 * Domain Path: /languages
 * Network:     false
 */
 
function TMCEBB_shortcode_css() {
	wp_enqueue_style('TMCEBB_shortcode_css', plugins_url('/style.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'TMCEBB_shortcode_css');

add_action( 'admin_head', 'TMCEBB_shortcode_add_tinymce' );
function TMCEBB_shortcode_add_tinymce() {
    global $typenow;
    
    // only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'TMCEBB_shortcode_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'TMCEBB_shortcode_add_tinymce_button' );
}

// inlcude the js for tinymce
function TMCEBB_shortcode_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['TMCEBB_shortcode_button'] = plugins_url( '/TinyMCE-shortcode-button.js', __FILE__ );
	 // Print all plugin js path
    //var_dump( $plugin_array );
    return $plugin_array;
}

// Add the button key for address via JS
function TMCEBB_shortcode_add_tinymce_button( $buttons ) {

    array_push( $buttons, 'TMCEBB_shortcode_button_key' );
    // Print all buttons
    //var_dump( $buttons );
    return $buttons;
}

//function to output shortcode
function TMCEBB_shortcode_display_tinymce($atts) {
	@extract($atts);
	$title;
	$url;
	if(stripos($url, 'http') === FALSE) {
		$url = 'http://' . $url;
	}
	$tempLink = "<a class=\"btn btn-primary\" title=\"$title\" href=\"$url\" target='_blank'>$title</a>";
	
	return $tempLink;
}
add_shortcode('button', 'TMCEBB_shortcode_display_tinymce');
?>