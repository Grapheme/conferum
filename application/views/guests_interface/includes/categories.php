<section class="cats">
	<div<?=(uri_string()=='catalog')?'':' id="carousel"'?>>
		<ul class="cats-list">
		<?php for($i=0;$i<count($categories);$i++):?>
			<?
				// Hide last 2 categories
				if ( $categories[$i]['id'] == '8' || $categories[$i]['id'] == '9') continue;
			?>
			<li class="cats-list-item">
				<a href="<?=site_url('catalog/'.$categories[$i]['page_url']);?>" data-category-id="<?=$categories[$i]['id'];?>" class="cat-item-logo <?=$categories[$i]['class_name'];?>"> </a>
				<h3>
					<a href="<?=site_url('catalog/'.$categories[$i]['page_url']);?>" data-category-id="<?=$categories[$i]['id'];?>"><?=$categories[$i]['title'];?></a>
				</h3>
			</li>
		<?php endfor;?>
		</ul>
	</div>
</section>