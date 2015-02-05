var Core = {
	global: {},
	init: {
		callbacks: [],
		add: function(rout, callback) {
			if (typeof(callback) != 'function')
				return false;

			if (typeof(rout) == 'object') {
				for (var i=0; i < rout.length; i++)
					Core.init.callbacks.push([rout[i], callback]);
			}
			else if (typeof(rout) == 'string')
				Core.init.callbacks.push([rout, callback]);
			else
				return false;
		},
		run: function(body_id) {
			if(!body_id)
				var body_id = $('body:first').attr('id').toString();

			for (var i=0; i < Core.init.callbacks.length; i++) {
				var rout_to_id = Core.init.callbacks[i][0];

				if (body_id == rout_to_id)
					Core.init.callbacks[i][1]();
			}
		}
	},
	translations: {
		array: {},
		add: function(obj) {
			for (var i in obj) {
				Core.translations.array[i] = obj[i];
			}
		}
	},
	ui: {
		callbacks: [],
		add: function(module, callback) {
			if (typeof(callback) != 'function')
				return false;

			Core.ui.callbacks.push([module, callback]);
		},
		init: function() {
			for (var i=0; i < Core.ui.callbacks.length; i++) {
				Core.ui.callbacks[i][1]();
			}
			Form.init();
		}
	},
	filters: {
		filters: [],
		switchedOn: [],

		add: function( name, to_editor_callback, to_textarea_callback ) {
			if( to_editor_callback == undefined || to_textarea_callback == undefined ) {
				console.log('System try to add filter without required callbacks.', name, to_editor_callback, to_textarea_callback);
				return;
			}

			this.filters.push([ name, to_editor_callback, to_textarea_callback ]);
		},

		switchOn: function( textarea_id, filter ) {
			$( '#' + textarea_id ).css( 'display', 'block' );

			if( this.filters.length > 0 ) {
				this.switchOff( textarea_id );

				for( var i=0; i < this.filters.length; i++ ) {
					if( this.filters[i][0] == filter ) {
						try {
							this.filters[i][1]( textarea_id );
							this.switchedOn[textarea_id] = this.filters[i];
						} catch(e) {
							console.log('Errors with filter switch on!', e);
						}
						break;
					}
				}
			}
		},

		switchOff: function( textarea_id ) {
			for( var key in this.switchedOn ) {
				if( textarea_id != undefined && key != textarea_id )
					continue;

				try {
					if( this.switchedOn[key] != undefined && this.switchedOn[key] != null && typeof(this.switchedOn[key][2]) == 'function' ) {
						this.switchedOn[key][2]( textarea_id );
					}
				} catch(e) {
					console.log('Errors with filter switch off!', e);
				}

				if( this.switchedOn[key] != undefined || this.switchedOn[key] != null )
				{
					this.switchedOn[key] = null;
				}
			}
		}
	}
};

var Form = {
	is_init: false,
	popup: false,
	submit: $.Deferred(),
	response: null,
	afterSubmit: function(r, e) {},
	covert_data: function(arr) {
		var data = {};
		$.each(arr, function(){
			if(this.value instanceof Object)
				data[this.name] = Form.covert_data(this.value);
			else {
				if(this.name.substr(-2) == '[]') {
					this.name = this.name.slice(0, -2);
					try {
						data[this.name].push(this.value);
					} catch(e) {
						data[this.name] = [];
						data[this.name].push(this.value);
					}
				} else {
					data[this.name] = this.value;
				}
			}
		});

		return data;
	},
	init: function() {
		if(Form.is_init)
			return;

		Form.is_init = true;

		$('body')
		.undelegate('form.ajax')
		.delegate('form.ajax', 'submit', function() {
			Form.submit = $.Deferred();

			var $self = $(this),
			href = $self.attr('action');

			if(href.length == 0) {
				$.jGrowl('Не указанна ссылка для отправки данных');
				return false;
			}

			var post_data = $self.serialize();
			$.post(href, post_data, function(response){
				if(response.validation) {
					for(msg in response.validation) {
						$.jGrowl(response.validation[msg], {
							life: 7000
						});
					}
				}

				if(response.redirect && !Form.popup) {
					window.location = response.redirect
					return;
				}

				if($self.data('trigger'))
					$(document).trigger($self.data('trigger'), [response, $self]);

				Form.response = response;

				if(response.status === true) {
					Form.submit.resolve(Form.response, $self);
				} else {
					Form.submit.reject(Form.response, $self);
				}

				Form.afterSubmit(Form.response, $self);

			}, 'json');
			return false;
		});
	}
};

/*
 * TinyMCE js file must be loaded in the page
 */
var filterTinymce = {
        setupInitArr: {},
        settings: {
                mode : "textareas",
                theme : "advanced",
                plugins : "style, fullscreen",
                height : "250",
                width: '100%',
                theme_advanced_buttons1 : "formatselect,|,bold,italic,underline,separator,|,bullist,numlist,|,hr,removeformat,|,fullscreen",
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",


                // pre init event
                setup: function( editor )
                {
                        for (key in filterTinymce.setupInitArr)
                        {
                                editor.settings[key] = filterTinymce.setupInitArr[key];
                        }

                        editor.onKeyUp.add(function(ed, e) {
                                var $textarea = $('#'+ed.id);
                                $textarea.html(ed.getBody().innerHTML);
                        });
                },

                // when form before submit
                onchange_callback: function(html)
                {
                        return html;
                }
        },

        addSetting: function( key, value ){
                this.setupInitArr[key] = value;
        },

        switchOn_handler: function( textarea_id ){
                var ed = new tinyMCE.Editor( textarea_id, filterTinymce.settings ).render();
        },

        switchOff_handler: function( textarea_id ) {
                tinymce.get( textarea_id ).remove();
        }
};

var I18n = {};

// Skip errors when no access to console
var console = console || {
	log: function(){}
};

var __ = function(str) {
	if (Core.translations.array[str] !== undefined)
		return Core.translations.array[str];
	else
		return str;
};

// Error
Core.error = function(msg, e) {
	if (console != undefined)
		console.log(msg, e);
};

 Core.ui.add('tooltip', function() {
	 // select all desired input fields and attach tooltips to them
	$(":input[title]").tooltip({

		// place tooltip on the right edge
		position: "center right",

		// use the built-in fadeIn/fadeOut effect
		effect: "fade",

		tipClass: 'tooltip alert alert-info',

		offset: [0, 5],

		events: {
			def:     "mouseover,mouseout",
			input:   "focus,blur"
        },

		onBeforeShow: function(e) {
			$('.tooltip').hide();
		}

	});
	$("li[title]").tooltip({

		// place tooltip on the right edge
		position: "center right",

		// use the built-in fadeIn/fadeOut effect
		effect: "fade",

		tipClass: 'tooltip alert alert-info',

		offset: [0, 5],

		events: {
			input:   "mouseover,mouseout"
        },

		onBeforeShow: function(e) {
			$('.tooltip').hide();
		}

	});
 })

// Run
jQuery(document).ready(function()
{
	if( $.browser.msie )
		$('html:first').addClass('msie');

	Core.ui.init();

	Core.filters.add( 'tinymce', filterTinymce.switchOn_handler, filterTinymce.switchOff_handler );

	// init
	Core.init.run();

	$(document).ajaxComplete(function(e, response) {
		try {
			var json = $.parseJSON(response.responseText);

			if(typeof(json.location) == 'string')
			{
				window.location = json.location;
			}

			if(typeof(json.message) == 'string')
			{
				$.jGrowl(json.message);
			}
			else if(typeof(json.message) == 'object')
			{
				for(msg in json.message)
				{
					$.jGrowl(json.message[msg]);
				}
			}

		} catch(e) {}
	});
});
