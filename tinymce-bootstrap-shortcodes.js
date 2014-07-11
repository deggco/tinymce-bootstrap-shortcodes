(function() {
  console.log('trap A');
  tinymce.PluginManager.add('TMCEBS_shortcodes', function(editor, url) {
    // Add a button that opens a window and adds a URL
  console.log('trap B');
    editor.addButton('TMCEBS_URL_shortcode_key', {
      //text: 'Button',
      icon: 'dashicons icon-plus',
      //icon: false,
      onclick: function() {
        // Open window
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
            //[button title='title' url='url']
          }
        });
      }
    });
    // Add a button that opens a window
    editor.addButton('TMCEBS_2_col', {
      //text: 'Button',
      icon: 'dashicons icon-layout2',
      //icon: false,
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Two-Column Layout',
          url: tmcebs.plugin_dir+'insert.php?cols=2',
          width: 800,
          height: 600
        });
      }
    });
    // Add a button that opens a window
    editor.addButton('TMCEBS_3_col', {
      //text: 'Button',
      icon: 'dashicons icon-layout3',
      //icon: false,
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Three-Column Layout',
          url: tmcebs.plugin_dir+'insert.php?cols=3',
          width: 800,
          height: 600
        });
      }
    });
    // Add a button that opens a window
    editor.addButton('TMCEBS_4_col', {
      //text: 'Button',
      icon: 'dashicons icon-layout4',
      //icon: false,
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Four-Column Layout',
          url: tmcebs.plugin_dir+'/insert.php?cols=4',
          width: 800,
          height: 600
        });
      }
    });
    // Add a button that opens a window
    editor.addButton('TMCEBS_clearer', {
      //text: 'Button',
      icon: 'dashicons icon-menu',
      //icon: false,
      onclick: function() {
        // Open window
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
