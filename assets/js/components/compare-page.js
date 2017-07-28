(function($){

	Drupal.behaviors.comparePage = (function(){
	    var _attach = function(context, settings) {
	    	$(".compare", context)
	    		.once()
	    		.each(function(i, section){
						(new Compare($(section))).init();
					});
	    };

	    return {
	        attach: _attach
	    };

	})();

	function Compare($section){
    this.$el = $section;
    return this;
  }

	Compare.prototype.init = function(){
    this
      .compare_row_modify()
		  .compareItems()
		  .bindEventsToUI();
		  
    return this;
  };


  Compare.prototype.compare_row_modify = function () {
  	//Add the specific class to rows
		var newClass,  newClassItem = '';
		var $items = $('.compare_product-item:not(.not-set)', this.$el);

		//Select the correct class depending how much items.
		switch ($items.length) {
	    case 2:
	        newClass = "col-sm-8 col-md-6";
	        newClassItem = "col-xs-6 col-sm-6 col-md-6";
	        break;
	    case 3:
	        newClass = "col-sm-12 col-md-9";
	        newClassItem = "col-xs-4 col-sm-4 col-md-4";
	        break;
	    case 4:
	        newClass = "col-sm-12 col-md-12";
	        newClassItem = "col-xs-3 col-sm-3 col-md-3";
	        break;
		}

		$('.compare_pair', this.$el).addClass(newClass);
		$('.compare_pair .item-different', this.$el).addClass(newClassItem);
    return this;
  };

  Compare.prototype.compareItems = function () {
  	this.$el.find('.compare_pair').each(function() {
			var $this = $(this);
			var $previousDiv;
			//Find all div content of the row
			$this.find('div div').each(function(){
				if($previousDiv !== undefined){
					//If $previusDiv content is different to the actual div content
					if($previousDiv.html() !== $(this).html()){
						$this.addClass('row-different different')
					}
				}
				//Add the actual div to compare in the next cycle
				$previousDiv = $(this);
			});
		});
    return this;
  };


  Compare.prototype.bindEventsToUI = function () {
  	var $compare = this.$el;
 		//Show or hide highlight functionality
		$compare.find('.compare_goback a').on('click',function(e) {
			e.preventDefault();
			window.history.back();
		});

		$compare.find('.compare_remove-hightlight').on('click',function(e) {
			e.preventDefault();
			var $this = $(this);

			if($this.hasClass('show_details')) {
				$this.text('REMOVE HIGHLIGHT');
			}else {
				$this.text('SHOW HIGHLIGHT');
			}

			$this.toggleClass('show_details');
			$compare.find('.row-different').toggleClass('different');
		});
    return this;
  };

})(jQuery);