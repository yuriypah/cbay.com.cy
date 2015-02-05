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
	
	$.fn.digitalPanel = function() {
		return this.each(function(){
			var cont = $('.nums', this);
			var nums = cont.text().split('');
			
			cont.empty();
			for(num in nums)
				$('<i />')
					.text(nums[num])
					.appendTo(cont);
		});
	}

	// Checkbox status
	$.fn.check = function() {
		return this.each(function() {
			this.checked = true;
		});
	};

	$.fn.uncheck = function() {
		return this.each(function() {
			this.checked = false;
		});
	};

	$.fn.checked = function() {
		return this.attr('checked');
	};
})(jQuery);