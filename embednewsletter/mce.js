(function() {
   tinymce.PluginManager.add( 'custom_tinymce_button', function( editor, url ) {
      editor.addButton( 'custom_tinymce_button', {
         text: 'Embed Newsletter', // text displayed on the button
         icon: false,
         onclick: function() {
            // code to be executed when the button is clicked
			editor.windowManager.open( {
					title: 'Insert List',
					width: 400,
					height: 170,
					body: [
						{
							type: 'textbox',
							name: 'image_url',
							label: 'Image URL',
							
						},
						{
							type: 'textbox',
							name: 'link',
							label: 'Link',
							
						},
						{
							type: 'textbox',
							name: 'heading_txt',
							label: 'Heading Text',
							
						},

					],
					onsubmit: function( e ) {
						editor.insertContent( '[embednewsletter image_url="' + e.data.image_url + '" link="' + e.data.link + '" heading_txt="' + e.data.heading_txt + '"]');
					}
				});
         }
      });
   });
})();
