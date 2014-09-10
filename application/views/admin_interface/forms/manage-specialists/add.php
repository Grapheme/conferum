<?=form_open(ADMIN_START_PAGE.'/specialist/insert',array('class'=>'form-manage-specialist')); ?>
	<div class="control-group">
		<label>Имя: <em>(обязательное)</em></label>
		<input type="text" name="name" class="span3 valid-required" value="" placeholder="Имя" />
		<label>Должность:</label>
		<input type="text" name="position" class="span3" value="" placeholder="Должность" />
		<label>Описание:</label>
		<textarea rows="10" class="redactor" name="content"></textarea>
	</div>
	<hr/>
	<div class="controls">
		<label>Изображение:</label>
		<input type="file" class="valid-required" autocomplete="off" name="file" size="52">
		<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
		<div id="div-upload-photo" class="bar-file-upload hidden">
			<div class="progress progress-info progress-striped active">
				<div class="bar" style="width: 0%"></div>
			</div>
		</div>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-img-submit no-clickable btn-loading">Добавить</button>
	</div>
<?=form_close();?>