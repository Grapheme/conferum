<li class="order-item order-product-list" data-order-number="<?=$productLi['number'];?>">
	<div class="order-list-body clearfix">
		<div class="order-avatar">
			<img src="<?=base_url($productLi['logo']);?>" alt="">
		</div>
		<div class="order-right-button order-delete-product">&#10005;</div>
		<div class="order-info">
			<div class="order-item-name">
				<!--<a href="<?=site_url('product/'.$productLi['page_url'])?>"><?=$productLi['title'];?></a>-->
				<?=$productLi['title'];?>
			</div>
			<select name="size_product" class="select-size-product styled_select">
		<?php for($j=0;$j<count($productLi['tara']);$j++):?>
				<optgroup label="<?=$productLi['tara'][$j]['title'];?>">
			<?php for($i=0;$i<count($productLi['sizes']);$i++):?>
				<?php if($productLi['sizes'][$i]['tara'] == $productLi['tara'][$j]['id'] && $productLi['sizes'][$i]['isSize'] === TRUE):?>
				<option value="<?=$productLi['sizes'][$i]['id'];?>" <?=($productLi['sizes'][$i]['id'] == $productLi['product_size'])?' selected="selected"':'';?>>
					<?=$productLi['sizes'][$i]['title'];?>
				</option>
				<?php endif;?>
			<?php endfor;?>
				</optgroup>
		<?php endfor;?>
			</select>
			<input class="quantity input-count-product" name="count_product" value="<?=$productLi['product_count'];?>" />
		</div>
	</div>
</li>