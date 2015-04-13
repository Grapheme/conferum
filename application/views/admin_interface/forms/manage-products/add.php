<?=form_open(ADMIN_START_PAGE.'/products/insert',array('class'=>'form-manage-products')); ?>
	<div class="control-group">
		<label>Title: </label>
		<input type="text" name="page_title" class="span6" value="" placeholder="Title" />
		<label>Description:</label>
		<textarea class="span6" name="page_description" placeholder="Описание"></textarea>
        <label>KeyWords:</label>
        <textarea class="span6" name="page_keywords" placeholder="Ключевые слова"></textarea>
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
		<input type="text" name="title" class="span6 valid-required" value="" placeholder="" />
        <label>Цена:</label>
        <input type="text" name="price" class="span2" value="" placeholder="" />
		<?php $this->load->view('html/select-choise-category',array('categories'=>$categories));?>
		<label>Ключевые слова:</label>
		<input type="text" name="keywords" class="span6" value="" placeholder="" />
	</div>
	<div class="control-group">
		<label>Объемы:</label>
		<select class="span3 multiselect-chosen" multiple="" name="size[]">
		<?php for($i=0;$i<count($tara);$i++):?>
			<optgroup label="<?=$tara[$i]['title'];?>">
			<?php for($j=0;$j<count($volumes);$j++):?>
				<?php if($volumes[$j]['tara'] == $tara[$i]['id']):?>
				<option value="<?=$j;?>"><?=$volumes[$j]['title'];?></option>
				<?php endif;?>
			<?php endfor;?>
			</optgroup>
		<?php endfor;?>
		</select>
	</div>
	<div class="control-group">
		<label>Похожие товары:</label>
		<select class="span6 multiselect-chosen" multiple="" name="similar[]">
		<?php for($i=0;$i<count($products);$i++):?>
			<option value="<?=$products[$i]['id'];?>""><?=$products[$i]['title'];?></option>
		<?php endfor;?>
		</select>
	</div>
	<div class="control-group">
		<label>Назначение:</label>
		<textarea class="span9" rows="2" name="destination"></textarea>
		<label>Описание:</label>
		<textarea class="redactor" rows="5" name="description"></textarea>
		<label>Преимущества:</label>
		<textarea class="redactor" rows="5" name="advantages"></textarea>
		<label>Применение:</label>
		<textarea class="redactor" rows="5" name="applying"></textarea>
        <label>Услуги:</label>
		<textarea class="redactor" rows="5" name="services"></textarea>
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