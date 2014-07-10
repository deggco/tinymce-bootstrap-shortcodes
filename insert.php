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
  if(!in_array($_GET["cols"],[2,3,4]))
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

</form>

</body>
</html>
