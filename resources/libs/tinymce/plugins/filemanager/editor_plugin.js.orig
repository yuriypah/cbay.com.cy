/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */


(function() {
	tinymce.create('tinymce.plugins.FileManagerPlugin', {
	
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {

			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('OpenBrowser', function() {
				jQuery.fancybox({
					width: 600,
					height: 600,
					autoSize: false,
					wrapCSS: 'fancybox-modal',
					padding: 0,
					href: '/ajax-amazon-uploader',
					type: 'ajax',
					helpers: {
						overlay: {
							opacity: 0.3
						}
					},
				});
			});

			// Register example button
			ed.addButton('filemanager', {
				title : 'Amazon S3 file manager',
				cmd : 'OpenBrowser',
				image : url + '/img/amazon.png'
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Amazon S3 File Manager',
				author : 'ButscH',
				authorurl : '',
				infourl : '',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('filemanager', tinymce.plugins.FileManagerPlugin);
})();