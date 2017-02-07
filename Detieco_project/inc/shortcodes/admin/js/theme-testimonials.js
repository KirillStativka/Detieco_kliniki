frameworkShortcodeAtts={
	attributes:[
			{
				label:"How many testimonials to show?",
				id:"number",
				help:"This is how many recent testimonials will be displayed."
			},
			{
				label:"Order by",
				id:"order_by",
				controlType:"select-control",
				selectValues:['date', 'title', 'random'],
				help:"Choose the order by mode."
			},
			{
				label:"Order",
				id:"order",
				controlType:"select-control",
				selectValues:['DESC', 'ASC'],
				help:"Choose the order mode ( from Z to A or from A to Z)."
			},
			{
				label:"Custom class",
				id:"custom_class",
				help:"Use this field if you want to use a custom class."
			}
	],
	defaultContent:"",
	shortcode:"testimonials"
};