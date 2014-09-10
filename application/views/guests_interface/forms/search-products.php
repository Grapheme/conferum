<form action="<?=site_url(uri_string());?>" method="GET" class="search-form">
	<input id="search" type="text" name="search" value="<?=$this->input->get('search');?>" placeholder="">
	<input type="submit" value="Поиск">
</form>