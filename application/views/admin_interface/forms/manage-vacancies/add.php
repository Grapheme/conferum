<?=form_open(ADMIN_START_PAGE.'/vacancies/insert',array('class'=>'form-manage-vacancies')); ?>
	<div class="control-group">
		<label>Title: </label>
		<input type="text" name="page_title" class="span6" value="" placeholder="Title" />
		<label>Description:</label>
		<textarea class="span6" name="page_description" placeholder="Описание"></textarea>
		<label>H1: </label>
		<input type="text" name="page_h1" class="span6" value="" placeholder="H1" />
		<label>URL:</label>
		<input type="text" name="page_url" class="span3" value="" placeholder="URL страницы" />
		<blockquote>
			<small>Если поле оставить пустым, то назначиться транслит названия</small>
		</blockquote>
	</div>
	<hr/>
	<div class="control-group">
		<label>Название: <em>(обязательное)</em></label>
		<input type="text" name="title" class="span6 valid-required" value="" placeholder="" />
		<label>Оплата:</label>
		<input type="text" name="salary" class="span3" value="" placeholder="" />
	</div>
	<div class="control-group">
		<label>Условия:</label>
		<textarea class="redactor" rows="5" name="conditions"></textarea>
		<label>Обязанности:</label>
		<textarea class="redactor" rows="5" name="responsibility"></textarea>
		<label>Требования:</label>
		<textarea class="redactor" rows="5" name="requirements"></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Добавить</button>
	</div>
<?=form_close();?>