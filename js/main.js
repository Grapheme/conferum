$.fn.isAfter = function(sel) {
    return this.prevAll(sel).length !== 0;
};
$.fn.isBefore = function(sel) {
    return this.nextAll(sel).length !== 0;
};
$(document).ready( function(){		
	/*destroyCarousel();*/

  $('select.select-to-cart').on('change', function(){
    
    if($(this).val() != 0)
    {
      $(this).parent().parent().find('input.add-to-cart-btn').click();
      $(this).val('0');
      var html = $(this).find('option[value=0]').html();
      $(this).parent().find('.customSelectInner').html(html);

      setTimeout(function(){
      var amount = $(".order-list select.styled_select").length;
      console.log($(".order-list select.styled_select").length + " " + $(".order-list span.customSelect").length);
      if(amount != $(".order-list span.customSelect").length)
        {
          $(".order-list select.styled_select").last().customSelect();
        }
      }, 500);
      
    }
  });
	
	if( $('.search-results')[0] ) {
		$('html, body').animate({ scrollTop: $(".search-results").offset().top }, 1000);
	}
	
	if ($(window).width() <= 768) {
		$('.science-base-side, .where2buy-side').removeClass('hidden');
	}
	
	$('.trigger-button a').click( function() {
		$('.small-menu-body').slideToggle( 800 );
	});
	$('.magnifier a').click( function() {
		$('.nav-srch-form.small').fadeToggle( 800 );
	});	  
  	/* Usual bag trigger code */
  	$('.usual-bag > a').click( function(){
  		$('.order-form').fadeToggle( 800 );
  	});  	
  	/* Popup close cross */
  	$('.form-cross').click( function() {
  		$('.order-a-call').fadeOut( 500 );  		  
  		$('.order-a-potion-popup').fadeOut( 500 );	
  	});  	
  	/* Popup summon trigger*/
  	$('.summon-call-form a, .consultation .add-to-cart-btn').click( function(e) {
  		e.preventDefault();
  		$('.order-a-call, .form-container').fadeIn ( 800 );  		  		
  	});  	
  	$('.order-a-potion .add-to-cart-btn').click( function(e) {
  		e.preventDefault();
  		$('.order-a-potion-popup, .order-a-potion-popup .form-container').fadeIn( 800 );
  	});
  	/* Hide popup trigger */
  	$('.order-a-call').click( function(){
  		$('.order-a-call, .form-container').fadeOut ( 500 );	
  	});
  	$('.order-a-potion-popup').click( function(){
  		$('.order-a-potion-popup, .form-container').fadeOut ( 500 );
  	});
  	/* Stop propagation for popups */
  	$('.form-container').click( function(e){
  		e.stopPropagation();
  	});
  	$('.order-an-item.form-set-order').click( function(e){
  		e.stopPropagation();
  	});
  	
});
$(window).resize( function(){		
	
	if ( $(window).width() <= 768 ) {
		if ( $('.science-base-side, .where2buy-side').hasClass('hidden') ) {
			$('.science-base-side, .where2buy-side').removeClass('hidden');
		}		
	}
	else {
		if ( !($('.science-base-side, .where2buy-side').hasClass('hidden')) ) {
			$('.science-base-side, .where2buy-side').addClass('hidden');
		}
	}
	
	if ($(window).width() > 639){
	  	if ($('.small-menu-body').css("display") == "block") {
	  		$('.small-menu-body').slideUp( 400 );
	  	}  				
	}
	
});
