<label>Категория:</label>
<select autocomplete="off" class="span8 set-category multiselect-chosen" multiple="" name="category[]">
<?php for($i=0;$i<count($categories);$i++):?>
	<?php if($categories[$i]['sub_category'] == 0):?>
	<option value="<?=$categories[$i]['id'];?>" <?=($categories[$i]['selected'])?'selected="selected"':'';?>><?=$categories[$i]['title'];?></option>
	<?php endif;?>
<?php endfor;?>
</select>
<label>Под категория:</label>
<select autocomplete="off" class="span8 set-sub-category multiselect-chosen" multiple="" name="sub_category[]">
	<option value=""></option>
<?php for($i=0;$i<count($categories);$i++):?>
	<?php if($categories[$i]['sub_category'] == 1):?>
	<option value="<?=$categories[$i]['id'];?>" <?=($categories[$i]['selected'])?'selected="selected"':'';?>><?=$categories[$i]['title'];?></option>
	<?php endif;?>
<?php endfor;?>
</select>