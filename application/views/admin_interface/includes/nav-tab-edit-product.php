<ul class="breadcrumb">
	<li><a href="<?=site_url(ADMIN_START_PAGE);?>">Панель управления</a> <span class="divider">/</span></li>
	<li><a href="<?=site_url(ADMIN_START_PAGE.'/products');?>">Продукты</a> <span class="divider">/</span></li>
	<li class="active">Редактирование продукт</li>
</ul>
<div class="clear"></div>
<div class="clearfix">
	<ul class="nav nav-tabs">
		<li <?=($this->input->get('mode') == 'text')?'class="active"':''?>><a href="<?=site_url(ADMIN_START_PAGE.'/products/edit?mode=text&id='.$this->input->get('id'));?>">Текстовая информация</a></li>
		<li <?=($this->input->get('mode') == 'images')?'class="active"':''?>><a href="<?=site_url(ADMIN_START_PAGE.'/products/edit?mode=images&id='.$this->input->get('id'));?>">Изображения</a></li>
		<li <?=($this->input->get('mode') == 'captions')?'class="active"':''?>><a href="<?=site_url(ADMIN_START_PAGE.'/products/edit?mode=captions&id='.$this->input->get('id'));?>">Подписи</a></li>
	</ul>
</div>