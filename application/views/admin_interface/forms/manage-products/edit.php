<?=form_open(ADMIN_START_PAGE.'/products/update?mode=edit&id='.$this->input->get('id'),array('class'=>'form-manage-products')); ?>
	<div class="control-group">
		<label>Title: </label>
		<input type="text" name="page_title" class="span6" value="<?=$product['page_title'];?>" placeholder="Title" />
		<label>Description:</label>
		<textarea class="span6" name="page_description" placeholder="Описание"><?=$product['page_description'];?></textarea>
        <label>KeyWords:</label>
        <textarea class="span6" name="page_keywords" placeholder="Ключевые слова"><?=$product['page_keywords'];?></textarea>
		<label>H1: </label>
		<input type="text" name="page_h1" class="span6" value="<?=$product['page_h1'];?>" placeholder="H1" />
		<label>URL:</label>
		<input type="text" name="page_url" class="span3" value="<?=$product['page_url'];?>" placeholder="URL страницы" />
		<blockquote>
			<small>Если поле оставить пустым, то назначиться транслит названия</small>
		</blockquote>
	</div>
	<hr/>
	<div class="control-group">
		<label>Название: <em>(обязательное)</em></label>
		<input type="text" name="title" class="span6 valid-required" value="<?=$product['title'];?>" placeholder="" />
        <label>Цена:</label>
        <input type="text" name="price" class="span2" value="<?=$product['price'];?>" placeholder="" />
        <?php $this->load->view('html/select-choise-category',array('categories'=>$categories));?>
		<label>Ключевые слова:</label>
		<input type="text" name="keywords" class="span6" value="<?=$product['keywords'];?>" placeholder="" />
	</div>
	<div class="control-group">
		<label>Объемы:</label>
		<select class="span3 multiselect-chosen" multiple="" name="size[]">
		<?php for($i=0;$i<count($tara);$i++):?>
			<optgroup label="<?=$tara[$i]['title'];?>">
			<?php for($j=0;$j<count($sizes);$j++):?>
				<?php if($sizes[$j]['tara'] == $tara[$i]['id']):?>
				<option value="<?=$sizes[$j]['id'];?>"<?=($sizes[$j]['isSize'])?' selected="selected"':''?>><?=$sizes[$j]['title'];?></option>
				<?php endif;?>
			<?php endfor;?>
			</optgroup>
		<?php endfor;?>
		</select>
	</div>
	<div class="control-group">
		<label>Похожие товары:</label>
		<select class="span6 multiselect-chosen" multiple="" name="similar[]">
		<?php for($i=0;$i<count($similars);$i++):?>
			<?php if($similars[$i]['id'] != $this->input->get('id')):?>
			<option value="<?=$similars[$i]['id'];?>"<?=($similars[$i]['isSimilar'])?' selected="selected"':'';?>><?=$similars[$i]['title'];?></option>
			<?php endif;?>
		<?php endfor;?>
		</select>
	</div>
	<div class="control-group">
		<label>Назначение:</label>
		<textarea class="span9" rows="2" name="destination"><?=$product['destination'];?></textarea>
		<label>Описание:</label>
		<textarea class="redactor" rows="5" name="description"><?=$product['description'];?></textarea>
		<label>Преимущества:</label>
		<textarea class="redactor" rows="5" name="advantages"><?=$product['advantages'];?></textarea>
		<label>Применение:</label>
		<textarea class="redactor" rows="5" name="applying"><?=$product['applying'];?></textarea>
	</div>
	<hr/>
	<div class="controls">
		<label>Изображение:</label>
	<?php if(!empty($product['logo'])):?>
		<div class="clearfix">
			<img class="img-rounded destination-photo" src="<?=base_url($product['logo']);?>" title="">
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
		<a href="<?=site_url(ADMIN_START_PAGE.'/products')?>" class="btn btn-info">Завершить</a>
	</div>
<?=form_close();?>