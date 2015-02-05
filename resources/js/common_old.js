Core.init.add('body_advert_confirm', function() {
	$('.auth-form:not(:first)').hide();
	$('#change_auth_form input').change(function() {
		$('.auth-form').hide();
		$('div#form_' + $(this).val()).fadeIn();
	});
});

Core.init.add('body_adverts_view', function() {
	var images = $('.thumbnails .thumbnail a')
		.fancybox();
});

Core.init.add('body_advert_place', function() {
	$("#upload").html5_upload({
		url: '/ajax-file-upload',
		sendBoundary: true,
		onStart: function() {
			$('.progress')
				.fadeIn();
			return true;
		},
		onProgress: function(event, progress, name, number, total) {
			$('.progress .bar')
				.css('width', progress + '%');
		},
		onFinishOne: function(event, response, name, number, total) {
			
			$('.progress')
				.fadeOut(function(){
					$(this).width(0);
				});

			$.event.trigger( "ajaxComplete", [{responseText:response}] );
			
			var json = $.parseJSON(response);
	
			 $('#thumbnail').tmpl(json ).appendTo('#thumbnails');
		}
	});
	
	$('#thumbnails .delete').live('click', function() {
		var thumb = $(this).parent();
		var file = thumb.find('img').attr('src');
		
		$.post('/ajax-file-delete', {path: file}, function() {
			thumb.fadeOut(function() {
				$(this).remove();
			})
		})
		
		return false;
	});
	
	$('#category_id').on('change', function() {
		var id = parseInt($(this).val());
		
		var cont = $('#packages_container')
			.empty()
			.hide();
		
		$.post('/ajax-package-get', {cid: id}, function(resp) {
			cont.html(resp).show();
		});
	}).change();
});

Core.init.add(['body_action_category_add', 'body_action_category_edit'], function() {
	Advert_Category.form();
});

Core.init.add(['body_action_package_add', 'body_action_package_edit'], function() {
	Package.form();
});

$(document).ready(function() {
	
	// Выравнивание меню в футере по центру
	$('#footer .links').css('margin-left', ($('#footer').width() - $('#footer .links').width())/2);
	
	$('.button').button();
	
	$('#lang-select').change(function(){
		var lang = $(this).val();
		
		window.location = '?lang=' + lang;
	});

});

(function($){
	$.fn.button = function() {
		return this.each(function(){
			if($(this).hasClass('first'))
				$(this).append('<span class="lb"></span>');

			if($(this).hasClass('last'))
				$(this).append('<span class="rb"></span>');

			if($(this).hasClass('sep'))
				$(this).append('<span class="sb"></span>');
		});
	}
})(jQuery);