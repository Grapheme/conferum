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
				<section class="vacancies">
					<header>
						<div class="header_bg">
							<h1>Вакансии компании</h1>	
						</div>
					</header>
					<ul class="vacancies-list">
					<?php for($i=0;$i<count($vacancies);$i++):?>
						<li class="vacancies-list-item clearfix">
							<div class="vac-left">
								<h2 class="vac-header"><?=$vacancies[$i]['title'];?></h2>
								<div>
									<span class="bold-span">Условия:</span>
									<?=$vacancies[$i]['conditions'];?>
								</div>
								<div>
									<span class="bold-span">Обязанности:</span>
									<?=$vacancies[$i]['responsibility'];?>
								</div>
								<div>
									<span class="bold-span">Требования:</span>
									<?=$vacancies[$i]['requirements'];?>
								</div>
							</div>
							<div class="vac-right">
								<div class="salary">
									<span class="bold-span"><?=$vacancies[$i]['salary'];?></span>
								</div>
								<a href="<?=site_url('vacancies/'.$vacancies[$i]['page_url'].'/response');?>" class="add-to-cart-btn">Отправить заявку</a>
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