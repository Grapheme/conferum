<ul class="breadcrumb">
	<li><a href="<?=site_url(ADMIN_START_PAGE);?>">Панель управления</a> <span class="divider">/</span></li>
	<li class="active">Баннеры</li>
</ul>
<div class="clear"></div>
<div class="clearfix">
	<ul class="nav nav-tabs">
		<li <?=($this->input->get('mode') == 'image')?'class="active"':''?>><a href="<?=site_url(ADMIN_START_PAGE.'/banners?mode=image');?>">Изображения</a></li>
		<li <?=($this->input->get('mode') == 'caption')?'class="active"':''?>><a href="<?=site_url(ADMIN_START_PAGE.'/banners?mode=caption');?>">Текстовая информация</a></li>
	</ul>
</div>