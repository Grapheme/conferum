/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$("button.btn-submit").click(function(){
		var _form = $(this).parents('form');
		$(this).addClass('loading');
		$(_form).formSubmitInServer();
	})
	$("button.btn-img-submit").click(function(){
		$(this).addClass('loading');
		var _form = $(this).parents('form');
		$(_form).ajaxSubmit(uploadImage.singlePhotoOption);
		return false;
	});
	$(".tab-insert-page li a").click(function(event){
		if($(this).attr('data-submit') == 1){
			$("form.form-manage-page .btn-submit").removeAttr('disabled');
		}else{
			$("form.form-manage-page .btn-submit").attr('disabled','disabled');
		}
	})
	$("button.btn-bunners-caption").click(function(){
		var _this = this;
		var itemID = $(this).attr('data-item');
		var caption = $(this).siblings('input.image-caption').val().trim();
		var product = $(this).siblings('input.image-product').val().trim();
		var number = $(this).siblings('input.image-number').val().trim();
		var action = $(this).parents('ul.resources-items').attr('data-action');
		$.ajax({
			url: action,type: 'POST',dataType: 'json',data:{'id':itemID,'caption':caption,'product':product,'number':number},
			beforeSend: function(){
				$(_this).addClass('loading');
			},
			success: function(response,textStatus,xhr){
				$(_this).removeClass('loading');
				if(response.status){
					$(_this).html('OK').removeClass('btn-info').addClass('btn-success');
				}else{
					$(_this).html('NOT').removeClass('btn-info').addClass('btn-danger');
				}
			},
			error: function(xhr,textStatus,errorThrown){
				$(_this).removeClass('loading');
				$(_this).html('ERR').removeClass('btn-info').addClass('btn-danger');
			}
		});
	});
	$("a.btn-remove-page").click(function(){
		var _this = this;
		var itemID = $(this).attr('data-item');
		$.ajax({
			url: mt.getBaseURL('page/remove'),data:{'id':itemID},
			type: 'POST',dataType: 'json',
			beforeSend: function(){
				return confirm('Удалить страницу');
			},
			success: function(response,textStatus,xhr){
				if(response.status){
					$(_this).parents('tr').remove();
				}
			},
			error: function(xhr,textStatus,errorThrown){
				$(_this).html('ERR').addClass('btn-danger');
			}
		});
	});
	$("button.btn-images-caption").click(function(){
		var _this = this;
		var itemID = $(this).attr('data-item');
		var caption = $(this).siblings('input.image-caption').val().trim();
		var number = $(this).siblings('input.image-number').val().trim();
		var action = $(this).parents('ul.resources-items').attr('data-action');
		$.ajax({
			url: action,type: 'POST',dataType: 'json',data:{'id':itemID,'caption':caption,'number':number},
			beforeSend: function(){
				$(_this).addClass('loading');
			},
			success: function(response,textStatus,xhr){
				$(_this).removeClass('loading');
				if(response.status){
					$(_this).html('OK').removeClass('btn-info').addClass('btn-success');
				}else{
					$(_this).html('NOT').removeClass('btn-info').addClass('btn-danger');
				}
			},
			error: function(xhr,textStatus,errorThrown){
				$(_this).removeClass('loading');
				$(_this).html('ERR').removeClass('btn-info').addClass('btn-danger');
			}
		});
	});
	$("button.remove-item").click(function(){
		if(!confirm('Удалить запись?')){ return false;}
		var _this = this;
		var itemID = $(this).attr('data-item');
		var action = $(this).parents('table').attr('data-action');
		$.ajax({
			url: action,type: 'POST',dataType: 'json',data:{'id':itemID},
			beforeSend: function(){
				$("div.result-request").html('');
			},
			success: function(response,textStatus,xhr){
				if(response.status){
					$(_this).parents('tr').remove();
				}else{
					$("div.result-request").html(response.responseText);
				}
			},
			error: function(xhr,textStatus,errorThrown){}
		});
	});
});