<?php
/**
 * Plugin Name: TinyMCE Bootstrap Shortcodes
 * Description: TinyMCE Plugin that adds 2-4 column bootstrap layouts with customizable widths (including responsive design) 
 * Plugin URI:  https://github.com/deggco/tinymce-bootsrap-shortcodes
 * Version:     1.1.0
 * Author:      Degg Company, LLC
 * Author URI:  https://github.com/deggco/
 * License:     GPL3
 */

/**
 * TMCEBS_includes()
 *
 * Imports the custom javascript, CSS, and localized variables in order to 
 * display the plugin properly on the Edit page.
 */
function TMCEBS_includes() {
  wp_enqueue_style('TMCEBS_css', plugins_url('/style.css', __FILE__));
  wp_enqueue_script('TMCEBS_plugin_directory', plugins_url('/variables.js', __FILE__));
  wp_localize_script('TMCEBS_plugin_directory', 'tmcebs', array("plugin_dir" => plugin_dir_url(__FILE__)));
}
add_action('admin_enqueue_scripts', 'TMCEBS_includes');

/**
 * TMCEBS_add_tinymce()
 *
 * Includes the TMCEBS as a TinyMCE Plugin
 */
function TMCEBS_add_tinymce() {
  global $typenow;

  // Only on Post Type: post and page
  if( ! in_array( $typenow, apply_filters('TMCEBS_post_types', array( 'post', 'page' ) ) ) )
    return ;

  add_filter( 'mce_external_plugins', 'TMCEBS_add_tinymce_plugin' );
  add_filter( 'mce_buttons', 'TMCEBS_add_tinymce_button' );
}
add_action( 'admin_head', 'TMCEBS_add_tinymce' );

/**
 * TMCEBS_add_tinymce_plugin()
 *
 * Includes the actual javascript file for the TinyMCE Plugin
 */
function TMCEBS_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['TMCEBS_shortcodes'] = plugins_url( '/tinymce-bootstrap-shortcodes.js', __FILE__ );
  return $plugin_array;
}

/**
 * TMCEBS_add_tinymce_button()
 *
 * Adds the TMCEBS buttons to the TinyMCE Panel
 */
function TMCEBS_add_tinymce_button( $buttons ) {
  array_push( $buttons, 'TMCEBS_URL_shortcode_key' );
  array_push( $buttons, 'TMCEBS_2_col' );
  array_push( $buttons, 'TMCEBS_3_col' );
  array_push( $buttons, 'TMCEBS_4_col' );
  array_push($buttons, 'TMCEBS_clearer');
  return $buttons;
}

/**
 * TMCEBS_shortcode_button()
 *
 * Displays the buttons generated by the button generator in TinyMCE
 */
function TMCEBS_shortcode_button($atts) {
  @extract($atts);
  $title;
  $url;
  $icon = (isset($icon)) ? "<span class='{$icon}'></span> " : "";
  $type = (isset($type)) ? $type : 'primary';
  $size = (isset($size)) ? $size : 'md';
	$string = sprintf('<a class="btn btn-%s btn-%s" title="%s" href="%s">%s%s</a>', $type, $size, $title, $url, $icon, $title);

  return $string;
}
add_shortcode('button', 'TMCEBS_shortcode_button');

/**
 * TMCEBS_shortcode_row()
 *
 * Displays a bootstrap row
 */
function TMCEBS_shortcode_row($atts, $content = null) {
  $tempStr = '<div class="row">'.do_shortcode($content).'</div>';
  return $tempStr;
}
add_shortcode('row', 'TMCEBS_shortcode_row');

/**
 * BACKWARDS COMPATABILITY for v0.0.1. These functions may be removed later.
 */

function TMCEBS_shortcode_display_col_6($atts, $content = null) {
  return '<div class="col-md-6"><div class="padder">'.do_shortcode($content).'</div></div>';
}
add_shortcode('col-6', 'TMCEBS_shortcode_display_col_6');

function TMCEBS_shortcode_display_col_8($atts, $content = null) {
  return '<div class="col-md-8"><div class="padder">'.do_shortcode($content).'</div></div>';
}
add_shortcode('col-8', 'TMCEBS_shortcode_display_col_8');

function TMCEBS_shortcode_display_col_4($atts, $content = null) {
  return '<div class="col-md-4"><div class="padder">'.do_shortcode($content).'</div></div>';
}
add_shortcode('col-4', 'TMCEBS_shortcode_display_col_4');

/**
 * TMCEBS_shortcode_dynamic_col()
 *
 * Displays the dynamic-width columns generated by TMCEBS versions >= 1.0.0
 */
function TMCEBS_shortcode_dynamic_col($atts, $content = null) {
  extract(shortcode_atts(array(
    'class' => 'col-md-6'
  ), $atts, 'bartag' ) );

  return sprintf("<div class=\"%s\">%s</div>",$class, do_shortcode($content));
}
add_shortcode('col', 'TMCEBS_shortcode_dynamic_col');

/**
 * TMCEBS_shortcode_clear()
 *
 * Displays a given number of <br> tags
 */
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
