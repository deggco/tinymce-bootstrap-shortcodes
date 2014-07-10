<?php

/**
 * WordPress TinyMCE Bootstrap Shortcodes Plugin
 * Form insert page
 */

// Load Wordpress

$file = 'wp-config.php';
while(!file_exists($file))
  $file = "../" . $file;

require_once $file;
require_once ABSPATH . "wp-load.php";

function enqueue_jquery_ui() {
  wp_deregister_script("jquery-ui");
  wp_register_script("jquery-ui",plugin_dir_url(__FILE__)."js/jquery-ui.min.js",["jquery"]);
  wp_enqueue_script("jquery-ui");

  wp_register_style("jquery-ui",plugin_dir_url(__FILE__)."css/jquery-ui.min.css");
  wp_enqueue_style("jquery-ui");

  wp_register_style("tinymce-bootstrap-shortcode-insert",plugin_dir_url(__FILE__)."css/insert.css");
  wp_enqueue_style("tinymce-bootstrap-shortcode-insert");

  wp_register_script("tinymce-bootstrap-shortcode-insert",plugin_dir_url(__FILE__)."js/insert.js");
  wp_enqueue_script("tinymce-bootstrap-shortcode-insert");
}

add_action('wp_enqueue_scripts','enqueue_jquery_ui');

if(!isset($_GET["cols"]))
  die();
else if(!in_array($_GET["cols"],[2,3,4]))
  die();
else
  $columnCount = (int) $_GET["cols"];

?><!DOCTYPE html>
<head>
  <script type="text/javascript">columnCount = <?php echo $columnCount; ?>;</script>
  <?php wp_head(); ?>
</head>
<body>

<form onSubmit="processForm(this);">
  <label for="col1-text">Column 1:</label>
  <textarea name="col1-text"></textarea>

  <label for="col2-text">Column 2:</label>
  <textarea name="col2-text"></textarea>
  
  <?php if($columnCount > 2) { ?>

  <label for="col3-text">Column 3:</label>
  <textarea name="col3-text"></textarea>

  <?php if($columnCount > 3) { ?>

  <label for="col3-text">Column 4:</label>
  <textarea name="col3-text"></textarea>

  <?php }} ?>

  <label for="col-widths">Column Widths:</label>
  <input type="hidden" name="col1-width" />
  <input type="hidden" name="col2-width" />
  <?php if($columnCount > 2) { ?>
  <input type="hidden" name="col3-width" />
  <?php if($columnCount > 3) { ?>
  <input type="hidden" name="col4-width" />
  <?php }} ?>
  
  <div id="col-width-slider"></div>
  <div id="col-width-labels">
    Column 1: <span class="col-1-width"></span>
    , Column 2: <span class="col-2-width"></span>
  <?php if($columnCount > 2) { ?>
    , Column 3: <span class="col-3-width"></span>
  <?php if($columnCount > 3) { ?>
    , Column 4: <span class="col-4-width"></span>
  <?php }} ?>

</form>

</body>
</html>
