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

function equeue_jquery_ui() {
  wp_enqueue_script('jquery-ui',site_url().'/wp-includes/js/jquery/ui/jquery.ui.core.min.js');
  wp_enqueue_script('slider-jquery-ui',site_url().'/wp-includes/js/jquery/ui/jquery.ui.slider.min.js');
}

add_action('wp_enqueue_scripts','equeue_jquery_ui');

?><!DOCTYPE html>
<head>
  <?php 
  
  wp_head(); ?>
  <script type="text/javascript">

jQuery(document).ready(function($){
  $('#slider').css('diplay','none');
}(jQuery));

function processForm(obj) {
  
}

  </script>
</head>
<body>
  <form onsubmit="processForm(this);" />
    <div id="slider">hello</div>
  </form>
</body>
</html>
