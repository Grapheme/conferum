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
				<section class="vacancies-form">
					<header>
						<div class="header_bg">
							<h1>Отклик на вакансию</h1>
						</div>	
					</header>
					<div class="work-feedback">
						<div>
							<span class="bold-span">Должность: </span> <?=$vacancy['title'];?>
						</div>
						<div>
							<span class="bold-span">Зарплата:</span> <?=$vacancy['salary'];?>
						</div>
						<div>
							<span class="bold-span">Обязанности:</span> <?=$vacancy['conditions'];?>
						</div>
						<div>
							Символом <span class="red-span">*</span> отмечены поля, обязательные для заполнения
						</div>
						<?php $this->load->view('guests_interface/forms/response-vacancy')?>
					</div>
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