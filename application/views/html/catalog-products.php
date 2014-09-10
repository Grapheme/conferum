<section class="production list clearfix">
	<header>
		<h1 id="top" class="products-header"><?=$categoryTitle;?></h1>
	</header>
<?php if(uri_string() != 'catalog'):?>
	<div id="category-description">
		<?php
			$this->load->helper('text');
            $categoryDescription = htmlspecialchars_decode($categoryDescription);
			$description = ClosedTags(word_limiter($categoryDescription,80));
            $fullLength = mb_strlen($categoryDescription);
			$currentLength = mb_strlen($description);
			if($fullLength > $currentLength):
				$description.=' <a href="#" class="no-clickable" id="show-full-description">подробней &raquo;</a>';
			?>
				<div id="category-description-full" class="hidden"><?=$categoryDescription;?></div>
			<?php endif;
		?>
		<?=$description;?>
	</div>
<?php endif;?>
<?php if(!empty($products)):?>
	<ul class="production-list clearfix">
	<?php $this->load->helper('text');?>
	<?php for($i=0;$i<count($products);$i++):?>
		<li class="production-list-item">
			<div class="production-item-block">
				<a class="production-list-link" href="<?=site_url('product/'.$products[$i]['page_url']);?>">
					<img src="<?=base_url($products[$i]['logo'])?>" alt="<?=$products[$i]['title'];?>" >
				</a>
				<div class="production-item-header">
					<a href="<?=site_url('product/'.$products[$i]['page_url']);?>"><?=$products[$i]['title'];?></a>
				</div>
                <div class="production-item-desc">
                    <?=$products[$i]['price'];?>
                </div>
				<div class="production-item-desc">
					<?=character_limiter($products[$i]['destination'],230);?>
				</div>
			</div>
			<?php $this->load->view("guests_interface/forms/order",array('tara'=>$products[$i]['tara'],'sizes'=>$products[$i]['sizes'],'productID'=>$products[$i]['id'],'categoryID'=>$products[$i]['category'][0]));?>
		</li>
	<?php endfor;?>
	</ul>
<?php endif;?>
</section>