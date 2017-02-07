(function() {
	// TinyMCE plugin start.
	tinymce.PluginManager.add( 'TinyMCEShortcodes', function( editor, url ) {
		// Register a command to open the dialog.
		editor.addCommand( 'open_dialog', function( ui, v ) {
			SelectedShortcodeType = v;
			selectedText = editor.selection.getContent({format: 'text'});
			tb_dialog_helper.loadShortcodeDetails();
			tb_dialog_helper.setupShortcodeType( v );

			jQuery( '#shortcode-options' ).addClass( 'shortcode-' + v );
			jQuery( '#selected-shortcode' ).val( v );

			var f=jQuery(window).width();
				b=jQuery(window).height();
				f=720<f?720:f;
				f-=80;
				b-=84;

			tb_show( "Insert ["+ v +"] shortcode", "#TB_inline?inlineId=dialog" );
		});

		// Register a command to insert the self-closing shortcode immediately.
		editor.addCommand( 'insert_self_immediate', function( ui, v ) {
			editor.insertContent( '[' + v + ']' );
		});

		// Register a command to insert the enclosing shortcode immediately.
		editor.addCommand( 'insert_immediate', function( ui, v ) {
			var selected = editor.selection.getContent({format: 'text'});

			editor.insertContent( '[' + v + ']' + selected + '[/' + v + ']' );
		});

		// Register a command to insert the N-enclosing shortcode immediately.
		editor.addCommand( 'insert_immediate_n', function( ui, v ) {
			var arr = v.split('|'),
				selected = editor.selection.getContent({format: 'text'}),
				sortcode;

			for (var i = 0, len = arr.length; i < len; i++) {
				if (0 === i) {
					sortcode = '[' + arr[i] + ']' + selected + '[/' + arr[i] + ']';
				} else {
					sortcode += '[' + arr[i] + '][/' + arr[i] + ']';
				};
			};
			editor.insertContent( sortcode );
		});

		// Register a command to insert `Tabs` shortcode.
		editor.addCommand( 'insert_tabs', function( ui, v ) {
			editor.insertContent( '[tabs direction="top" tab1="Title #1" tab2="Title #2" tab3="Title #3"] [tab1] Tab 1 content... [/tab1] [tab2] Tab 2 content... [/tab2] [tab3] Tab 3 content... [/tab3] [/tabs]' ); // direction - top, right, below, left
		});

		// Register a command to insert `Accordion` shortcode.
		editor.addCommand( 'insert_accordions', function( ui, v ) {
			editor.insertContent( '[accordions] [accordion title="title1" visible="yes"] tab content [/accordion] [accordion title="title2"] another content tab [/accordion] [/accordions]' );
		});

		// Register a command to insert `Table` shortcode.
		editor.addCommand( 'insert_table', function( ui, v ) {
			editor.insertContent( '[table td1="#" td2="Title" td3="Value"] [td1] 1 [/td1] [td2] some title 1 [/td2] [td3] some value 1 [/td3] [/table]' );
		});

		// Add a button that opens a window
		editor.addButton( 'shortcodes_button', {
			type: 'menubutton',
			icon: 'icon icon-puzzle-piece',
			tooltip: 'Insert a Shortcode',
			menu: [
				//// Posts menu.
				//{text: 'Posts', menu: [
				//	{text: 'Posts Grid', onclick: function() { editor.execCommand( 'open_dialog', false, 'posts_grid', { title: 'Posts Grid' } ); } },
				//	{text: 'Posts List', onclick: function() { editor.execCommand( 'open_dialog', false, 'posts_list', { title: 'Posts List' } ); } },
				//	//{text: 'Recent Testimonials', onclick: function() { editor.execCommand( 'open_dialog', false, 'testimonials', { title: 'Recent Testimonials' } ); } },
				//	//{text: 'Team', onclick: function() { editor.execCommand( 'open_dialog', false, 'team', { title: 'Team' } ); } }
				//]},
				//// Basic menu.
				//{text: 'Basic', menu: [
				//	{text: 'Banner', onclick: function() { editor.execCommand( 'open_dialog', false, 'banner', { title: 'Banner' } ); } },
				//	{text: 'Comments', onclick: function() { editor.execCommand( 'open_dialog', false, 'recentcomments', { title: 'Comments' } ); } },
				//	{text: 'Service Box', onclick: function() { editor.execCommand( 'open_dialog', false, 'service_box', { title: 'Service Box' } ); } },
				//	{text: 'Categories', onclick: function() { editor.execCommand( 'open_dialog', false, 'categories', { title: 'Categories' } ); } },
				//	{text: 'Tags', onclick: function() { editor.execCommand( 'insert_self_immediate', false, 'tags', { title: 'Tags' } ); } },
				//]},
				// Columns menu.
				//{text: 'Columns', menu: [
				//	{text: 'row', onclick: function() { editor.execCommand( 'insert_immediate', false, 'row', { title: 'row' } ); } },
				//	{text: 'row inner', onclick: function() { editor.execCommand( 'insert_immediate', false, 'row_in', { title: 'row inner' } ); } },
				//	{text: 'span1', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span1', { title: 'span1' } ); } },
				//	{text: 'span2', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span2', { title: 'span2' } ); } },
				//	{text: 'span3', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span3', { title: 'span3' } ); } },
				//	{text: 'span4', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span4', { title: 'span4' } ); } },
				//	{text: 'span5', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span5', { title: 'span5' } ); } },
				//	{text: 'span6', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span6', { title: 'span6' } ); } },
				//	{text: 'span7', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span7', { title: 'span7' } ); } },
				//	{text: 'span8', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span8', { title: 'span8' } ); } },
				//	{text: 'span9', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span9', { title: 'span9' } ); } },
				//	{text: 'span10', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span10', { title: 'span10' } ); } },
				//	{text: 'span11', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span11', { title: 'span11' } ); } },
				//	{text: 'span12', onclick: function() { editor.execCommand( 'insert_immediate', false, 'span12', { title: 'span12' } ); } }
				//]},
				// Fluid Columns menu.
				//{text: 'Fluid Columns', menu: [
				//	{text: 'row fluid', onclick: function() { editor.execCommand( 'insert_immediate', false, 'row_fluid', { title: 'row fluid' } ); } },
				//	{text: '1/2', onclick: function() { editor.execCommand( 'insert_immediate', false, 'one_half', { title: '1/2' } ); } },
				//	{text: '1/3', onclick: function() { editor.execCommand( 'insert_immediate', false, 'one_third', { title: '1/3' } ); } },
				//	{text: '2/3', onclick: function() { editor.execCommand( 'insert_immediate', false, 'two_third', { title: '2/3' } ); } },
				//	{text: '1/4', onclick: function() { editor.execCommand( 'insert_immediate', false, 'one_fourth', { title: '1/4' } ); } },
				//	{text: '3/4', onclick: function() { editor.execCommand( 'insert_immediate', false, 'three_fourth', { title: '3/4' } ); } },
				//	{text: '1/6', onclick: function() { editor.execCommand( 'insert_immediate', false, 'one_sixth', { title: '1/6' } ); } },
				//	{text: '5/6', onclick: function() { editor.execCommand( 'insert_immediate', false, 'five_sixth', { title: '5/6' } ); } }
				//]},
				// 2 Columns menu.
				//{text: '2 Columns', menu: [
				//	{text: '1/2 | 1/2', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span6|span6', { title: '1/2 | 1/2' } ); } },
				//	{text: '2/3 | 1/3', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span8|span4', { title: '2/3 | 1/3' } ); } },
				//	{text: '1/3 | 2/3', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span4|span8', { title: '1/3 | 2/3' } ); } }
				//]},
				//// 3 Columns menu.
				//{text: '3 Columns', menu: [
				//	{text: '1/3 | 1/3 | 1/3', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span4|span4|span4', { title: '1/3 | 1/3 | 1/3' } ); } },
				//	{text: '1/2 | 1/4 | 1/4', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span6|span3|span3', { title: '1/2 | 1/4 | 1/4' } ); } },
				//	{text: '1/4 | 1/2 | 1/4', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span3|span6|span3', { title: '1/4 | 1/2 | 1/4' } ); } },
				//	{text: '1/4 | 1/4 | 1/2', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span3|span3|span6', { title: '1/4 | 1/4 | 1/2' } ); } }
				//]},
				//// 4 Columns menu.
				//{text: '4 Columns', menu: [
				//	{text: '1/4 | 1/4 | 1/4 | 1/4', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'span3|span3|span3|span3', { title: '1/4 | 1/4 | 1/4 | 1/4' } ); } }
				//]},
				// Elements menu.
				{text: 'Elements', menu: [
					//{text: 'Button', onclick: function() { editor.execCommand( 'open_dialog', false, 'button', { title: 'Button' } ); } },
					//{text: 'Blockquote', onclick: function() { editor.execCommand( 'insert_immediate', false, 'blockquote', { title: 'Blockquote' } ); } },
					//{text: 'Promo text', onclick: function() { editor.execCommand( 'insert_immediate', false, 'promo', { title: 'Promo text' } ); } },
					//{text: 'Marked text', onclick: function() { editor.execCommand( 'insert_immediate', false, 'mark', { title: 'Marked text' } ); } },
					{text: 'Email', onclick: function() { editor.execCommand( 'insert_self_immediate', false, 'email', { title: 'Email' } ); } },
					{text: 'Site url', onclick: function() { editor.execCommand( 'insert_self_immediate', false, 'site_url', { title: 'Site url' } ); } },
					{text: 'Template url', onclick: function() { editor.execCommand( 'insert_self_immediate', false, 'template_url', { title: 'Template url' } ); } },
					//{text: 'Progressbar', onclick: function() { editor.execCommand( 'open_dialog', false, 'progressbar', { title: 'Progressbar' } ); } },
					//{text: 'Address', onclick: function() { editor.execCommand( 'insert_immediate', false, 'address', { title: 'Address' } ); } },
				]},
				// Misc menu.
				//{text: 'Misc', menu: [
				//	{text: 'Template URL', onclick: function() { editor.execCommand( 'insert_self_immediate', false, 'template-url', { title: 'Template URL' } ); } },
				//	{text: 'Site URL', onclick: function() { editor.execCommand( 'insert_self_immediate', false, 'site-url', { title: 'Site URL' } ); } },
				//	{text: 'Email', onclick: function() { editor.execCommand( 'insert_immediate_n', false, 'email', { title: 'Email' } ); } },
				//	{text: 'Title', onclick: function() { editor.execCommand( 'open_dialog', false, 'title', { title: 'Title' } ); } },
				//	{text: 'Sitemap', onclick: function() { editor.execCommand( 'open_dialog', false, 'site_map', { title: 'Sitemap' } ); } },
				//	//{text: 'Video Preview', onclick: function() { editor.execCommand( 'open_dialog', false, 'video_preview', { title: 'Video Preview' } ); } },
				//	//{text: 'Tabs', onclick: function() { editor.execCommand( 'insert_tabs', false, 'tabs', { title: 'Tabs' } ); } },
				//	//{text: 'Accordion', onclick: function() { editor.execCommand( 'insert_accordions', false, 'accordions', { title: 'Accordion' } ); } },
				//	{text: 'Table', onclick: function() { editor.execCommand( 'insert_table', false, 'table', { title: 'Table' } ); } },
				//	{text: 'Pricing Table', onclick: function() { editor.execCommand( 'open_dialog', false, 'chp_pricing_table', { title: 'Pricing Table' } ); } },
				//	{text: 'Google Map', onclick: function() { editor.execCommand( 'open_dialog', false, 'map', { title: 'Google Map' } ); } },
				//]}
			]
		});
	}); // TinyMCE plugin end.
})();