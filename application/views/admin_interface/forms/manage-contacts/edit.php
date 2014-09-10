<?=form_open(ADMIN_START_PAGE.'/contact/update?mode=edit&id='.$this->input->get('id'),array('class'=>'form-manage-contacts')); ?>
	<div class="control-group">
		<label>Адрес:</label>
		<textarea rows="5" class="span6" name="address"><?=$contact['address']?></textarea>
		<label>Телефон:</label>
		<textarea rows="5" class="span6" name="phones"><?=$contact['phones']?></textarea>
		<label>Email:</label>
		<textarea rows="5" class="span6" name="emails"><?=$contact['emails']?></textarea>
	</div>
	<hr/>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>