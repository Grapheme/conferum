<p>Поступил новый заказ</p>
<p>ФИО: <?=$info['fio'];?></p>
<p>Email: <?=$info['email'];?></p>
<p>Телефон: <?=$info['phone'];?></p>
<p>Город: <?=$info['city'];?></p>
<p>Список товаров:</p>
<ul>
<?php for($i=0;$i<count($bid);$i++):?>
	<li>
		<div>
			<img src="<?=base_url($bid[$i]['logo'])?>" alt=""/>
			<?=$bid[$i]['title'];?>
			<p>Количество: <?=$bid[$i]['product_count'];?></p>
			<p>Тара: <?=$bid[$i]['product_size']['title'];?> - <?=$bid[$i]['product_size']['tara'];?></p>
		</div>
	</li>
<?php endfor;?>
</ul>