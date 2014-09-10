<?php if(!empty($sub_categories)):?>
<section class="subcategories clearfix">
	<header>
		<h2>Подкатегории. <?=$categoryTitle;?></h2>
	</header>
	<div class="category-img">
		<img src="<?=base_url('img/categories_big/'.$categoryImg);?>" alt="">
	</div>
	<div class="clear"></div>
	<ul class="subcat-list">
	<?php for($i=0;$i<count($sub_categories);$i++):?>
		<li class="subcat-item">
			<a href="<?=site_url('catalog/'.$sub_categories[$i]['page_url'].'#top')?>"><?=$sub_categories[$i]['title'];?></a>
		</li>
	<?php endfor;?>
	</ul>
</section>
<?php endif;?>