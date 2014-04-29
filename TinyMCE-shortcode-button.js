
( function() {
    tinymce.PluginManager.add( 'TMCEBB_shortcode_button', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'TMCEBB_shortcode_button_key', {

            //text: 'Button',
            icon: 'dashicons icon-link',
            //icon: false,
            onclick: function() {
                // Open window
                editor.windowManager.open( {
                    title: 'Bootstrap Button Shortcode',
                    body: [{
                        type: 'textbox',
                        name: 'title',
                        label: 'Title'
                    },
                    {
                        type: 'textbox',
                        name: 'url',
                        label: 'URL'
                    }
                    ],
                    onsubmit: function( e ) {
                        // Insert content when the window form is submitted
                        editor.insertContent( '[button title=\''+e.data.title+'\' url=\''+e.data.url+'\']' );
                        //[button title='title' url='url']
                    }

                } );
            }

        } );

    } );

} )();


/*
tinymce.PluginManager.add( 'fb_button', buildButton( tinymce, '', 'FB Button', 'fb_button_key', false, 'Example Button'));

//function loadButton(buttonName, buttonKey, buttonText, buttonIcon, buttonTitle) {
//	tinymce.PluginManager.add( buttonName, buildButton( editor, url, buttonName, buttonKey, buttonText, buttonIcon, buttonTitle);
//}
/
function buildButton(editor, url, buttonName, buttonKey, buttonText, buttonIcon, buttonTitle) {
	// Add a button that opens a window
   var buttonSettings = {
	
		text: buttonName,
		icon: buttonIcon,
		onclick: function() {
			// Open window
			editor.windowManager.open( {
				title: buttonTitle,
				body: [{
					type: 'textbox',
					name: 'title',
					label: 'Title'
				}],
				onsubmit: function( e ) {
					// Insert content when the window form is submitted
					editor.insertContent( 'Title: ' + e.data.title );
				}
			} );
		}
	};
	console.log(buttonSettings);
	console.log(buttonKey);
	console.log(editor);
	editor.addButton( buttonKey, buttonSettings);
}
*/