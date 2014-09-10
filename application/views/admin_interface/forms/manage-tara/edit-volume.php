<?=form_open(ADMIN_START_PAGE.'/volume/update?id='.$this->input->get('id'),array('class'=>'form-manage-volume')); ?>
	<div class="control-group">
		<label>Вес, объем: <em>(обязательное)</em></label>
		<input type="text" name="title" class="span3 valid-required" value="<?=$volume['title']?>" placeholder="" /><br/>
		<label>№ п.п.:</label>
		<input type="text" name="number" class="span1 valid-numeric" value="<?=$volume['number']?>" placeholder="" /><br/>
		<?php $this->load->view('html/select-tara');?>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>