$('.animation_go').click( function(){		
	$('.animation-car').stop(true);
	$('.animation-car').find('img').attr('src', 'img/scheme_car.png');
	$('.animation-car').css({top : 0, left: '178px', transform: 'rotate(0)' })
					   .animate({ top: '192px', left: '464px' }, 4000, function() { $(this).find('img').attr('src', 'img/scheme_car_rotated.png'); })
	                   .animate({ top: '285px', left: '338px' }, 4000 );
});
