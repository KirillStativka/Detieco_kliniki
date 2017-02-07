frameworkShortcodeAtts={
	attributes:[
			{
				label:"Button Text",
				id:"text",
				help:"Enter the text for button."
			},
			{
				label:"Button Link",
				id:"link",
				help:"Enter the link for button. (e.g. http://demolink.org)"
			},
			{
				label:"Target",
				id:"target",
				controlType:"select-control",
				selectValues:['_blank', '_self', '_parent', '_top'],
				defaultValue: '_self',
				defaultText: '_self',
				help:"The target attribute specifies a window or a frame where the linked document is loaded."
			},
			{
				label:"Class",
				id:"class",
				help:"Any CSS classes you want to add."
			}
	],
	defaultContent:"",
	shortcode:"button"
};