(function() {

	if(typeof tinymce != "undefined"){

		tinymce.create('tinymce.plugins.HoverSounds', {
			init : function(ed, url){
				ed.addCommand('aphs_shortcode_editor_button', function(){
					ed.windowManager.open({
						title: 'Hover Sounds Shortcode Generator',
						file: ajaxurl + (ajaxurl.indexOf('?') == -1 ? '?' : '&') + 'action=aphs_shortcode_editor',
						width : 800 + parseInt(ed.getLang('button.delta_width', 0), 10),
						height : 760 + parseInt(ed.getLang('button.delta_height', 0), 10),
						inline : 1
					}, {

						plugin_url : url
					});
				});
				ed.addButton('aphs_shortcode_editor', {title : 'Hover Sounds Shortcode Generator', cmd : 'aphs_shortcode_editor_button', image: url.substring(0,url.lastIndexOf("/js")) + '/images/icon.png' });
			},
			createControl: function(n, cm) {
				return null;
			}

		})

		tinymce.PluginManager.add('aphs_shortcode_editor', tinymce.plugins.HoverSounds);

	}

	(function($) {
	    'use strict';

	    $(document).ready(function() {
	        $(document).on( 'click', '#mce-modal-block', function() {
	            tinyMCE.activeEditor.windowManager.close();
	        });

    	});

	})(jQuery);

})();