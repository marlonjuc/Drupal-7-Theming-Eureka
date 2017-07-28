(function($) {
	$.fn.customCheckbox = function($text) {
		$(this).each(function() {
			$this = $(this);
			$thisParent = $this.parent();
			$this.wrap('<div class="check-box"></div>');
			$('<label class="text" for="'+$this.attr("id")+'">'+$text+'</label>').insertAfter($this);
		  $('<span class="mask"></span>').insertAfter($this);
			return this;
		});
	}
})(jQuery);