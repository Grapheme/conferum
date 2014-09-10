<?=form_open(ADMIN_START_PAGE.'/volume/insert',array('class'=>'form-manage-volume')); ?>
	<div class="control-group">
		<label>Вес, объем: <em>(обязательное)</em></label>
		<input type="text" name="title" class="span3 valid-required" value="" placeholder="" /><br/>
		<label>№ п.п.:</label>
		<input type="text" name="number" class="span1 valid-numeric" value="" placeholder="" /><br/>
		<?php $this->load->view('html/select-tara');?>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Добавить</button>
	</div>
<?=form_close();?>