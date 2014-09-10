<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
</head>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<?php $this->load->view("admin_interface/includes/navbar");?>
	<div class="container">
		<div class="row">
			<div class="span3">
				<?php $this->load->view("admin_interface/includes/sidebar");?>
			</div>
			<div class="span9">
				<ul class="breadcrumb">
					<li><a href="<?=site_url(ADMIN_START_PAGE);?>">Панель управления</a> <span class="divider">/</span></li>
					<li class="active">Пресс центр</li>
				</ul>
				<div class="clear"></div>
				<div class="inline">
					<a href="<?=site_url(ADMIN_START_PAGE.'/press-centr/add?mode=text')?>" class="btn">Добавить событие</a>
				</div>
				<h2>События</h2>
				<table class="table table-bordered" data-action="<?=site_url(ADMIN_START_PAGE.'/press-centr/remove');?>">
					<thead>
						<tr>
							<th class="span1">№ ID</th>
							<th class="span2">Название</th>
							<th class="span1">Дата</th>
							<th class="span1"></th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($press_centr);$i++):?>
						<tr>
							<td><?=$press_centr[$i]['id'];?></td>
							<td><?=$press_centr[$i]['title'];?></td>
							<td><?=swap_dot_date_without_time($press_centr[$i]['date']);?></td>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/press-centr/edit?mode=text&id='.$press_centr[$i]['id'])?>" class="btn btn-link" ><i class="icon-edit"></i></a>
								<button data-item="<?=$press_centr[$i]['id'];?>" class="btn btn-link remove-item"><i class="icon-remove"></i></button>
							</td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>