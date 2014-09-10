<?php if(!empty($report)):?>

<table class="table">
	<thead>
		<tr>
			<th>Дата</th>
			<th>Примечание</th>
			<th>Приход</th>
			<th>Расход</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i=0;$i<count($report);$i++):?>
		<tr class="<?=($report[$i]['operation'] == 1)?'incoming':'outcoming';?>">
			<td><?=swap_dot_date_with_time($report[$i]['date']);?></td>
			<td><?=$report[$i]['description'];?></td>
			<td><?=($report[$i]['operation'] == 1)?$report[$i]['summa'].' руб.':'&nbsp;';?></td>
			<td><?=($report[$i]['operation'] > 1)?$report[$i]['summa'].' руб.':'&nbsp;';?></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>
<?php else:?>
<div class="msg-alert">
	Информация за указанный период отсутствует
</div>
<?php endif;?>