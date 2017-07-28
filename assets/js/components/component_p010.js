(function($) {

	Drupal.behaviors.p010 = (function(){
	    var _attach = function(context, settings) {
	    	$(".plp_filters", context)
	    		.once()
	    		.each(function(i, section){
						(new Filter($(section))).init();
					});
	    };

	    return {
	        attach: _attach
	    };

	})();

  var $sections;

  function Filter($section){
      this.$el = $section;
      this.$filter_buttons = this.$el.find('.filter-buttons .filters');
      this.$elementIconsClasses = ['icon-icon-light-up', 'icon-icon-light-down','icon-icon-close', 'icon-icon-plus'];
	  this.$el.find(".clear-all-btn .clear-all").addClass("disabled");
      return this;
  }

	Filter.prototype.init = function(){
    this
      .applyCheckBoxPlugin()
		  .addDrupalEventListener()
		  .addDrupalEventListenerAfterLoads()
      .UIEvents();
    return this;
  };

	//add event listener to count selected products on PLP
	Filter.prototype.addDrupalEventListener = function () {
		var $section = this.$el;
		var $compareButton = $section.find(".button.secondary a.compare-link");
		var $buttonCopy = "Compare";
		Drupal.behaviors.events.subscribe('compare-count-changed', function() {
			var counter = parseInt(Drupal.settings.compare.count);
			if(counter == 0) {
				$compareButton.text($buttonCopy);
				$compareButton.parent().addClass("disabled");
			} else {
				$compareButton.text($buttonCopy + " (" + counter + ")");
			}
			if(counter >= 2) {
				$compareButton.parent().removeClass("disabled");
			} else {
				$compareButton.parent().addClass("disabled");
			}
		});
		return this;
	};

	Filter.prototype.addDrupalEventListenerAfterLoads = function () {
		var $section = this.$el;
		Drupal.behaviors.events.subscribe("compare-count-loaded", function(selectedCheckboxes) {
			var $compareButton = $section.find(".button.secondary a.compare-link");
			var buttonCopy = "Compare";
			var counter = parseInt(selectedCheckboxes);
			if(counter == 0) {
				$compareButton.text(buttonCopy);
				$compareButton.parent().addClass("disabled");
			} else {
				$compareButton.text(buttonCopy + " (" + counter + ")");
			}
			if(counter >= 2) {
				$compareButton.parent().removeClass("disabled");
			} else {
				$compareButton.parent().addClass("disabled");
			}
		});
		return this;
	};

	Filter.prototype.applyCheckBoxPlugin = function (){
		var $original_this = this;
		var $section = this.$el;
		$('li input[type="checkbox"]',this.$el)
  		.each(function() { //Each checkbox
  			var $this = $(this);
  			var $thisParent = $this.parent();
  			var $text = '';

  			//If checkbox have anchor NOT ACTIVE
				if($thisParent.find('a:not(.facetapi-active)').length > 0){
					var $anchor = $thisParent.find('a');
					$anchor.find('span').remove();
					$text = $anchor.text();
					$anchor.remove();
				}else{
					//Get checkbox text
					var $textField = $thisParent.contents().filter(function() {
						return this.nodeType == 3;
					});
					$text = $textField.text();
					$textField.remove();
				}

				//Apply customCheckbox plugin to checkbox
				$this.customCheckbox($text);

				  if($this.is(':checked')){
					//Desactivate Clear All Button button
	  				$section.find(".clear-all-btn .clear-all").removeClass("disabled");
				  	//Each filter "Activity, Size, ..."
				  	var $list = $this.closest('.item-list');
				  	$list.addClass('open'); //Show filter box
				  	$('.filter-content',this.$el).addClass('open');	//Show filters

				  	//Add icon up arrow and remove icon down arrow
				  	$list
				  		.prev()
				  		.addClass('open')
				  		.find('span')
				  		.addClass($original_this.$elementIconsClasses[0])
				  		.removeClass($original_this.$elementIconsClasses[1]);

				  	//Add icon close and remove icon "+"
				  	$('.filter-buttons .filter', this.$el)
				  		.addClass('open')
				  		.find('span')
				  		.addClass($original_this.$elementIconsClasses[2])
				  		.removeClass($original_this.$elementIconsClasses[3]);

				  	//Show button "clear all"
				  	$('.clear-all-btn .clear-all', this.$el).removeClass('hide');

				}
			});
    return this;
  };

  Filter.prototype.UIEvents = function(){
  	var $original_this = this;
		$('.box-filter .title', this.$el).on('click', function(){
			var $this = $(this);
			var $FilterBox = $this.next();
			var $icon = $this.find('.toggle-box');

			if($this.hasClass('open')){
				//Add icon down arrow and remove icon up arrow
				$icon
					.addClass($original_this.$elementIconsClasses[1])
					.removeClass($original_this.$elementIconsClasses[0]);
			}else{
				//Add icon up arrow and remove icon down arrow
				$icon
					.addClass($original_this.$elementIconsClasses[0])
					.removeClass($original_this.$elementIconsClasses[1]);
			}

			$FilterBox.toggleClass('open'); //Hide or show filter box div
			$this.toggleClass('open');
		});


		//Filter and Shor button functionality
		this.$filter_buttons.on('click', function(){
			var $this = $(this);
			var $openFilter = $this.data('filter');
			var $content = $('.'+ $openFilter +'-content', $original_this.$el);
			var $openCategory = $this.parent().find('.open');

			if($openCategory.data('filter') === $openFilter){
				//Add icon class plus "+" and remove icon close class
				$this
					.find('span')
					.addClass($original_this.$elementIconsClasses[3])
					.removeClass($original_this.$elementIconsClasses[2]);
				//Hide the box
				$content.removeClass('open');
			}else{
				//Close all filters
				$('.filter-box').removeClass('open');

				//Remove open on filter botton
				$this
					.parent()
					.find('.open')
					.removeClass('open');

				//Add icon class plus "+" and remove icon close class
				$this
					.parent()
					.find('.filter span')
					.addClass($original_this.$elementIconsClasses[3])
					.removeClass($original_this.$elementIconsClasses[2]);

				//Add icon class close and remove icon plus class "+"
				$this
					.find('span')
					.addClass($original_this.$elementIconsClasses[2])
					.removeClass($original_this.$elementIconsClasses[3]);

				//Expand the box
				$content.addClass('open');
			}
				$this.toggleClass('open');

				//Show or hide clear all bottom button
				UTIL
	        .media
	        .once('sm', function(){
	        	$('.clear-all-btn.bottom .clear-all').toggleClass('hide');
	        });
		});

	  //Init Help Tooltip on filters
	  UTIL.tooltip.init(this.$el,'.tooltip-help');

  };

})(jQuery);
