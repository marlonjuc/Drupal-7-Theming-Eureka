<div class="where-to-buy">

		<div class="title">Where to buy</div>
		<div class="search-content">

			<div id="map"></div>

			<div class="input-search">
				<div class="search">
					<input type="text" placeholder="Enter City, State or ZIP">
					<span class="search-icon icon-icon-search"></span>
				</div>
			</div>

			<div class="label">
				FIND GEAR IN YOUR NECK OF THE WOODS
			</div>


		</div>
</div> <!-- /END .container-fluid -->

<!-- Handlebars templates -->

<!-- Result box template -->
<script id="result-box-template" type="text/x-handlebars-template">
	<div class="search-results active">
		<div class="search-text">
			<div class="all-results">SEARCH FOUND {{totalResults}} STORES</div>
			<div class="near-stores">ALL STORES NEAR {{searchText}}</div>
		</div>
	</div>
</script>

<!-- Store box template -->
<script id="store-box-template" type="text/x-handlebars-template">
	<div class="store-box" data-lat="{{lat}}" data-lon="{{lon}}" data-label="{{label}}" data-title="{{title}}">
		<div class="locator">
			<span class="icon-marker icon-locator"></span>
			<span class="number">{{number}}</span>
		</div>
		<div class="store-content">
			<div class="name">{{name}}</div>
			<table>
				<tr>
					<td>{{place}}</td>
					<td>{{distance}}</td>
				</tr>
				<tr>
					<td>{{direction}}</td>
					<td>{{phone}}</td>
				</tr>
				<tr>
					<td><a href="{{getDirection}}">Get Directions</a></td>
					<td><a href="{{website}}">Dealer Website</a></td>
				</tr>
			</table>
		</div>
	</div>
</script>

<!--End Handlebars templates -->

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9aHVThNIj6PaeDiDG5jI8EB7e5AQjupg"></script>