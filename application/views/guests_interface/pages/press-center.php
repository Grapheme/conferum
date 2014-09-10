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
				<section class="press-center">
					<header>
						<div class="header_bg">
							<h1>Пресс-центр</h1>
						</div>
					</header>
					<ul class="typical-event-list">
					<?php for($i=0;$i<count($press_centr);$i++):?>
						<li class="typical-event-list-item">
						<?php if(!empty($press_centr[$i]['logo'])):?>
							<div class="event-avatar">
								<div class="event-date">
									<?=swap_dot_date_without_time($press_centr[$i]['date']);?> г.
								</div>
								<img src="<?=base_url($press_centr[$i]['logo'])?>" alt="">
							</div>
						<?php endif;?>
							<div class="event-desc">
								<div class="event-name">
									<a href="<?=site_url('press-center/'.$press_centr[$i]['page_url'])?>"><?=$press_centr[$i]['title']?></a>									
								</div>
								<div class="event-short-info">
									<?=$press_centr[$i]['anonce']?>
								</div>
								<a class="morelink" href="<?=site_url('press-center/'.$press_centr[$i]['page_url'])?>">
									Подробнее
								</a>
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