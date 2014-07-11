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

function remove_enqueued_styles() {
  global $wp_styles;
  foreach($wp_styles->queue as $handle) {
    $wp_styles->dequeue($handle);
  }
}
add_action('wp_enqueue_scripts', 'remove_enqueued_styles',100);

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
add_action('wp_enqueue_scripts', 'enqueue_jquery_ui',101);

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

<form onSubmit="return processForm(this);">
  <h2>Content</h2>

  <label for="col1-text">Column 1:</label>
  <textarea name="col1-text"></textarea>

  <label for="col2-text">Column 2:</label>
  <textarea name="col2-text"></textarea>
  
  <?php if($columnCount > 2) { ?>

  <label for="col3-text">Column 3:</label>
  <textarea name="col3-text"></textarea>

  <?php if($columnCount > 3) { ?>

  <label for="col4-text">Column 4:</label>
  <textarea name="col4-text"></textarea>

  <?php }} ?>

  <h2>Column Sizes</h2>

  <label for="responsive-design">Responsive slider sizes: </label>
  <input type="checkbox" name="responsive-design" id="responsive-design" />

  <div id="nonresponsive-sliders">
    <div class="slider-header">
      <label for="col-widths">Column Widths:</label>
    </div>
    <input type="hidden" name="col1-width" />
    <input type="hidden" name="col2-width" />
    <?php if($columnCount > 2) { ?>
    <input type="hidden" name="col3-width" />
    <?php if($columnCount > 3) { ?>
    <input type="hidden" name="col4-width" />
    <?php }} ?>
    
    <div id="col-width-slider"></div>
    <div id="col-width-labels">
      <div class="col-width-label">Column 1: <span class="col-1-width"></span></div>
      <div class="col-width-label">Column 2: <span class="col-2-width"></span></div>
    <?php if($columnCount > 2) { ?>
      <div class="col-width-label">Column 3: <span class="col-3-width"></span></div>
    <?php if($columnCount > 3) { ?>
      <div class="col-width-label">Column 4: <span class="col-4-width"></span></div>
    <?php }} ?>
    </div>
  </div>


  <div id="responsive-design-sliders">
    <div class="slider-header">
      <label for="xs-col-widths">XS Screens (0-767px):</label>
      <div id="xs-full-width-container">
        <label for="xs-full-width">Full Width Columns: </label>
        <input type="checkbox" name="xs-full-width" />
      </div>
    </div>
    <input type="hidden" name="xs-col1-width" />
    <input type="hidden" name="xs-col2-width" />
    <?php if($columnCount > 2) { ?>
    <input type="hidden" name="xs-col3-width" />
    <?php if($columnCount > 3) { ?>
    <input type="hidden" name="xs-col4-width" />
    <?php }} ?>
    
    <div id="xs-col-width-slider"></div>
    <div id="xs-col-width-labels">
      <div class="col-width-label">Column 1: <span class="xs-col-1-width"></span></div>
      <div class="col-width-label">Column 2: <span class="xs-col-2-width"></span></div>
    <?php if($columnCount > 2) { ?>
      <div class="col-width-label">Column 3: <span class="xs-col-3-width"></span></div>
    <?php if($columnCount > 3) { ?>
      <div class="col-width-label">Column 4: <span class="xs-col-4-width"></span></div>
    <?php }} ?>
    </div>


    <div class="slider-header">
      <label for="sm-col-widths">SM Screens (768-991px):</label>
      <div id="sm-full-width-container">
        <label for="sm-full-width">Full Width Columns: </label>
        <input type="checkbox" name="sm-full-width" />
      </div>
    </div>
    <input type="hidden" name="sm-col1-width" />
    <input type="hidden" name="sm-col2-width" />
    <?php if($columnCount > 2) { ?>
    <input type="hidden" name="sm-col3-width" />
    <?php if($columnCount > 3) { ?>
    <input type="hidden" name="sm-col4-width" />
    <?php }} ?>
    
    <div id="sm-col-width-slider"></div>
    <div id="sm-col-width-labels">
      <div class="col-width-label">Column 1: <span class="sm-col-1-width"></span></div>
      <div class="col-width-label">Column 2: <span class="sm-col-2-width"></span></div>
    <?php if($columnCount > 2) { ?>
      <div class="col-width-label">Column 3: <span class="sm-col-3-width"></span></div>
    <?php if($columnCount > 3) { ?>
      <div class="col-width-label">Column 4: <span class="sm-col-4-width"></span></div>
    <?php }} ?>
    </div>


    <div class="slider-header">
      <label for="md-col-widths">MD Screens (992-1199px):</label>
    </div>
    <input type="hidden" name="md-col1-width" />
    <input type="hidden" name="md-col2-width" />
    <?php if($columnCount > 2) { ?>
    <input type="hidden" name="md-col3-width" />
    <?php if($columnCount > 3) { ?>
    <input type="hidden" name="md-col4-width" />
    <?php }} ?>
    
    <div id="md-col-width-slider"></div>
    <div id="md-col-width-labels">
      <div class="col-width-label">Column 1: <span class="md-col-1-width"></span></div>
      <div class="col-width-label">Column 2: <span class="md-col-2-width"></span></div>
    <?php if($columnCount > 2) { ?>
      <div class="col-width-label">Column 3: <span class="md-col-3-width"></span></div>
    <?php if($columnCount > 3) { ?>
      <div class="col-width-label">Column 4: <span class="md-col-4-width"></span></div>
    <?php }} ?>
    </div>


    <div class="slider-header">
      <label for="lg-col-widths">LG Screens (1200px+):</label>
    </div>
    <input type="hidden" name="lg-col1-width" />
    <input type="hidden" name="lg-col2-width" />
    <?php if($columnCount > 2) { ?>
    <input type="hidden" name="lg-col3-width" />
    <?php if($columnCount > 3) { ?>
    <input type="hidden" name="lg-col4-width" />
    <?php }} ?>
    
    <div id="lg-col-width-slider"></div>
    <div id="lg-col-width-labels">
      <div class="col-width-label">Column 1: <span class="lg-col-1-width"></span></div>
      <div class="col-width-label">Column 2: <span class="lg-col-2-width"></span></div>
    <?php if($columnCount > 2) { ?>
      <div class="col-width-label">Column 3: <span class="lg-col-3-width"></span></div>
    <?php if($columnCount > 3) { ?>
      <div class="col-width-label">Column 4: <span class="lg-col-4-width"></span></div>
    <?php }} ?>
    </div>
  </div>

  <input type="submit" value="Insert Into Post" />

</form>

</body>
</html>
