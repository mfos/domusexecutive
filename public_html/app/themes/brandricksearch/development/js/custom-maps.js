function ramsbottomOffice() {
		
		var myLatlng = new google.maps.LatLng(53.338058,-2.973872); // Add the coordinates
		var mapOptions = {
			zoom: 14, // The initial zoom level when your map loads (0-20)
			minZoom: 6, // Minimum zoom level allowed (0-20)
			maxZoom: 17, // Maximum soom level allowed (0-20)
			zoomControl:true, // Set to true if using zoomControlOptions below, or false to remove all zoom controls.
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT // Change to SMALL to force just the + and - buttons.
			},
			center: myLatlng, // Centre the Map to our coordinates variable
			mapTypeId: google.maps.MapTypeId.ROADMAP, // Set the type of Map
			scrollwheel: false, // Disable Mouse Scroll zooming (Essential for responsive sites!)
			// All of the below are set to true by default, so simply remove if set to true:
			panControl:false, // Set to false to disable
			mapTypeControl:false, // Disable Map/Satellite switch
			scaleControl:false, // Set to false to hide scale
			streetViewControl:false, // Set to disable to hide street view
			overviewMapControl:false, // Set to false to remove overview control
			rotateControl:false // Set to false to disable rotate control
	  	}
		var map = new google.maps.Map(document.getElementById('map-canvas-ramsbottomoffice'), mapOptions); // Render our map within the empty div
		
		var image = new google.maps.MarkerImage("/wp-content/themes/penkethgroup/images/penkethMarker.png", null, null, null, new google.maps.Size(48,60)); // Create a variable for our marker image.
			
		var marker = new google.maps.Marker({ // Set the marker
			position: myLatlng, // Position marker to coordinates
			icon:image, //use our image as the marker
			map: map, // assign the marker to our map variable
			title: 'Click to visit our company on Google Places' // Marker ALT Text
		});
		
		// 	google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker 
		//		window.location='http://www.snowdonrailway.co.uk/shop_and_cafe.php'; // URL to Link Marker to (i.e Google Places Listing)
		// 	});
		
		var infowindow = new google.maps.InfoWindow({ // Create a new InfoWindow
  			content:'<div class="map-content"><div class="mc-address"><span>Penketh Group</span><p>Bassendale Road<br>Croft Business Park <br>Bromborough <br>Wirral, CH62 3QL</p></div><div class="mc-image clearfix"><img src="/wp-content/themes/penkethgroup/images/head-mapinfo.png" alt="Map Info Image"></div></div>' // HTML contents of the InfoWindow
  		});
		google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
  			infowindow.open(map,marker); // Open our InfoWindow
  		});
		
		google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(myLatlng); }); // Keeps the Pin Central when resizing the browser on responsive sites
	}
function maidenheadOffice() {
		
		var myLatlng = new google.maps.LatLng(53.478954,-2.238727); // Add the coordinates
		var mapOptions = {
			zoom: 14, // The initial zoom level when your map loads (0-20)
			minZoom: 6, // Minimum zoom level allowed (0-20)
			maxZoom: 17, // Maximum soom level allowed (0-20)
			zoomControl:true, // Set to true if using zoomControlOptions below, or false to remove all zoom controls.
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT // Change to SMALL to force just the + and - buttons.
			},
			center: myLatlng, // Centre the Map to our coordinates variable
			mapTypeId: google.maps.MapTypeId.ROADMAP, // Set the type of Map
			scrollwheel: false, // Disable Mouse Scroll zooming (Essential for responsive sites!)
			// All of the below are set to true by default, so simply remove if set to true:
			panControl:false, // Set to false to disable
			mapTypeControl:false, // Disable Map/Satellite switch
			scaleControl:false, // Set to false to hide scale
			streetViewControl:false, // Set to disable to hide street view
			overviewMapControl:false, // Set to false to remove overview control
			rotateControl:false // Set to false to disable rotate control
	  	}
		var map = new google.maps.Map(document.getElementById('map-canvas-maidenheadoffice'), mapOptions); // Render our map within the empty div
		
		var image = new google.maps.MarkerImage("/wp-content/themes/penkethgroup/images/penkethMarker.png", null, null, null, new google.maps.Size(48,60)); // Create a variable for our marker image.
			
		var marker = new google.maps.Marker({ // Set the marker
			position: myLatlng, // Position marker to coordinates
			icon:image, //use our image as the marker
			map: map, // assign the marker to our map variable
			title: 'Click to visit our company on Google Places' // Marker ALT Text
		});
		
		// 	google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker 
		//		window.location='http://www.snowdonrailway.co.uk/shop_and_cafe.php'; // URL to Link Marker to (i.e Google Places Listing)
		// 	});
		
		var infowindow = new google.maps.InfoWindow({ // Create a new InfoWindow
  			content:'<div class="map-content"><div class="mc-address"><span>Penketh Group</span><p>8th Floor<br>Neo Building</br>9 Charlotte Street<br>Manchester, M1 4ET</p></div><div class="mc-image clearfix"><img src="/wp-content/themes/penkethgroup/images/head-mapinfo.png" alt="Map Info Image"></div></div>' 
  			// HTML contents of the InfoWindow
  		});
		google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
  			infowindow.open(map,marker); // Open our InfoWindow
  		});
		
		google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(myLatlng); }); // Keeps the Pin Central when resizing the browser on responsive sites
	}	
	
	
	google.maps.event.addDomListener(window, 'load', ramsbottomOffice); // Execute our 'initialise' function once the page has loaded. 
	google.maps.event.addDomListener(window, 'load', maidenheadOffice); // Execute our 'initialise' function once the page has loaded. 