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
				<section class="where2buy">
					<div class="inner-banner banner-where2buy">
						<div class="inner-banner-inside">
							<div class="inner-banner-title">Приглашаем<br>к сотрудничеству<br>региональных дилеров</div>
						</div>
					</div>
					<header>
						<div class="header_bg">
							<h1>Где купить</h1>
						</div>
					</header>
					<ul class="where2buy-list">
					<?php for($i=0;$i<count($where2buy);$i++):?>
						<li class="where2buy-list-item first-item">
						<?php if(!empty($where2buy[$i]['link'])):?>
							<a target="_blank" class="map-mark" href="<?=$where2buy[$i]['link'];?>"></a>
						<?php endif;?>
							<div class="where2buy-address">
								<div class="where2buy-city">
									<?=$where2buy[$i]['city'];?>
								</div>
								<?=$where2buy[$i]['address'];?>
							</div>
						</li>
					<?php endfor;?>
					</ul>
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