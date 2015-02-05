function CoreObject() {
	this.object_name = null;
	this.popup = null;

	this.fields = [];
	this._fields = {};

	this.init_object_name = function () {
		for (var name in this.global)
			if (this.global[name] == this)
				this.object_name = name.toLowerCase();
	}

	this.init_popup = function () {
		this.popup = new PopupObject(this);

		$(document).trigger(this.object_name + '.init_popup', [this.popup]);
	}
}

CoreObject.prototype.global = this
CoreObject.prototype.form = function() {}

CoreObject.prototype.del = function(element, params) {
	$.post('/ajax-'+ this.object_name + '-delete' , params, function(response) {
		if(response.status === false)
				return false;

		var element_pos = element.offset();

		element
			.css({
				position: 'absolute',
				width: element.width()
			})
			.animate({
				left: '+=50px'
			}, 100)
			.animate({
				opacity: 0,
				left: '-='+element_pos.left+'px'
			}, 500, function() {
				element.remove();
			});
	})
};

CoreObject.prototype.favorite = function(object_id, element) {
	var $anchor = $(element);

	$.post('/ajax-favourite-set', {
		object_name: this.object_name,
		object_id: object_id
	}, function(response) {
		if(response.status === false) { // Удален
			$('.icon', $anchor).removeClass('icon-yellow');
		} else { // Добавлен
			$('.icon', $anchor).addClass('icon-yellow');
		}
	}, 'json');

	return false;
}

CoreObject.prototype.init = function(config) {
	$.extend(this, config);

	if(!this.object_name)
		this.init_object_name();

	if(!this.popup)
		this.init_popup();

	for (field in this.fields) {
		this._fields[this.fields[field]] = 'form_' + this.object_name + '_' + this.fields[field];
	}

	return this;
}

function PopupObject(Obj, config) {
	this.button = 'form_' + Obj.object_name + '_add';
	this.field = 'form_' + Obj.object_name + '_id';

	var $this = this;

	this.afterShow = function(element) {

		$('.popup', '#fancybox-content').remove();

		Obj.form();

		var field = this.field;

		Form.popup = true;
		Form.afterSubmit = function(response, element) {
			if(response.status === false)
				return false;

			$this.appendData(response, field)

			Obj.form();

			Form.popup = false;
			$.fancybox.close();
		};
	};

	if(config)
		$.extend(this, config);
}

PopupObject.prototype.appendData = function(response, field) {
	var lang = data.lang;
	var title = data.parts[lang].title;

	$('#' + field)
		.append('<option value="'+response.data.id+'" selected="selected">'+title+'</option>');
};

PopupObject.prototype.load = function(field, button, callback) {
	if(field)
		this.field = field;

	if(!button)
		button = this.button

	if (typeof(callback) != 'function')
		callback = this.afterShow;

	return $('#' + button).fancybox({
		overlayOpacity: 0.1,
		speedIn: 10, speedOut: 10,
		overlayColor: '#000',
		onComplete: $.proxy(callback, this)
	});
};


var Advert_Category = new CoreObject();
Advert_Category
	.init({
		fields: ['ratio', 'packages[]'],
		form: function() {
			Advert_Category_Group.popup.load();
			Package.popup.load();
		}
	});

var Advert_Category_Group = new CoreObject();
Advert_Category_Group
	.init({
		fields: [],
		form: function() {

		}
	});

var Package = new CoreObject();
Package
	.init({
		fields: ['amount', 'discount'],
		form: function() {
			Package_Option.popup.load();
		}
	});

var Package_Option = new CoreObject();
Package_Option
	.init({
		fields: ['duration', 'amount', 'type'],
		form: function() {

		}
	});

Package_Option.popup.appendData = function(response, field) {
	var data = response.data;
	var lang = response.lang;
	var title = response.parts[lang].title;

	var table = $('#package_options tbody');

	var row = '<tr>' +
		'<td><input type="checkbox" name="options[]" value="' + data.id + '"></td>' +
		'<td>' + title + '</td>' +
		'<td>' + data.type + '</td>' +
		'<td>' + data.amount + '</td>' +
		'<td>' + data.duration / 86400 + '</td>' +
		'</tr>';

	table.append(row);
}