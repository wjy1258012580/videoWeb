
<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<style>
		/* Always set the map height explicitly to define the size of the div
		 * element that contains the map. */
		#map {
			height: 100%;
		}
		/* Optional: Makes the page fill the window. */
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>
</head>
<body>
<div id="map"></div>
<script>
	// The map requires that user consent to location sharing when
	// prompted by your browser. If user see the error "The Geolocation service
	// failed.", it means user probably did not give permission for the browser to
	// locate you.
	var map, infoWindow;
	//create a init map, lat mean latitude, Ing mean longitude
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -34.397, lng: 150.644},
			zoom: 6
		});
		infoWindow = new google.maps.InfoWindow;

		// Try HTML5 geolocation.
		// Check if Geolocation is supported
		// get current user position, and set lat and ing to user current position
		if (navigator.geolocation) {

			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				infoWindow.setPosition(pos);
				infoWindow.setContent('Location found.');
				infoWindow.open(map);
				map.setCenter(pos);
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}
	}
	//When Geolocation not supported
	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
			'Error: The Geolocation service failed.' :
			'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);
	}
</script>

<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB15Lb1e5h-ohA1_gbzfkRl-DVCxKwAgEE&callback=initMap">
		//insert the api key to the link, api key create in google
</script>
</body>
</html>
