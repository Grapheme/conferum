<?=form_open(ADMIN_START_PAGE.'/reviews/update?mode=edit&id='.$this->input->get('id'),array('class'=>'form-manage-reviews')); ?>
	<div class="control-group">
		<label>Имя: <em>(обязательное)</em></label>
		<input type="text" name="name" class="span3 valid-required" value="<?=$reviews['name']?>" placeholder="" />
		<label>Город:</label>
		<input type="text" name="city" class="span3" value="<?=$reviews['city']?>" placeholder="" />
		<label>Описание:</label>
		<textarea rows="10" class="redactor" name="content"><?=$reviews['content']?></textarea>
	</div>
	<hr/>
	<div class="controls">
		<label>Изображение:</label>
		<?php if(!empty($reviews['logo'])):?>
			<div class="clearfix">
				<img class="img-rounded destination-photo" src="<?=base_url($reviews['logo']);?>" title="">
			</div>
		<?php endif;?>
		<input type="file" autocomplete="off" name="file" size="52">
		<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
		<div id="div-upload-photo" class="bar-file-upload hidden">
			<div class="progress progress-info progress-striped active">
				<div class="bar" style="width: 0%"></div>
			</div>
		</div>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-img-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>