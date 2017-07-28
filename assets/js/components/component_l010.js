var dataStores = [{
	"address": "No.14 Block C-01 To 04. Persiaran PerUShaan. Seksyen 23. 40300 Shah Alam",
	"address_additional": "",
	"email": "-",
	"latitude": "3.042656",
	"longitude": "101.529082",
	"nid": "13301",
	"node_city": "City test 1",
	"node_company_name": "Supply Chain",
	"node_country": "Test1",
	"node_fax": "-",
	"node_postal_code": "",
	"node_services": "5",
	"node_services_name": "Test1",
	"node_stat": "",
	"node_title": "Supply Chain - Selangor Darul Ehsan",
	"telephone": "+603-5541-1998 x301",
	"toll_free": "-"
	}, {
		"address": "No.14 Block C-01 To 04. Persiaran PerUShaan. Seksyen 23. 40300 Shah Alam",
		"address_additional": "",
		"email": "-",
		"latitude": "3.042656",
		"longitude": "103.529082",
		"nid": "13301",
		"node_city": "City test 2",
		"node_company_name": "Supply Chain",
		"node_country": "Test2",
		"node_fax": "-",
		"node_postal_code": "",
		"node_services": "5",
		"node_services_name": "Test2",
		"node_stat": "",
		"node_title": "Supply Chain - City test 2",
		"telephone": "+603-5541-1998 x301",
		"toll_free": "-"
	}, {
		"address": "No.14 Block C-01 To 04. Persiaran PerUShaan. Seksyen 23. 40300 Shah Alam",
		"address_additional": "",
		"email": "-",
		"latitude": "5.042656",
		"longitude": "101.529082",
		"nid": "13301",
		"node_city": "City test 3",
		"node_company_name": "Supply Chain",
		"node_country": "Test3",
		"node_fax": "-",
		"node_postal_code": "",
		"node_services": "5",
		"node_services_name": "Test3",
		"node_stat": "",
		"node_title": "Supply Chain - Selangor Darul Ehsan",
		"telephone": "+603-5541-1998 x301",
		"toll_free": "-"
	}
];

(function($){
	'use strict';
	Drupal.behaviors.where_to_buy = (function(){
		var _attach = function(context, settings){
			$('.where-to-buy', context)
				.once().each(function(i, section){
					var $section = $(section);
					( new where_to_buy($section) ).init();
				});
		};
		return {
			attach: _attach
		};
	})();

	function where_to_buy($el){
		this.$el = $el,
		this.$map,
		this.$markers = [];
		return this;
	}

	where_to_buy.prototype.init = function(){
		this
			.initMap()
			.bindSearchBox()
			.storeBoxClick();

		return this;
	};

	where_to_buy.prototype.initMap = function () {
		if(!UTIL.isMobile.any){
			//Create the map
			this.$map = new google.maps.Map(document.getElementById('map'), {
	  	});
		}
		return this;
	};

	where_to_buy.prototype.removeMarkers = function () {
		//Remove all markers
		$.each(this.$markers, function(){
			this.setMap(null)
		});
		//Empty markers array
		this.$markers = [];
	};

	where_to_buy.prototype.bindSearchBox = function () {
		var THIS = this;

		$('.input-search .search-icon', this.$el).on('click', function(){
			THIS.SearchBoxAction();
		});

		$('.input-search input', this.$el).on('keypress', function(e){
			if(e.which == 13){
				THIS.SearchBoxAction();
			}
		});

		return this;
	};

	where_to_buy.prototype.SearchBoxAction = function () {
		var $map = $('#map', this.$el);
		//If input has content
		if($('.input-search input').val().length >= 1){
			if(!UTIL.isMobile.any){
				//Remove all markers
				this.removeMarkers();
				//Show the map
				$map.addClass('active');
			}
			$('.search-content, .search-results', this.$el).addClass('active');
			//Remove all results
			$('.search-content .search-results', this.$el).remove();


			//dataStores -> API results
			this.renderResults(dataStores);
		}
	}

	where_to_buy.prototype.renderResults = function (stores) {
		var THIS = this;
		var totalStores = stores.length;
		var inputText = $('.input-search input', this.$el).val();

		//Create template - handlebars
		var resultsTemplate   = $("#result-box-template").html();
		var template = Handlebars.compile(resultsTemplate);
		var params = {
			totalResults: totalStores,
			searchText: inputText
		};
		var resultsBox = template(params);

		//Add result-box to the page
		$('.search-content', this.$el).append(resultsBox);

		//Render each store of stores
		$.each(stores, function() {
			THIS.createStore(this);
		});

		return this;
	};

	where_to_buy.prototype.createStore = function (store) {

		//Create template - handlebars
		var storeBoxTemplate   = $("#store-box-template").html();
		var template = Handlebars.compile(storeBoxTemplate);
		var params = {
			lat: store.latitude,
			lon: store.longitude,
			label: "1",
			title: "title",
			number: "2",
			name: store.node_city,
			place: "test place",
			distance: "10mi",
			direction: "test direction",
			phone: "222.333.4444",
			getDirection: "#getDirection",
			website: "#webSite"
		};
		var storeBox = template(params);

		//Put template into search results div
		$('.search-results', this.$el).append(storeBox);

		if(!UTIL.isMobile.any){
			//Add marker to map
			this.addMarker(store.latitude, store.longitude, store.node_city, "1");
		}
		
		return this;
	};

	where_to_buy.prototype.addMarker = function (lat, long, title, label, selected) {
		var markersPositions = [];
		var latlngbounds = new google.maps.LatLngBounds();

		var icon = 'https://k60.kn3.net/8/4/1/E/C/7/550.png';
		if(selected){
			icon = 'https://k61.kn3.net/5/0/5/4/F/5/A78.png';
		}
		var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, long),
        title: title,
        label: label,
        map: this.$map,
        icon: icon,
  	});

		//Add marker to markers array
		this.$markers.push(marker)

		
		//Get the center location and zoom of all markers
		$.each(this.$markers, function(){
			var newPosition = new google.maps.LatLng(this.getPosition().lat(), this.getPosition().lng());
			//Add marker location to array
			markersPositions.push(newPosition);
		});
		$.each(markersPositions, function(){
		  latlngbounds.extend(this);
		});

		//Change the location and zoom of the map
		this.$map.fitBounds(latlngbounds);
		//Change the first lng value, because we need the margen space of the result box
		latlngbounds.b.b = latlngbounds.b.b - 2.8;
		this.$map.setCenter(latlngbounds.getCenter());
		
		
		return this;
	};

	where_to_buy.prototype.getMarkersFromStores = function(){
		var THIS = this;
		//Remove all markers
		this.removeMarkers();
		$('.store-box', this.$el).each(function(){
			var $store = $(this);
			//Add marker of store
			THIS.addMarker($store.attr('data-lat'), $store.attr('data-lon'), $store.attr('data-title'), $store.attr('data-label'));
		});
	};

	where_to_buy.prototype.storeBoxClick = function () {
		var THIS = this;
		//Store box event
		$(this.$el).on('click', '.store-box', function(){
			//Remove all "selected" of stores boxes
			$('.store-box', this.$el).removeClass('selected');
			var $element = $(this);
			$element.addClass('selected');
			//Reset markers
			THIS.getMarkersFromStores();
			//Add selected marker
			THIS.addMarker($element.attr('data-lat'), $element.attr('data-lon'), $element.attr('data-title'), $element.attr('data-label') ,true);
		});
	};

})(jQuery);