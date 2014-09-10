<?=form_open(ADMIN_START_PAGE.'/template/insert',array('class'=>'form-manage-template')); ?>
	<div class="control-group">
		<label>Имя шаблона: <em>(обязательное)</em></label>
		<input type="text" name="file_name" class="span3 valid-required" value="" placeholder="" />
		<blockquote>
			<small>Может содержать только буквы, цифры, символы подчеркивания и тире.</small>
			<small>Имя файла шаблона указыватся без расширения .php, и постфикса _template.</small>
			<small><span class="label label-important">Внимание!</span> Шаблон должен присутствовать на сервере</small>
		</blockquote>
		<label>Описание шаблона: <em>(обязательное)</em></label>
		<textarea name="comments" rows="2" class="span6 valid-required" value="" placeholder=""> </textarea>
	</div>
	<div class="control-group">
		<label>Елементы управления: </label>
		<textarea name="fields" rows="10" class="span6" value="" placeholder=""> </textarea>
		<blockquote>
			<small>HTML код елементов управления. Используются для редактирования контента страницы</small>
			<small><span class="label label-important">Внимание!</span> Имена полей должны соответствовать переменным шаблона</small>
		</blockquote>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit btn-success no-clickable btn-loading">Добавить</button>
	</div>
<?= form_close(); ?>