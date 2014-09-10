<ul class="resources-items clearfix" data-action="<?=site_url(ADMIN_START_PAGE.'/products/remove/resource');?>">
<?php for($i=0;$i<count($images);$i++):?>
	<li>
		<img class="img-rounded" src="<?=site_url($images[$i]['thumbnail']);?>" alt="">
		<a href="" data-resource-id="<?=$images[$i]['id']?>" class="no-clickable delete-resource-item">&times;</a>
	</li>
<?php endfor;?>
</ul>
<?=$this->load->view('html/zone-upload-file',array('action'=>site_url(ADMIN_START_PAGE.'/products/upload/resource?id='.$this->input->get('id'))));?>
<a href="<?=site_url(ADMIN_START_PAGE.'/products/add?mode=captions&id='.$this->input->get('id'))?>" class="btn">Подписи</a>
<a href="<?=site_url(ADMIN_START_PAGE.'/products')?>" class="btn btn-info">Завершить</a>