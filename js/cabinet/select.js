/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$("select.select-category").change(function(){
		var url = mt.currentURL.replace(/\?category=(\d+)?/,'');
		if($(this).emptyValue() == false){
			url = url+'?category='+$(this).val();
		}
		mt.redirect(url);
	});
	$("select.select-tara").change(function(){
		var url = mt.currentURL.replace(/\?tara=(\d+)?/,'');
		if($(this).emptyValue() == false){
			url = url+'?tara='+$(this).val();
		}
		mt.redirect(url);
	});
});