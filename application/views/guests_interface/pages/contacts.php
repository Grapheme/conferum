<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
	<link rel="stylesheet" href="<?=base_url('css/jquery.fancybox.css')?>" />
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
				<section class="contacts">
					<div class="inner-banner banner-contacts">
						<img src="<?=base_url('img/contacts_banner.jpg')?>" alt="">
					</div>
					<header>
						<div class="header_bg">
							<h1>Контакты</h1>
						</div>	
					</header>
					<div class="contact-info">
						<div class="qr-code">
							<img src="img/qr.png" alt="">
						</div>
						<div class="contact-page-addresses">
							<address>
								<span class="address-header">Адрес: </span><?=$contact['address'];?>
							</address>
							<address>
								<span class="address-header">Телефон: </span><?=$contact['phones'];?>
							</address>
							<address>
								<span class="address-header">Email: </span>
								<?php 
									$mails = explode(',',strip_tags($contact['emails']));
								?>
								<?php for($i=0;$i<count($mails);$i++):?>
									<?=safe_mailto($mails[$i],$mails[$i]); if( $i != ( count($mails)-1 ) ) echo '<span class="cont__delim">, </span>'; ?>
								<?php endfor;?>
							</address>
							<span class="download-scheme">Сохраните удобную</span> <a class="download-scheme fancybox" href="<?=base_url('img/scheme.jpg')?>">карточку с контактами и схемой проезда</a>
						</div>
					</div>
				</section>
				<div class="header_bg">
					<h2 class="map-header">
						Схема проезда
					</h2>
				</div>
			</div>
			<div class="outer-wrapper map">
				<div id="map-canvas"></div>
			</div>
		</div>
		
		<div class="animation-overlay">
			<div class="animation-image">
				<img src="<?=base_url('img/scheme_map.jpg');?>" alt="" >
				<div class="animation-car">
					<img src="<?=base_url('img/scheme_car.png');?>" alt="" >
				</div> 
				<div class="animation_go">Проезд</div>
			</div>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>	
	</div>
	<script>
		function preload(arrayOfImages) {
		    $(arrayOfImages).each(function(){
		        $('<img/>')[0].src = this;
		        // Alternatively you could use:
		        // (new Image()).src = this;
		    });
		}
		preload([
	    'img/scheme_car_rotated.png'
		]);	
	</script>
	<?php $this->load->view('guests_interface/includes/small-footer');?>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<script src="<?=base_url('js/cabinet/cont-animate.js');?>"></script>
	<script src="<?=base_url('js/vendor/jquery.fancybox.pack.js')?>"></script>	
	<script src="<?=base_url('js/cabinet/fancybox-init-contacts.js')?>"></script>
	<?php $this->load->view('guests_interface/includes/location_map');?>
	<?php $this->load->view('guests_interface/includes/google-analytics');?>
</body>
</html>