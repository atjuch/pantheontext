(function($) {
"use strict";
 


			//Shortcodes
			tinymce.PluginManager.add( 'ctShortcodes', function( editor, url ) {

				editor.addCommand("ctPopup", function ( a, params )
				{
					var popup = params.identifier;
					tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
				});
	 
				editor.addButton( 'ct_button', {
					type: 'splitbutton',
					icon: false,
					title:  'Insert Shortcode',
					onclick : function(e) {},
					menu: [
					{text: 'Add Row',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Add Row',identifier: 'row'})
					}},
					{text: 'Columns',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Columns',identifier: 'columns'})
					}},
					{text: 'Video',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Video',identifier: 'video_func'})
					}},
					{text: 'Soundcloud',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Soundcloud',identifier: 'soundcloud_func'})
					}},
					{text: 'Font Awesome Icons',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Font Awesome Icons',identifier: 'f_icons'})
					}},
					{text: 'Headings',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Headings',identifier: 'headings'})
					}},
					{text: 'Margins',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Margins',identifier: 'margins'})
					}},
					{text: 'Buttons',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Buttons',identifier: 'func_button'})
					}},
					{text: 'Highlights',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Highlights',identifier: 'highlights'})
					}},
					{text: 'Dropcaps',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Dropcaps',identifier: 'dropcaps'})
					}},
					/*{text: 'Clear',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Clear',identifier: '[clear]'})
					}},*/
					{text: 'Toggle',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Toggle',identifier: 'toggle_func'})
					}},
					{text: 'Tabs',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Tabs',identifier: 'tabs'})
					}},
					/*{text: 'Divider',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Divider',identifier: 'ct_dividers'})
					}},*/
					{text: 'Labels',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Labels',identifier: 'labels'})
					}},
					{text: 'Alerts',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Alerts',identifier: 'alerts'})
					}},
					{text: 'Progress Bars',onclick:function(){
						editor.execCommand("ctPopup", false, {title: 'Progress Bars',identifier: 'p_bars'})
					}},
					//List your shortcodes like this
					]

				
			  });
		 
		  });
		 

 
})(jQuery);