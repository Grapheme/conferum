<div class="small-menu">
	<ul class="small-menu-buttons-list">
		<li class="small-search">
			<?php $this->load->view('guests_interface/forms/search-small');?>
		</li>
		<li class="small-button magnifier"><a class="no-clickable" href="#"> </a></li><li class="small-button trigger-button"><a class="no-clickable" href="#"> </a></li><li class="small-button small-bag"><a class="no-clickable" href="<?=site_url() . 'bid';?>"> </a></li>
	</ul>
	<div class="small-menu-body">
		<ul class="small-menu-list">
		<?php for($i=0;$i<count($main_menu);$i++):?>
			<li class="small-menu-item"><a href="<?=site_url($main_menu[$i]['page_url']);?>"><?=$main_menu[$i]['title']?></a></li>
		<?php endfor;?>
		<?php for($i=0;$i<count($sub_menu);$i++):?>
			<li class="small-menu-item"><a <?=(uri_string() == $sub_menu[$i]['page_url'])?'class="no-clickable"':'';?> href="<?=site_url($sub_menu[$i]['page_url']);?>"><?=$sub_menu[$i]['title']?></a></li>
		<?php endfor;?>
		</ul>
	</div>
</div>