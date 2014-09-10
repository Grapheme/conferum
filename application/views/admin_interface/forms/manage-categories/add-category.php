<?=form_open(ADMIN_START_PAGE.'/category/insert',array('class'=>'form-manage-category')); ?>
	<div class="control-group">
		<label>Title: </label>
		<input type="text" name="page_title" class="span6" value="" placeholder="Title" />
		<label>Description:</label>
		<textarea class="span6" name="page_description" placeholder="Описание"></textarea>
		<label>H1: </label>
		<input type="text" name="page_h1" class="span6" value="" placeholder="" />
	</div>
	<hr/>
	<div class="control-group">
		<label>Название: <em>(обязательное)</em></label>
		<input type="text" name="title" class="span3 valid-required" value="" placeholder="Название" />
		<label>Описание:</label>
		<textarea class="redactor" rows="10" name="description" placeholder="Описание"></textarea>
		<label>№ п.п.:</label>
		<input type="text" name="number" class="span1 valid-numeric" value="" placeholder="" /><br/>
	</div>
	<div class="control-group">
		<label>Категория:</label>
		<select name="parent">
			<option value="0">Основная категория</option>
		<?php for($i=0;$i<count($categories);$i++):?>
			<option value="<?=$categories[$i]['id']?>"><?=$categories[$i]['title'];?></option>
		<?php endfor;?>
		</select>
	</div>
	<hr/>
	<div class="control-group">
		<label>URL: <em>(обязательное)</em></label>
		<input type="text" name="page_url" class="span3 valid-required" value="" placeholder="" />
		<blockquote>
			<small>Может содержать только буквы, цифры, символы подчеркивания и тире.</small>
		</blockquote>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Добавить</button>
	</div>
<?=form_close();?>