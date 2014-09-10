<nav>
	<ul class="nav-list">
	<?php for($i=0;$i<count($main_menu);$i++):?>
		<?php $li = '<li class="nav-list-item';
			if ($main_menu[$i]['id'] == 3):
				$li .= ' science-base-item';
			elseif($main_menu[$i]['id'] == 6):
				$li .= ' where2buy-item';
			endif;
			$li .= '">';
		?>
		<?=$li;?>
			<a href="<?=site_url($main_menu[$i]['page_url']);?>"><?=$main_menu[$i]['title']?></a>
			<?php if ($main_menu[$i]['id'] == 2):?>			
				<?php $this->load->view('guests_interface/includes/sub-navigation');?>
			<?php endif;?>
	<?php endfor;?>
		<li class="nav-list-item nav-srch-item">
			<?php $this->load->view('guests_interface/forms/search');?>			
		</li>
	</ul>	
</nav>