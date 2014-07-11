(function() {
  tinymce.PluginManager.add('TMCEBS_shortcodes', function(editor, url) {
    /**
     * TMCEBS_URL_shortcode_key
     *
     * Bootstrap button generator
     */
    editor.addButton('TMCEBS_URL_shortcode_key', {
      icon: 'dashicons icon-plus',
      onclick: function() {
        editor.windowManager.open({
          title: 'Bootstrap Button Shortcode',
          body: [{
            type: 'textbox',
            name: 'title',
            label: 'Title'
          }, {
            type: 'textbox',
            name: 'url',
            label: 'URL'
          }],
          onsubmit: function(e) {
            // Insert content when the window form is submitted
            editor.insertContent('[button title=\'' + e.data.title + '\' url=\'' + e.data.url + '\']');
          }
        });
      }
    });
    /**
     * TMCEBS_2_col
     *
     * Column generator for two-column layouts
     */
    editor.addButton('TMCEBS_2_col', {
      icon: 'dashicons icon-layout2',
      onclick: function() {
        editor.windowManager.open({
          title: 'Two-Column Layout',
          url: tmcebs.plugin_dir+'insert.php?cols=2',
          width: 800,
          height: 600
        });
      }
    });
    /**
     * TMCEBS_3_col
     *
     * Column generator for three-column layouts
     */
    editor.addButton('TMCEBS_3_col', {
      icon: 'dashicons icon-layout3',
      onclick: function() {
        editor.windowManager.open({
          title: 'Three-Column Layout',
          url: tmcebs.plugin_dir+'insert.php?cols=3',
          width: 800,
          height: 600
        });
      }
    });
    /**
     * TMCEBS_3_col
     *
     * Column generator for four-column layouts
     */
    editor.addButton('TMCEBS_4_col', {
      icon: 'dashicons icon-layout4',
      onclick: function() {
        editor.windowManager.open({
          title: 'Four-Column Layout',
          url: tmcebs.plugin_dir+'/insert.php?cols=4',
          width: 800,
          height: 600
        });
      }
    });
    /**
     * TMCEBS_clearer
     *
     * <br> tag generator for a given height (in lines)
     */
    editor.addButton('TMCEBS_clearer', {
      icon: 'dashicons icon-menu',
      onclick: function() {
        editor.windowManager.open({
          title: 'Clear floats',
          body: [{
            type: 'textbox',
            name: 'verticalLines',
            label: 'Vertical lines',
          }],
          onsubmit: function(e) {
            // Insert content when the window form is submitted
            if (e.data.verticalLines) {
              lines = ' lines=' + e.data.verticalLines;
            } else {
              lines = '';
            }
            editor.insertContent('[clear' + lines + ']');
          }
        });
      }
    });
  });
})();
