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
			<div class="outer-wrapper top reviews">
				<section class="reviews clearfix">
					<header>
						<h1>Отзывы</h1>
					</header>
					<?=$page_content['content'];?>
				</section>
			</div>
			<div class="main-container">
				<section class="lead-specialists reviews-section">
					<header>
						<div class="header_bg">
							<h2>Отзывы</h2>
						</div>
					</header>
					<ul class="specs-list">
					<?php for($i=0;$i<count($reviews);$i++):?>
						<li class="specs-list-item">
						<?php if(!empty($reviews[$i]['logo'])):?>
							<div class="spec-avatar">
								<img src="<?=base_url($reviews[$i]['logo'])?>" alt="">
							</div>
						<?php endif;?>
							<div class="spec-desc">
								<div class="spec-name">
									<?=$reviews[$i]['name'];?>
								</div>
								<div class="spec-prof">
									<?=$reviews[$i]['city'];?>
								</div>
								<div class="spec-info">
									<?=$reviews[$i]['content'];?>
								</div>
							</div>
						</li>
					<?php endfor;?>
					</ul>
				</section>
				<?php $this->load->view('guests_interface/includes/pagination');?>
			</div>
		</div>
	</div>
	<?php $this->load->view('guests_interface/includes/small-footer');?>
	<?php $this->load->view('guests_interface/includes/footer');?>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<?php $this->load->view('guests_interface/includes/google-analytics');?>
</body>
</html>