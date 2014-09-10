/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

function setOrder(_this){
	var __interval;
	var _form = $(_this).parent('form');
	$(_form).find('p.error').addClass('hidden');
	$(_form).find('.input-size-product').css('border-color','#bfbfbf');
	$(_form).find('.input-count-product').css('border-color','#bfbfbf');
	
	var productID = $(_form).attr('data-product');
	var size = $(_form).find('.input-size-product').val();
	var count = $(_form).find('.input-count-product').val().trim();
	var category = $(_form).find('.input-category-product').val().trim();
	
	var error = false;
	if(size == 0){
		error = true;
		$(_form).find('.input-size-product').css('border-color','#ff0000');
		//$(_form).find('p.size-product-error').removeClass('hidden').fadeOut( 1500, function() { $(this).addClass('hidden').css({ display: 'inline-block' }); });		
	}
	if(count == '' || parseInt(count) == 0){
		error = true;
		$(_form).find('.input-count-product').css('border-color','#ff0000');
		//$(_form).find('p.count-product-error').removeClass('hidden').fadeOut( 1500, function() { $(this).addClass('hidden').css({ display: 'inline-block' }); });	;
		$(_form).find('.input-count-product').val('').focus();
	}
	if(error == false){
		$.ajax({
			url: mt.getBaseURL('add-product-bid'),type: 'POST',
			dataType: 'json',data:{'product':parseInt(productID),'size':parseInt(size),'count':parseInt(count),'category':category},
			beforeSend: function(){},
			success: function(response,textStatus,xhr){
				if(response.status){
					if(response.product_exist === false){
						$("ul.order-list").append(response.responseProduct);
						$("#span-product-count").html(response.responseCount);
					}else{
						$("li.order-product-list[data-order-number='"+response.product_exist_number+"']").find('.input-count-product').val(response.product_exist_count);
					}
					$("div.usual-bag").removeClass('hidden');
					$(".form-send-order:hidden").fadeIn(800);
					$('body,html').animate({scrollTop: 0},200);
					$(_form).find('.input-size-product').trigger('update');
					$(_form).find('.input-count-product').val('1');
				}
			},
			error: function(xhr,textStatus,errorThrown){
				alert("Ошибка при добавлении в корзину. Попробуйте снова.");
			}
		});
	}
}
function deleteProductOrder(_this){
	
	var orderNumber = $(_this).parents('.order-product-list').attr('data-order-number');
	$.ajax({
		url: mt.getBaseURL('remove-product-bid'),type: 'POST',
		dataType: 'json',data:{'order_number':parseInt(orderNumber)},
		beforeSend: function(){},
		success: function(response,textStatus,xhr){
			if(response.status){
				if(response.responseCount == 0){
					$(".form-send-order").fadeOut(400,function(){
						$("div.usual-bag").addClass('hidden');
						$("#span-product-count").html(response.responseCount);
						$(_this).parents('.order-product-list').remove();
					});
				}else{
					$("#span-product-count").html(response.responseCount);
					$(_this).parents('.order-product-list').remove();
				}
				
			}
		},
		error: function(xhr,textStatus,errorThrown){}
	});
}
function changeSizeProductOrder(_this){
	var size = $(_this).val();
	var orderNumber = $(_this).parents('.order-product-list').attr('data-order-number');
	$.ajax({
		url: mt.getBaseURL('change-product-size'),type: 'POST',
		dataType: 'json',data:{'order_number':parseInt(orderNumber),'size':size},
		beforeSend: function(){},
		success: function(response,textStatus,xhr){},
		error: function(xhr,textStatus,errorThrown){}
	});
}
function changeCountProductOrder(_this){
	var count = $(_this).val().trim();
	if(count != '' || parseInt(count) > 0){
		var orderNumber = $(_this).parents('.order-product-list').attr('data-order-number');
		$.ajax({
			url: mt.getBaseURL('change-product-count'),type: 'POST',
			dataType: 'json',data:{'order_number':parseInt(orderNumber),'count':parseInt(count)},
			beforeSend: function(){},
			success: function(response,textStatus,xhr){},
			error: function(xhr,textStatus,errorThrown){}
		});
	}
}
function loadProductByCategory(categoryID){
	$.ajax({
		url: mt.getBaseURL('load-catalog-products'),type: 'POST',
		dataType: 'json',data:{'category':categoryID},
		beforeSend: function(){},
		success: function(response,textStatus,xhr){
			if(response.status){
				$("#catalog-products").html(response.responseText);
				$("form.form-set-order .styled_select").customSelect();
				$("form.form-set-order .add-to-cart-btn").on('click',function(event){
					event.preventDefault();
					setOrder(this);
				});
			}
		},
		error: function(xhr,textStatus,errorThrown){}
	});
}
$(function(){
	$("input.btn-submit").click(function(){
		var _form = $(this).parents('form');
		$(this).addClass('loading');
		$(_form).formSubmitInServer();
	})
	$("a.load-products-category").click(function(){
		loadProductByCategory($(this).attr('data-category-id'));
	})
	$("form.form-set-order .add-to-cart-btn").click(function(){setOrder(this);})
	$(".full-order-product-list").on('click','div.order-delete-product',function(){deleteProductOrder(this);});
	$(".full-order-product-list").on('change','select.select-size-product',function(){changeSizeProductOrder(this);});
	$(".full-order-product-list").on('keyup','input.input-count-product',function(){changeCountProductOrder(this);});
	$("#show-full-description").click(function(){
		var full = $("#category-description-full").html().trim();
		$("#category-description").html(full);
	})
});