<?php
/**
 * Plugin Name: TinyMCE Bootstrap Shortcodes
 * Description: A plugin to add a custom button and shortcode to TinyMCE
 * Plugin URI:  https://github.com/zero4281/tinymce-bootsrap-shortcodes
 * Version:     0.0.1
 * Author:      Joshua Rising
 * Author URI:  https://github.com/zero4281/
 * License:     GPL3
 * Copy Right: 2014 Joshua Rising, Rogue Valley Software
 */
 
function TMCEBB_shortcode_css() {
	wp_enqueue_style('TMCEBB_shortcode_css', plugins_url('/style.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'TMCEBB_shortcode_css');

add_action( 'admin_head', 'TMCEBB_shortcode_add_tinymce' );
function TMCEBB_shortcode_add_tinymce() {
    global $typenow;
    
    // only on Post Type: post and page
    if( ! in_array( $typenow, apply_filters('TMCEBB_post_types', array( 'post', 'page' ) ) ) )
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

    array_push( $buttons, 'TMCEBB_URL_shortcode_key' );
    array_push( $buttons, 'TMCEBB_col_6_shortcode_key' );
    array_push( $buttons, 'TMCEBB_col_48_shortcode_key' );
    array_push( $buttons, 'TMCEBB_col_84_shortcode_key' );
    array_push( $buttons, 'TMCEBB_col_444_shortcode_key' );
    // Print all buttons
    //var_dump( $buttons );
    return $buttons;
}
/*
TMCEBB_URL_shortcode_key
*/
//function to output shortcode
function TMCEBB_shortcode_display_link($atts) {
	@extract($atts);
	$title;
	$url;
	if(stripos($url, 'http') === FALSE) {
		$url = 'http://' . $url;
	}
	$tempLink = "<a class=\"btn btn-primary\" title=\"$title\" href=\"$url\" target='_blank'>$title</a>";
	
	return $tempLink;
}
//function to output shortcode
function TMCEBB_shortcode_display_row($atts, $content = null) {
	$tempStr = '<div class="row">'.do_shortcode($content).'</div>';
	return $tempStr;
}
function TMCEBB_shortcode_display_col_6($atts, $content = null) {
	$tempStr = '<div class="col-md-6">'.do_shortcode($content).'</div>';
	return $tempStr;
}
function TMCEBB_shortcode_display_col_8($atts, $content = null) {
	$tempStr = '<div class="col-md-8">'.do_shortcode($content).'</div>';
	return $tempStr;
}
function TMCEBB_shortcode_display_col_4($atts, $content = null) {
	$tempStr = '<div class="col-md-4">'.do_shortcode($content).'</div>';
	return $tempStr;
}

add_shortcode('button', 'TMCEBB_shortcode_display_link');
add_shortcode('row', 'TMCEBB_shortcode_display_row');
add_shortcode('col-6', 'TMCEBB_shortcode_display_col_6');
add_shortcode('col-8', 'TMCEBB_shortcode_display_col_8');
add_shortcode('col-4', 'TMCEBB_shortcode_display_col_4');
?>
