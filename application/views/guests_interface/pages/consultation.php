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
			</div>
			<div class="outer-wrapper top">
				<section class="consultation clearfix">
					<header>
						<h1>Консультация специалистов</h1>
					</header>
					<div class="consultation"> 
						<div class="consultation-face"> </div>
						<div class="consultation-text">
							<?=$page_content['content'];?>
							<button class="add-to-cart-btn">Заказать звонок</button>
						</div>
					</div>
				</section>
			</div>
			<div class="main-container">
				<section class="consultation-form">
					<header>
						<h2>Консультация специалиста</h2>
					</header>
					<?php $this->load->view('guests_interface/forms/consultation');?>
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