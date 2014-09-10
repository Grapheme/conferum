<?=form_open(ADMIN_START_PAGE.'/press-centr/insert?mode=insert',array('class'=>'form-manage-press-centr')); ?>
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
		<input type="text" name="title" class="span6 valid-required" value="" placeholder="Название" />
		<label>Дата публикации: <em>(обязательное)</em></label>
		<input type="text" name="date" class="span2 valid-required set-news-data" readonly="readonly" value="" placeholder="" />
	</div>
	<div class="control-group">
		<label>Анонс:</label>
		<textarea class="redactor" rows="5" name="anonce"></textarea>
		<label>Контент:</label>
		<textarea class="redactor" rows="10" name="content"></textarea>
	</div>
	<hr/>
	<div class="controls">
		<label>Изображение:</label>
		<input type="file" autocomplete="off" name="file" size="52">
		<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
		<div id="div-upload-photo" class="bar-file-upload hidden">
			<div class="progress progress-info progress-striped active">
				<div class="bar" style="width: 0%"></div>
			</div>
		</div>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-img-submit btn-success no-clickable btn-loading">Сохранить</button>
	</div>
<?= form_close(); ?>