<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
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
				<section class="search-text-results">
					<header>
						<div class="header_bg">
							<h1>Результаты поиска</h1>
						</div>
					</header>
				<?php if(!empty($products)):?>
					<ul class="typical-event-list">
					<?php for($i=0;$i<count($products);$i++): ?>
						<li class="typical-event-list-item clearfix">
							<div class="event-avatar">
								<img src="<?=base_url($products[$i]['logo'])?>" alt="<?=$products[$i]['title'];?>" >
							</div>
							<div class="event-desc">
								<div class="event-name">
									<a href="<?=site_url('product/'.$products[$i]['page_url']);?>"><?=$products[$i]['title'];?></a>
								</div>
								<div class="event-short-info search-goods-it">
									<?=word_limiter($products[$i]['destination'],30);?><br/>
									<a href="<?=site_url('product/'.$products[$i]['page_url']);?>">Подробнее</a>
								</div>
							</div>
						</li>
						<?php endfor;?>
					</ul>
					<?php $this->load->view('guests_interface/includes/pagination');?>
				<?php else:?>
					<div class="nothing-found">
						По вашему запросу ничего не найдено.
						<br>
						Попробуйте изменить запрос или обратитесь за <a href="<?=base_url('consultation');?>">консультацией</a> к нашим специалистам.
						<div>
							<img src="<?=base_url('img/repeat.png')?>">
						</div>
					</div>
				<?php endif;?>
				</section>
			</div>
		</div>
	</div>
	<?php $this->load->view('guests_interface/includes/small-footer');?>
	<?php $this->load->view('guests_interface/includes/footer');?>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<?php $this->load->view('guests_interface/includes/google-analytics');?>
</body>
</html>