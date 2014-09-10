<form action="<?=site_url('set-order');?>" method="POST" data-product="<?=$productID;?>" class="order-an-item form-set-order">
    <input name="category" class="input-category-product" type="hidden" value="<?=(isset($categoryID[1]))?$categoryID[0]:0;?>">
	<div class="div-size-product">
		<select class="styled_select input-size-product select-to-cart" name="size_product">
			<option value="0">Заказать</option>
	<?php for($j=0;$j<count($tara);$j++):?>
			<optgroup label="<?=$tara[$j]['title'];?>">
		<?php for($i=0;$i<count($sizes);$i++):?>
			<?php if($sizes[$i]['tara'] == $tara[$j]['id'] && $sizes[$i]['isSize'] === TRUE):?>
			<option value="<?=$sizes[$i]['id'];?>"><?=$sizes[$i]['title'];?></option>
			<?php endif;?>
		<?php endfor;?>
			</optgroup>
	<?php endfor;?>
		</select>
		<p class="size-product-error error hidden">Укажите объем</p>
	</div>
		<input class="input-count-product valid-numeric" name="value-count" type="hidden" value="1">
		<input type="submit" class="btn-loading add-to-cart-btn no-clickable hidden" value="Заказать">
</form>