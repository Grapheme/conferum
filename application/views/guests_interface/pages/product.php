<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
	<link rel="stylesheet" href="<?=base_url('css/easy-responsive-tabs.css')?>">
	<link rel="stylesheet" href="<?=base_url('css/jquery.fancybox.css')?>">
</head>
<body>
	<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->
	<div class="wrapper">
		<div class="main clearfix">
			<?php $this->load->view('guests_interface/includes/bag-block');?>
			<div class="texture-left"></div>
			<div class="texture-right"></div>
			<div class="main-container">
				<?php $this->load->view('guests_interface/includes/small-menu');?>
				<?php $this->load->view('guests_interface/includes/header');?>
				<?php $this->load->view('guests_interface/includes/navigation');?>
				<div class="cat-item">
					<aside>
						<h2>Категории средств</h2>
						<ul class="side-list">
						<?php for($i=0;$i<count($categories);$i++):?>
							<li class="side-list-item <?=(in_array($categories[$i]['id'],$product['category']))?' active-sublist':'';?>">
								<a href="<?=site_url('catalog/'.$categories[$i]['page_url']);?>"><?=$categories[$i]['title'];?></a>
							<!--<ul class="side-sublist">
							<?php for($j=0;$j<count($allProducts);$j++):?>
								<?php if($allProducts[$j]['category'] == $categories[$i]['id']):?>
									<li class="side-sublist-item">
										<a class="<?php if($this->uri->segment(2) == $allProducts[$j]['page_url']) echo 'active-sublist no-clickable'; ?>" href="<?=site_url('product/'.$allProducts[$j]['page_url']);?>">
											<?=$allProducts[$j]['title'];?>
										</a>
									</li>
								<?php endif;?>
							<?php endfor;?>
							</ul>-->
							</li>
						<?php endfor;?>
						</ul>
					</aside>
					<div class="cat-item-info">
						<div>
							<div class="cat-item-pict">
								<img src="<?=base_url($product['logo']);?>" alt="">
							</div>
							<div class="cat-item-desc">
								<h1 class="cat-item-name"><?=(!empty($product['page_h1']))?$product['page_h1']:$product['title'];?></h1>
                                <div class="cat-item-purpose">
                                    <?=$product['price']?>
                                </div>
                                <div class="cat-item-purpose">
									<?=$product['destination']?>
								</div>
								<div class="">
									<ul>
									<?php for($i=0;$i<count($product['sub_categories']);$i++):?>
										<li><?=$product['sub_categories'][$i];?></li>
									<?php endfor;?>
									</ul>
								</div>
								<div class="cat-item-taglinks">
								<?php for($i=0;$i<count($keywords);$i++):?>
									<a href="#"><?=$keywords[$i]?></a><?php if(isset($keywords[$i+1])):?>,<?php endif;?>
								<?php endfor;?>
								</div>
								<?php $this->load->view("guests_interface/forms/order",array('tara'=>$product_tara,'sizes'=>$product_sizes,'productID'=>$product['id'],'categoryID'=>$product['category']))?>
							</div>
							<div id="tab">
								<ul class="resp-tabs-list">
								<?php if(!empty($product['description'])):?>
									<li>Описание</li>
								<?php endif;?>
								<?php if(!empty($product['advantages'])):?>
									<li>Преимущества</li>
								<?php endif;?>
								<?php if(!empty($product['applying'])):?>
									<li>Применение</li>
								<?php endif;?>
								<?php if(!empty($product_images)):?>
									<li>До и после</li>
								<?php endif;?>
									<li>Как купить?</li>
								</ul>
								<div class="resp-tabs-container">
								<?php if(!empty($product['description'])):?>
									<div>
										<?=$product['description'];?>
									</div>
								<?php endif;?>
								<?php if(!empty($product['advantages'])):?>
									<div>
										<?=$product['advantages'];?>
									</div>
								<?php endif;?>
								<?php if(!empty($product['applying'])):?>
									<div>
										<?=$product['applying'];?>
									</div>
								<?php endif;?>
								<?php if(!empty($product_images)):?>
									<div>
										<ul class="cat-desc-block-photos clearfix">
										<?php for($i=0;$i<count($product_images);$i++):?>
											<li class="cat-desc-photo">
												<a class="fancybox" rel="group" href="<?=base_url($product_images[$i]['resource']);?>">
													<img src="<?=base_url($product_images[$i]['thumbnail']);?>" title="<?=$product_images[$i]['caption'];?>" alt="">
												</a>
											</li>
										<?php endfor;?>
										</ul>
									</div>
								<?php endif;?>
									<div>
										<p>
										 	Оформить заказ на товар, который заинтересовал вас, вы можете несколькими способами:
										</p>
										<ol>
										 	<li>Нажмите на кнопку «Заказать» и далее выберите необходимый вам объем тары, как в обычном Интернет-магазине. <br/>
										 	<li>Напишите нам по email: <a href="mailto:<?=DEFAULT_MAIL;?>"><?=DEFAULT_MAIL;?></a> или позвоните по телефонам <nobr>+7 (495) 502-92-90</nobr>, <nobr>+7 (495) 227-62-63</nobr>. <br/>
										 </ol>
										<p>
											Мы можем доставить купленный у нас товар по Москве или Московской области собственным 
											транспортом. Доставка по России осуществляется транспортными компаниями. Возможна безналичная форма оплаты. 
										</p>
										<p class="margin-top-20">
											Компания ООО «Конферум» имеет представительства в следующих городах:
										</p>
										<table class="cities">
											<tr>
												<td>Москва</td>
												<td>Алматы, Казахстан</td>
												<td>Екатеринбург</td>
											</tr>
											<tr>
												<td>Казань</td>
												<td>Кемерово</td>
												<td>Кострома</td>
											</tr>
											<tr>
												<td>Красноярск</td>
												<td>Курган</td>
												<td>Минск, Беларусь</td>
											</tr>
											<tr>
												<td>Ростов-на-Дону</td>
												<td>Самара</td>
												<td>Санкт-Петербург</td>
											</tr>
											<tr>
												<td>Саратов</td>
												<td>Тверь</td>
												<td>Тольятти</td>
											</tr>
											<tr>
												<td>Тюмень</td>
												<td>Уфа</td>
												<td>Челябинск</td>
											</tr>
											<tr>
												<td>Ярославль</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</table>
										<p>
											Мы отправляем заказы в указанные ниже города. Если вы не нашли свой населенный пункт 
											в этом списке, напишите нам и мы обязательно постараемся вам помочь.
										</p>
										<table class="cities">
											<tr>
												<td>Новосибирск</td>
												<td>Нижний Новгород</td>
												<td>Омск</td>
											</tr>
											<tr>
												<td>Волгоград</td>
												<td>Пермь</td>
												<td>Воронеж</td>
											</tr>
											<tr>
												<td>Саратов</td>
												<td>Краснодар</td>
												<td>Барнаул</td>
											</tr>
											<tr>
												<td>Ульяновск</td>
												<td>Ижевск</td>
												<td>Иркутск</td>
											</tr>
											<tr>
												<td>Владивосток</td>
												<td>Хабаровск</td>
												<td>Махачкала</td>
											</tr>
											<tr>
												<td>Оренбург</td>
												<td>Новокузнецк</td>
												<td>Томск</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if(empty($similars) === FALSE):?>
				<section class="production">
					<header>
						<div class="header_bg">
							<h2>Похожие товары</h2>
						</div>
					</header>
					<ul class="production-list clearfix">
					<?php $this->load->helper('text');?>
				<?php for($i=0;$i<count($similars);$i++):?>
						<li class="production-list-item">
							<div class="production-item-block">
								<a class="production-list-link" href="<?=site_url('product/'.$similars[$i]['page_url']);?>">
									<img src="<?=base_url($similars[$i]['logo'])?>" alt="">
								</a>
								<div class="production-item-header">
									<?=$similars[$i]['title'];?>
								</div>
								<div class="production-item-desc">
                                    <?=$similars[$i]['price'];?>
                                </div>
								<div class="production-item-desc">
									<?=character_limiter($similars[$i]['destination'],250);?>
								</div>
							</div>
							<?php $this->load->view("guests_interface/forms/order",array('sizes'=>$similars[$i]['sizes'],'productID'=>$similars[$i]['id'],'categoryID'=>$similars[$i]['category']));?>
						</li>
				<?php endfor;?>
					</ul>
				</section>
			<?php endif;?>
			
		</div>
	</div>
	<?php $this->load->view('guests_interface/forms/order-call');?>
	<?php $this->load->view('guests_interface/includes/small-footer');?>
	<?php $this->load->view('guests_interface/includes/footer');?>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<script src="<?=base_url('js/vendor/easyResponsiveTabs.js');?>"></script>
	<script src="<?=base_url('js/cabinet/easytab-config.js');?>"></script>
	<script src="<?=base_url('js/vendor/jquery.fancybox.pack.js');?>"></script>
	<script type="text/javascript">	
		$(".fancybox").fancybox({
			padding: 10,
			helpers: {
			  overlay: {
			      locked: false
			    }
			  }
		});	
	</script>
	<script type="text/javascript" src="<?=base_url('js/vendor/jquery.customSelect.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('js/cabinet/customselect-config.js');?>"></script>	
	<?php $this->load->view('guests_interface/includes/google-analytics');?>
</body>
</html>