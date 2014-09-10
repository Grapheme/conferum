<select autocomplete="off" class="select-category" name="category">
<option value="">Выберите категорию</option>
<?php for($i=0;$i<count($categories);$i++):?>
	<option value="<?=$categories[$i]['id'];?>" <?=($this->input->get('category') == $categories[$i]['id'])?'selected="selected"':'';?>><?=$categories[$i]['title'];?></option>
<?php endfor;?>
</select>