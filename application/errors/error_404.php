<?php 
	$config =&get_config();
 	$CI = & get_instance();
	$CI->load->model(array('categories','pages'));
	$pagevar['categories'] = $CI->categories->getWhere(NULL,array('sub_category'=>0),TRUE);
	$destination['main_menu'] = $CI->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,2,5),'many_records'=>TRUE));
	$destination['sub_menu'] = $CI->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,3),'many_records'=>TRUE));
	$footer_config['footer_menu'] = $CI->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,4,5),'many_records'=>TRUE));
	$destination['sub_menu'] = $CI->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,3),'many_records'=>TRUE));			
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Page Not Found :(</title>
	<link rel="stylesheet" href="<?=base_url('css/bootstrap.css');?>" />
	<link rel="stylesheet" href="<?=base_url('css/main.css');?>" />
	<style>
		body { margin: 0; padding: 0; height: 100%; }
		h1 { height: 326px; margin:0; padding: 0; font-size: 16.6875em; line-height: 314px; color: #31ab87; font-family: sans-serif; background: url(<?=$config['base_url'];?>img/shadow_404.png) no-repeat bottom; text-align: center; }		
		p { color: #4d4d4d; text-align: center; }
		.back-to-main { text-decoration: none; display:inline-block; margin: 0 auto; padding: .25em 1em .35em; border: 1px solid #0f9e74; border-radius: 2px; background-color: #5bbfa1; color: #fff; text-shadow: 1px 1px 0px #53ac92; filter: dropshadow(color=#53ac92, offx=1, offy=1); }
		.link-404 { color: #4d4d4d;
			transition: all .4s ease;
			-webkit-transition: all .4s ease;
			-moz-transition: all .4s ease;
			-o-transition: all .4s ease;
			-ms-transition: all .4s ease;
		}
		.link-404:hover { color: #497999; }
		.container { margin: 0 0 3em; }
		.container > p { margin: 2.5em 0 0; }
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="main clearfix">
			<?php $CI->load->view('guests_interface/includes/bag-block');?>
			<div class="texture-left"></div>
			<div class="texture-right"></div>
			<div class="main-container">
				<?php $CI->load->view('guests_interface/includes/small-menu', $destination);?>
				<?php $CI->load->view('guests_interface/includes/header');?>
				<?php $CI->load->view('guests_interface/includes/navigation', $destination);?>
			</div>
			<div class="container">
				<h1>404</h1>
				<p>Страница не найдена или не существует.<br>Попробуйте начать с <a class="link-404" href="<?=$config['base_url'];?>">главной страницы</a> или воспользуйтесь <a class="link-404" href="<?=$config['base_url'] . 'search-goods';?>">поиском</a>.</p>
			</div>
		</div>
	</div>
	<?php $CI->load->view('guests_interface/includes/small-footer');?>
	<?php $CI->load->view('guests_interface/includes/footer', $footer_config);?>
	<?php $CI->load->view('guests_interface/includes/scripts');?>
</body>
</html>
