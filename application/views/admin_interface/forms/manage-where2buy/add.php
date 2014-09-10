<?=form_open(ADMIN_START_PAGE.'/where2buy/insert',array('class'=>'form-manage-where2buy')); ?>
	<div class="control-group">
		<label>Город: <em>(обязательное)</em></label>
		<input type="text" name="city" class="span3 valid-required" value="" placeholder="Город" />
		<label>Ссылка на карте: <em>(обязательное)</em></label>
		<input type="text" name="link" class="span3 valid-required" value="" placeholder="Ссылка на карте" />
		<label>Адрес:</label>
		<textarea rows="5" class="redactor" name="address"></textarea>
		<label>№ п.п.:</label>
		<input type="text" name="sort" class="span1 valid-required" value="0"/>
	</div>
	<hr/>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Добавить</button>
	</div>
<?=form_close();?>