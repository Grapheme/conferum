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
	<div class="wrapper catalog-wrapper">
		<div class="main clearfix">
			<?php $this->load->view('guests_interface/includes/bag-block');?>
			<div class="texture-left"></div>
			<div class="texture-right"></div>
			<div class="main-container">
				<?php $this->load->view('guests_interface/includes/small-menu');?>
				<?php $this->load->view('guests_interface/includes/header');?>
				<?php $this->load->view('guests_interface/includes/navigation');?>
				<?php $this->load->view('guests_interface/includes/categories');?>
				<?php $this->load->view('guests_interface/includes/sub-categories');?>
				<div id="catalog-products">
					<?=$products;?>
					<?=$pages;?>
				</div>
			</div>
			<div class="outer-wrapper bottom">
				<section class="find-potion clearfix">
					<header>
						<h3>Не нашли средство?</h3>
					</header>
					<div class="potion-avatar">
					<?php for($i=0;$i<count($images);$i++):?>
						<img src="<?=base_url($images[$i]['resource'])?>" alt="<?=$images[$i]['caption']?>" >
					<?php endfor;?>
					</div>
					<div class="order-a-potion">
						<div class="order-desc">
							<?=$page_content['content'];?>
						</div>
						<button class="add-to-cart-btn">Заказать средство</button>
					</div>
				</section>
			</div>
		</div>
	</div>
	<?php $this->load->view('guests_interface/includes/small-footer');?>
	<?php $this->load->view('guests_interface/includes/footer');?>
	<?php $this->load->view('guests_interface/modal/order-a-potion');?>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<script type="text/javascript" src="<?=base_url('js/vendor/scrollingcarousel.2.0.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('js/cabinet/scrollingcarousel-config.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('js/vendor/jquery.customSelect.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('js/cabinet/customselect-config.js');?>"></script>
	<?php $this->load->view('guests_interface/includes/google-analytics');?>
</body>
</html>