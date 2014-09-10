<!-- Google maps -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtgj1kQZnFLNOQaOkX1fB6Tu_ZeZXzGNI&sensor=false"></script>
<script type="text/javascript">
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
			mapTypeControlOptions: {
				mapTypeIds: ['Styled']
			},
			zoom : 4,
			scrollwheel : false,
			center : new google.maps.LatLng(53.936895,50.799065),
			mapTypeId : 'Styled',
			panControl: false,
			zoomControl: true,
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			overviewMapControl: false					
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
		map.mapTypes.set('Styled', styledMapType);
		
		var hoverImage = 'img/marker2.png'
		
		function addInfoWindow(marker, content) {
			google.maps.event.addListener(marker, 'click', function() { 
			infoWindow.close();
			infoWindow.setContent(content);			
			infoWindow.setOptions( {maxWidth: 320} );
			infoWindow.open(map, marker); 
		});
		}
		/*-------------------------------------------------------------------------------------*/
		
		var image = 'img/marker.png';
		var infoWindow = new google.maps.InfoWindow();		
		
		var content2 = '<div id="infoWindow">г. Самара ул. Загорская, 34, А, +7 (846) 224-57-58</div>';			
		var myLatLng2 = new google.maps.LatLng(53.219785,50.208828);
		var beachMarker2 = new google.maps.Marker({
			position : myLatLng2,
			map : map,
			icon : image,
			title : 'Самара'
		});				
		
		var content3 = '<div id="infoWindow">г. Москва Лесногрядский пер., д.18, стр. 7, +7 (926) 349-22-03</div>';
		var myLatLng3 = new google.maps.LatLng(55.782386,37.678848);
		var beachMarker3 = new google.maps.Marker({
			position : myLatLng3,
			map : map,
			icon : image,
			title : 'Москва'
		});
						
		var content4 = '<div id="infoWindow">г. Алматы, Казахстан ул. Ауэлова, 3, +7 (727) 395-93-90, +7 (727) 379-20-02</div>';
		var myLatLng4 = new google.maps.LatLng(43.358815,77.456938);
		var beachMarker4 = new google.maps.Marker({
			position : myLatLng4,
			map : map,
			icon : image,
			title : 'Алматы'
		});		
		
		var content5 = '<div id="infoWindow">г. Челябинск ул. Кожзаводская, д. 106 +7 (351) 210-04-19</div>';
		var myLatLng5 = new google.maps.LatLng(55.195479,61.396155);
		var beachMarker5 = new google.maps.Marker({
			position : myLatLng5,
			map : map,
			icon : image,
			title : 'Челябинск'
		});		
		
		var content6 = '<div id="infoWindow">г. Казань Проспект Ямашева, д. 54, +7 (843) 296-18-81</div>';
		var myLatLng6 = new google.maps.LatLng(55.827203,49.125384);
		var beachMarker6 = new google.maps.Marker({
			position : myLatLng6,
			map : map,
			icon : image,
			title : 'Казань'
		});
		
		var content7 = '<div id="infoWindow">г. Уфа ул. Сельская Богородская, д. 57 +7 (347) 292-75-60</div>';
		var myLatLng7 = new google.maps.LatLng(54.790133,56.090631);
		var beachMarker7 = new google.maps.Marker({
			position : myLatLng7,
			map : map,
			icon : image,
			title : 'Уфа'
		});
		
		var content8 = '<div id="infoWindow">г. Тюмень ул. Республики, д. 204 «А» +7 (3452) 32-89-77</div>';
		var myLatLng8 = new google.maps.LatLng(57.119165,65.602581);
		var beachMarker8 = new google.maps.Marker({
			position : myLatLng8,
			map : map,
			icon : image,
			title : 'Тюмень'
		});
		
		var content9 = '<div id="infoWindow">г. Тольятти ул. Автостроителей, д. 98, +7 (8482) 78-17-05</div>';
		var myLatLng9 = new google.maps.LatLng(53.527261,49.32346);
		var beachMarker9 = new google.maps.Marker({
			position : myLatLng9,
			map : map,
			icon : image,
			title : 'Тольятти'
		});
		
		var content10 = '<div id="infoWindow">г. Саратов Московское шоссе, д. 23 «А», +7 (8452) 700–780</div>';
		var myLatLng10 = new google.maps.LatLng(51.613713,45.903772);
		var beachMarker10 = new google.maps.Marker({
			position : myLatLng10,
			map : map,
			icon : image,
			title : 'Саратов'
		});
		
		var content11 = '<div id="infoWindow">г. Екатеринбург пр. Складской, д. 6, офис 218 +7 (343) 344-09-83</div>';
		var myLatLng11 = new google.maps.LatLng(56.771553,60.557515);
		var beachMarker11 = new google.maps.Marker({
			position : myLatLng11,
			map : map,
			icon : image,
			title : 'Екатеринбург'
		});
		
		var content12 = '<div id="infoWindow">г. Кемерово ул. Предзаводская, д. 10, оф. 1204/1 +7 (951) 181-29-69</div>';
		var myLatLng12 = new google.maps.LatLng(54.757467,87.405531);
		var beachMarker12 = new google.maps.Marker({
			position : myLatLng12,
			map : map,
			icon : image,
			title : 'Кемерово'
		});
		
		var content13 = '<div id="infoWindow">г. Ярославль ул. Полушкина Роща, д. 16 +7 (4852) 67-05-07</div>';
		var myLatLng13 = new google.maps.LatLng(57.900256,38.84079);
		var beachMarker13 = new google.maps.Marker({
			position : myLatLng13,
			map : map,
			icon : image,
			title : 'Ярославль'
		});
		
		var content14 = '<div id="infoWindow">г. Кострома ул. Мясницкая, д. 112 «Ж» +7 (903) 896-07-30</div>';
		var myLatLng14 = new google.maps.LatLng(57.766673,40.933331);
		var beachMarker14 = new google.maps.Marker({
			position : myLatLng14,
			map : map,
			icon : image,
			title : 'Кострома'
		});
		
		var content15 = '<div id="infoWindow">г. Курган ул. Омская, д. 94 «А» +7 (3522) 55-05-78, 54-53-79</div>';
		var myLatLng15 = new google.maps.LatLng(55.466071,65.370246);
		var beachMarker15 = new google.maps.Marker({
			position : myLatLng15,
			map : map,
			icon : image,
			title : 'Курган'
		});
		
		var content16 = '<div id="infoWindow">г. Ростов-на-Дону пр. Ворошиловский, д. 6 «А» +7 (928) 124-75-57</div>';
		var myLatLng16 = new google.maps.LatLng(47.21667,39.699998);
		var beachMarker16 = new google.maps.Marker({
			position : myLatLng16,
			map : map,
			icon : image,
			title : 'Ростов-на-Дону'
		});
		
		var content17 = '<div id="infoWindow">г. Санкт-Петербург ул. Салова, д. 53, к. 1 +7 (812) 292-21-91</div>';
		var myLatLng17 = new google.maps.LatLng(59.888092,30.377192);
		var beachMarker17 = new google.maps.Marker({
			position : myLatLng17,
			map : map,
			icon : image,
			title : 'Санкт-Петербург'
		});
		
		var content18 = '<div id="infoWindow">г. Тверь ул. Циммервальдская, д.24 +7 (910) 939-24-00</div>';
		var myLatLng18 = new google.maps.LatLng(56.858728,35.917595);
		var beachMarker18 = new google.maps.Marker({
			position : myLatLng18,
			map : map,
			icon : image,
			title : 'Тверь'
		});
		
		var content19 = '<div id="infoWindow">г. Красноярск ул. Гайдашовка, д. 3, офис 302 +7 (391) 242-22-66</div>';
		var myLatLng19 = new google.maps.LatLng(56.066712,92.951508);
		var beachMarker19 = new google.maps.Marker({
			position : myLatLng19,
			map : map,
			icon : image,
			title : 'Красноярск'
		});
		
		var content20 = '<div id="infoWindow">г. Минск ул. Аэродромная, д. 4 «Б» +375 (17) 213-31-69</div>';
		var myLatLng20 = new google.maps.LatLng(53.873134,27.540118);
		var beachMarker20 = new google.maps.Marker({
			position : myLatLng20,
			map : map,
			icon : image,
			title : 'Минск'
		});
		
		
		addInfoWindow(beachMarker2, content2);
		addInfoWindow(beachMarker3, content3);
		addInfoWindow(beachMarker4, content4);
		addInfoWindow(beachMarker5, content5);
		addInfoWindow(beachMarker6, content6);
		addInfoWindow(beachMarker7, content7);
		addInfoWindow(beachMarker8, content8);
		addInfoWindow(beachMarker9, content9);
		addInfoWindow(beachMarker10, content10);
		addInfoWindow(beachMarker11, content11);
		addInfoWindow(beachMarker12, content12);
		addInfoWindow(beachMarker13, content13);
		addInfoWindow(beachMarker14, content14);
		addInfoWindow(beachMarker15, content15);
		addInfoWindow(beachMarker16, content16);
		addInfoWindow(beachMarker17, content17);
		addInfoWindow(beachMarker18, content18);
		addInfoWindow(beachMarker19, content19);
		addInfoWindow(beachMarker20, content20);
				
		var beachArray = [ beachMarker2, beachMarker3, beachMarker4, beachMarker5, beachMarker6, beachMarker7, beachMarker8, beachMarker9, beachMarker10, beachMarker11, beachMarker12, beachMarker13, beachMarker14, beachMarker15, beachMarker16, beachMarker17, beachMarker18, beachMarker19, beachMarker20 ];
				
		function windowHover(elem) {			
			google.maps.event.addListener(elem, 'mouseover', function() {
    			elem.setIcon(hoverImage);
			});
			google.maps.event.addListener(elem, 'mouseout', function() {
		    	elem.setIcon(image);
			});			
		}
		
		for ( var i=0; i < beachArray.length; i++ ) {
			windowHover( beachArray[i] );
		}
	}
	initialize();
</script>