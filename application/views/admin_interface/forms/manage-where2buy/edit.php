<?=form_open(ADMIN_START_PAGE.'/where2buy/update?mode=edit&id='.$this->input->get('id'),array('class'=>'form-manage-where2buy')); ?>
	<div class="control-group">
		<label>Город: <em>(обязательное)</em></label>
		<input type="text" name="city" class="span3 valid-required" value="<?=$where2buy['city']?>" placeholder="Город" />
		<label>Ссылка на карте: <em>(обязательное)</em></label>
		<input type="text" name="link" class="span3 valid-required" value="<?=$where2buy['link']?>" placeholder="Ссылка на карте" />
		<label>Адрес:</label>
		<textarea rows="5" class="redactor" name="address"><?=$where2buy['address']?></textarea>
		<label>Группа:</label>
		<select name="number_group">
			<option value="1"<?= $where2buy['number_group'] == 1 ? ' selected':'' ?>>Официальное представительство</option>
			<option value="2"<?= $where2buy['number_group'] == 2 ? ' selected':'' ?>>Дилеры</option>
			<option value="3"<?= $where2buy['number_group'] == 3 ? ' selected':'' ?>>Дилеры в странах ближнего зарубежья</option>
		</select>
		<label>№ п.п.:</label>
		<input type="text" name="sort" class="span1 valid-required" value="<?=$where2buy['sort']?>"/>
	</div>
	<hr/>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>