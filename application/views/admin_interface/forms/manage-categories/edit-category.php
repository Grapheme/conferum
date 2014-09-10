<?=form_open(ADMIN_START_PAGE.'/category/update?mode=update&id='.$this->input->get('id'),array('class'=>'form-manage-category')); ?>
	<div class="control-group">
		<label>Title: </label>
		<input type="text" name="page_title" class="span6" value="<?=$category['page_title'];?>" placeholder="Title" />
		<label>Description:</label>
		<textarea class="span6" name="page_description" placeholder="Описание"><?=$category['page_description'];?></textarea>
		<label>H1: </label>
		<input type="text" name="page_h1" class="span6" value="<?=$category['page_h1'];?>" placeholder="" />
	</div>
	<hr/>
	<div class="control-group">
		<label>Название: <em>(обязательное)</em></label>
		<input type="text" name="title" class="span3 valid-required" value="<?=$category['title'];?>" placeholder="Название" />
		<label>Описание:</label>
		<textarea class="redactor" rows="10" name="description" placeholder="Описание"><?=$category['description'];?></textarea>
		<label>№ п.п.:</label>
		<input type="text" name="number" class="span1 valid-numeric" value="<?=$category['number']?>" placeholder="" /><br/>
	</div>
	<div class="control-group">
		<label>Категория:</label>
		<select name="parent">
			<option value="0">Основная категория</option>
		<?php for($i=0;$i<count($categories);$i++):?>
			<option value="<?=$categories[$i]['id']?>"<?=($categories[$i]['id'] == $category['parent'])?' selected':'';?>><?=$categories[$i]['title'];?></option>
		<?php endfor;?>
		</select>
	</div>
	<hr/>
	<div class="control-group">
		<label>URL:</label>
		<input type="text" name="page_url" class="span3" value="<?=$category['page_url'];?>" placeholder="URL категории" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit btn-success no-clickable btn-loading">Сохранить</button>
		<a class="btn btn-info" href="<?=site_url(ADMIN_START_PAGE.'/'.$this->uri->segment(2));?>">Завершить</a>
	</div>
<?= form_close(); ?>