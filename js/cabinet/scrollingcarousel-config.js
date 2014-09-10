/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){	
    if ( $(window).width() > 1024 ) {
    	$('#carousel li').css({'float': 'left', 'margin': '0 70px 0 0', 'padding': '20px 0 0', 'width': '144px', 'border': 'none'});
    	var myCarousel = $('#carousel').scrollingCarousel({
			looped: false,
			afterLoadFunction: $('#carousel').fadeIn(800),
			afterCreateFunction: function(){
				$("a.load-products-category:visible").on('click',function(event){
					event.preventDefault();
					loadProductByCategory($(this).attr('data-category-id'));
				});
			}
		});	
    }if ( $(window).width() <= 1024 && $(window).width() > 768 ) {
		/*myCarousel.Destroy(true);*/
		$('#carousel li').css({ 'float': 'none', 'margin': '0 1em', 'padding': 'none', 'width': 'width: 15.6%;' });
	}
	else if ( $(window).width() <= 768 ) {
		/*myCarousel.Destroy(true);*/
		$('#carousel li').css({ 'float': 'none', 'margin': '0 1em', 'padding': 'none', 'width': 'width: 15.6%;' });
	}
});
