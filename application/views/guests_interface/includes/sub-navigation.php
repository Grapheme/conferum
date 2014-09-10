<?php 
if(!isset($page_content['menu_position'])):
	$page_content['menu_position'] = -1;
endif;
?>
<div class="about-side-container">
	<ul class="about-side-list">
	<?php for($i=0;$i<count($sub_menu);$i++):?>
		<li class="about-side-item"><a <?=(uri_string() == $sub_menu[$i]['page_url'])?'class="no-clickable"':'';?> href="<?=site_url($sub_menu[$i]['page_url']);?>"><?=$sub_menu[$i]['title']?></a></li>
	<?php endfor;?>
	</ul>
</div>