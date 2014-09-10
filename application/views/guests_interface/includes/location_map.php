<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtgj1kQZnFLNOQaOkX1fB6Tu_ZeZXzGNI&sensor=false"></script>
<script type="text/javascript">
	var directionsDisplay;
	var directionsService = new google.maps.DirectionsService();
	var map; 
	
	function initialize() {
		var styles = [
			{
				featureType: 'water',
				elementType: 'all',
				stylers: [
					{ hue: '#f8f8f8' },
					{ saturation: -100 },
					{ lightness: 89 },
					{ visibility: 'on' }
			]
			},{
				featureType: 'landscape',
				elementType: 'all',
				stylers: [
					{ hue: '#97d7c4' },
					{ saturation: 24 },
					{ lightness: -19 },
					{ visibility: 'on' }
				]
			}
		];
					
		var mapOptions = {
			zoom : 16,
			scrollwheel : false,
			center : new google.maps.LatLng(55.83096, 37.931673),
			mapTypeId : 'Styled',
			disableDefaultUI: true,
			zoomControl: true
		}
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
		map.mapTypes.set('Styled', styledMapType);	
		
		var image = 'img/marker.png';
		var image2 = 'img/marker2.png';
		var infoWindow = new google.maps.InfoWindow({ 
			content: 'Московская область, г. Балашиха, Щелковское шоссе, 54-Б',
			maxWidth: 300 
		}); 
		var myLatLng = new google.maps.LatLng(55.83096, 37.931673);
		var beachMarker = new google.maps.Marker({
			position : myLatLng,
			map : map,
			icon : image,
			title: 'Конферум'
		});
		google.maps.event.addListener(beachMarker, 'click', function() { 
			if ( $(window).width() >= 768 ) {
				showAnimation();
			}
			else {
				infoWindow.open(map, beachMarker);
			}			
		});
		google.maps.event.addListener(beachMarker, 'mouseover', function() {
			beachMarker.setIcon(image2);
		});
		google.maps.event.addListener(beachMarker, 'mouseout', function() {
			beachMarker.setIcon(image);
		});
		
	}
	
	function showAnimation() {
		$('.animation-overlay').fadeToggle( 800 );
	}
	$('.animation-overlay').click(function(){
		$('.animation-car').stop(true);
		$(this).fadeToggle( 800 );
	});
	$('.animation-car, .animation-image, .animation_go').click( function(e){
		e.stopPropagation();
	})
    initialize();
</script>