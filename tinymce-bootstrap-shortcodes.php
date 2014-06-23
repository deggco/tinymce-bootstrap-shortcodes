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

function TMCEBS_css() {
  wp_enqueue_style('TMCEBS_css', plugins_url('/style.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'TMCEBS_css');

add_action( 'admin_head', 'TMCEBS_add_tinymce' );

function TMCEBS_add_tinymce() {
  global $typenow;

  // only on Post Type: post and page
  if( ! in_array( $typenow, apply_filters('TMCEBS_post_types', array( 'post', 'page' ) ) ) )
    return ;

  add_filter( 'mce_external_plugins', 'TMCEBS_add_tinymce_plugin' );
  // Add to line 1 form WP TinyMCE
  add_filter( 'mce_buttons', 'TMCEBS_add_tinymce_button' );
}

// inlcude the js for tinymce
function TMCEBS_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['TMCEBS_shortcodes'] = plugins_url( '/tinymce-bootstrap-shortcodes.js', __FILE__ );
  // Print all plugin js path
  //echo '<pre>' . print_r($plugin_array, true) . '</pre>';
  return $plugin_array;
}

// Add the button key for address via JS
function TMCEBS_add_tinymce_button( $buttons ) {

  array_push( $buttons, 'TMCEBS_URL_shortcode_key' );
  array_push( $buttons, 'TMCEBS_col_6_shortcode_key' );
  array_push( $buttons, 'TMCEBS_col_48_shortcode_key' );
  array_push( $buttons, 'TMCEBS_col_84_shortcode_key' );
  array_push( $buttons, 'TMCEBS_col_444_shortcode_key' );
  array_push($buttons, 'TMCEBS_clearer');
  // Print all buttons
  //echo '<pre>' . print_r($buttons, true) . '</pre>';
  return $buttons;
}
/*
TMCEBS_URL_shortcode_key
*/
//function to output shortcode
function TMCEBS_display_link($atts) {
  @extract($atts);
  $title;
  $url;
  $icon = (isset($icon)) ? "<span class='{$icon}'></span> " : "";
  $type = (isset($type)) ? $type : 'primary';
  $size = (isset($size)) ? $size : 'md';
	$string = sprintf('<a class="btn btn-%s btn-%s" title="%s" href="%s">%s%s</a>', $type, $size, $title, $url, $icon, $title);

  return $tempLink;
}
add_shortcode('button', 'TMCEBS_shortcode_display_link');
//function to output shortcode
function TMCEBS_shortcode_display_row($atts, $content = null) {
  $tempStr = '<div class="row">'.do_shortcode($content).'</div>';
  return $tempStr;
}
add_shortcode('row', 'TMCEBS_shortcode_display_row');
function TMCEBS_shortcode_display_col_6($atts, $content = null) {
  $tempStr = '<div class="col-md-6">'.do_shortcode($content).'</div>';
  return $tempStr;
}
add_shortcode('col-6', 'TMCEBS_shortcode_display_col_6');
function TMCEBS_shortcode_display_col_8($atts, $content = null) {
  $tempStr = '<div class="col-md-8">'.do_shortcode($content).'</div>';
  return $tempStr;
}
add_shortcode('col-8', 'TMCEBS_shortcode_display_col_8');
function TMCEBS_shortcode_display_col_4($atts, $content = null) {
  $tempStr = '<div class="col-md-4">'.do_shortcode($content).'</div>';
  return $tempStr;
}
add_shortcode('col-4', 'TMCEBS_shortcode_display_col_4');
function TMCEBS_shortcode_clear($atts) {
  @extract($atts);
  $vertical_space = '';
  if (isset($lines)) {
    for ($i = 0; $i < $lines; $i++) {
      $vertical_space .= '<br>';
    }
  }
  $tempStr = '<div class="clearfix">'.$vertical_space.'</div>';
  return $tempStr;
}
add_shortcode('clear', 'TMCEBS_shortcode_clear');

?>
