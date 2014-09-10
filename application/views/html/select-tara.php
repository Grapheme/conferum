<select autocomplete="off" class="select-tara valid-required" name="tara">
<option value="">Выберите тару</option>
<?php for($i=0;$i<count($tara);$i++):?>
	<option value="<?=$tara[$i]['id'];?>" <?=($this->input->get('tara') == $tara[$i]['id'])?'selected="selected"':'';?>><?=$tara[$i]['title'];?></option>
<?php endfor;?>
</select>