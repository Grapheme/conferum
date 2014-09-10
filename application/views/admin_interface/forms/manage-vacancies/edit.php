<?=form_open(ADMIN_START_PAGE.'/vacancies/update?mode=edit&id='.$this->input->get('id'),array('class'=>'form-manage-vacancies')); ?>
	<div class="control-group">
		<label>Title: </label>
		<input type="text" name="page_title" class="span6" value="<?=$vacancies['page_title']?>" placeholder="Title" />
		<label>Description:</label>
		<textarea class="span6" name="page_description" placeholder="Описание"><?=$vacancies['page_description']?></textarea>
		<label>H1: </label>
		<input type="text" name="page_h1" class="span6" value="<?=$vacancies['page_h1']?>" placeholder="H1" />
		<label>URL:</label>
		<input type="text" name="page_url" class="span3" value="<?=$vacancies['page_url']?>" placeholder="URL страницы" />
		<blockquote>
			<small>Если поле оставить пустым, то назначиться транслит названия</small>
		</blockquote>
	</div>
	<hr/>
	<div class="control-group">
		<label>Название: <em>(обязательное)</em></label>
		<input type="text" name="title" class="span6 valid-required" value="<?=$vacancies['title']?>" placeholder="" />
		<label>Оплата:</label>
		<input type="text" name="salary" class="span3" value="<?=$vacancies['salary']?>" placeholder="" />
	</div>
	<div class="control-group">
		<label>Условия:</label>
		<textarea class="redactor" rows="5" name="conditions"><?=$vacancies['conditions']?></textarea>
		<label>Обязанности:</label>
		<textarea class="redactor" rows="5" name="responsibility"><?=$vacancies['responsibility']?></textarea>
		<label>Требования:</label>
		<textarea class="redactor" rows="5" name="requirements"><?=$vacancies['requirements']?></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>