<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
	<link rel="stylesheet" href="<?=base_url('css/fotorama.css')?>" />
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
				<section class="honors">
					<header>
						<div class="header_bg">
							<h1><?=$page_content['title'];?></h1>
						</div>
					</header>
					<?=$page_content['content'];?>
				<?php if(!empty($images)):?>
					<ul class="honors-list">
					<?php for($i=0;$i<count($images);$i++):?>
						<li class="honors-list-item">
							<a class="fancybox" rel="group" href="<?=base_url($images[$i]['resource'])?>">
								<img src="<?=base_url($images[$i]['thumbnail'])?>" alt="" title="<?=$images[$i]['caption']?>" >
							</a>
						</li>
					<?php endfor;?>
					</ul>
				<?php endif;?>
				</section>
			</div>
		</div>
	</div>
	<?php $this->load->view('guests_interface/includes/small-footer');?>
	<?php $this->load->view('guests_interface/includes/footer');?>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<script type="text/javascript" src="<?=base_url('js/vendor/fotorama.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('js/libs/fotorama-config.js');?>"></script>
	<script src="<?=base_url('js/vendor/jquery.fancybox.pack.js')?>"></script>
	<script src="<?=base_url('js/cabinet/fancybox-init.js')?>"></script>
	<?php $this->load->view('guests_interface/includes/points_sale_map');?>
	<?php $this->load->view('guests_interface/includes/google-analytics');?>
</body>
</html>