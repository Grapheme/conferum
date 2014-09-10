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
					<li class="active">Категории</li>
				</ul>
				<div class="clear"></div>
			<?php if(!empty($categories)):?>
				<h2>Категории</h2>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="span9">Название</th>
							<th class="span2"></th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($categories);$i++):?>
						<tr>
							<td>
							<?php if(!empty($categories[$i]['logo'])):?>
								<img class="span2 img-rounded" src="<?=base_url($categories[$i]['logo']);?>" title="">
							<?php endif;?>
								<a href="<?=site_url(ADMIN_START_PAGE.'/sub-categories?category='.$categories[$i]['id'])?>"><?=$categories[$i]['title'];?></a>
							</td>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/'.$this->uri->segment(2).'/edit?mode=text&id='.$categories[$i]['id'])?>" class="btn btn-link" ><i class="icon-edit"></i></a>
							</td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
			<?php else:?>
				<div class="msg-alert">Список категорий пуст</div>
			<?php endif;?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/cabinet/admin.js');?>"></script>
</body>
</html>