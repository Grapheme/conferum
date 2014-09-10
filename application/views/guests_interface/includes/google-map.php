<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtgj1kQZnFLNOQaOkX1fB6Tu_ZeZXzGNI&sensor=false"></script>
<script type="text/javascript">
	function initialize() {
		var mapOptions = {
			zoom : 15,
			scrollwheel : false,
			center : new google.maps.LatLng(47.232435,39.730486),
			mapTypeId : google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		var image = '<?=baseURL("img/interface/map_mark.png");?>';
		var myLatLng = new google.maps.LatLng(47.232435,39.730486);
		var beachMarker = new google.maps.Marker({
			position : myLatLng,
			map : map,
			icon : image
		});
	}
	initialize();
</script>