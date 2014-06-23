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
    editor.addButton('TMCEBS_col_6_shortcode_key', {
      //text: 'Button',
      icon: 'dashicons icon-layout3',
      //icon: false,
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Shortcode 1:1',
          body: [{
            type: 'textbox',
            name: 'col1',
            label: 'Column 1',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }, {
            type: 'textbox',
            name: 'col2',
            label: 'Column 2',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }],
          onsubmit: function(e) {
            // Insert content when the window form is submitted
            editor.insertContent('[row][col-6]' + e.data.col1 + '[/col-6][col-6]' + e.data.col2 + '[/col-6][/row]');
          }
        });
      }
    });
    //col-8/col-4
    // Add a button that opens a window
    editor.addButton('TMCEBS_col_84_shortcode_key', {
      //text: 'Button',
      icon: 'dashicons icon-layout2',
      //icon: false,
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Shortcode 2:1',
          body: [{
            type: 'textbox',
            name: 'col1',
            label: 'Column 1',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }, {
            type: 'textbox',
            name: 'col2',
            label: 'Column 2',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }],
          onsubmit: function(e) {
            // Insert content when the window form is submitted
            editor.insertContent('[row][col-8]' + e.data.col1 + '[/col-8][col-4]' + e.data.col2 + '[/col-4][/row]');
          }
        });
      }
    });
    //col-4/col-8
    // Add a button that opens a window
    editor.addButton('TMCEBS_col_48_shortcode_key', {
      //text: 'Button',
      icon: 'dashicons icon-layout',
      //icon: false,
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Shortcode 1:2',
          body: [{
            type: 'textbox',
            name: 'col1',
            label: 'Column 1',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }, {
            type: 'textbox',
            name: 'col2',
            label: 'Column 2',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }],
          onsubmit: function(e) {
            // Insert content when the window form is submitted
            editor.insertContent('[row][col-4]' + e.data.col1 + '[/col-4][col-8]' + e.data.col2 + '[/col-8][/row]');
          }
        });
      }
    });
    //col-4/col-4/col-4
    // Add a button that opens a window
    editor.addButton('TMCEBS_col_444_shortcode_key', {
      //text: 'Button',
      icon: 'dashicons icon-layout4',
      //icon: false,
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Shortcode 1:1:1',
          body: [{
            type: 'textbox',
            name: 'col1',
            label: 'Column 1',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }, {
            type: 'textbox',
            name: 'col2',
            label: 'Column 2',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }, {
            type: 'textbox',
            name: 'col3',
            label: 'Column 3',
            multiline: true,
            minWidth: 300,
            minHeight: 100
          }],
          onsubmit: function(e) {
            // Insert content when the window form is submitted
            editor.insertContent('[row][col-4]' + e.data.col1 + '[/col-4][col-4]' + e.data.col2 + '[/col-4][col-4]' + e.data.col3 + '[/col-4][/row]');
          }
        });
      }
    });
    //col-4/col-4/col-4
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