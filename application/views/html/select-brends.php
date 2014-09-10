<select autocomplete="off" class="select-brend" name="brend">
<option value="">Выберите фабрику</option>
<?php for($i=0;$i<count($brends);$i++):?>
	<option value="<?=$brends[$i]['id'];?>" <?=($this->input->get('brend') == $brends[$i]['id'])?'selected="selected"':'';?>><?=$brends[$i]['ru_title'];?></option>
<?php endfor;?>
</select>