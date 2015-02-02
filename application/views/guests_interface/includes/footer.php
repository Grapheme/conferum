<footer>
	<div class="footer-items">
		<ul class="subnav-left">
		<?php for($i=0;$i<(count($footer_menu)/2);$i++):?>
			<li class="subnav-item"><a href="<?=site_url($footer_menu[$i]['page_url']);?>"><?=$footer_menu[$i]['title']?></a></li>
		<?php endfor;?>
			<li class="subnav-item"><a href="<?=site_url('product/sredstva-dlya-udaleniya-kraski-i-laka-feiyl-3');?>">Смывка краски</a></li>
			<li class="subnav-item"><a href="<?=site_url('http://www.conferum.ru/catalog/preobrazovateli-rjavchiny');?>">Преобразователь ржавчины</a></li>
		</ul>
		<ul class="subnav-right">
		<?php for($i=(count($footer_menu)/2);$i<count($footer_menu);$i++):?>
			<li class="subnav-item"><a href="<?=site_url($footer_menu[$i]['page_url']);?>"><?=$footer_menu[$i]['title']?></a></li>
		<?php endfor;?>
			<li class="subnav-item"><a href="<?=site_url('sitemap');?>">Карта сайта</a></li>
		</ul>
		<div class="contact-addresses">
			<address>г. Балашиха, Щелковское шоссе 54-Б</address>
			<address><a href="tel:+74955029290">+7 (495) 502-92-90</a></address>
			<address><a href="tel:+74952276263">+7 (495) 227-62-63</a></address>
			<address><a href="tel:+78002507744">+7 (800) 250-77-44</a></address>
			<address><a href="tel:+79169988616">+7 (916) 99-88-616</a></address>
			<address>email: <a href="mailto:<?=DEFAULT_MAIL;?>"><?=DEFAULT_MAIL;?></a></address> 
		</div>
		<div class="contact-us-bottom">
			<div class="contact-call-link summon-call-form">
				<div class="contact-icon contact-icon-cons"></div>
				<a class="no-clickable" href="#">Заказать звонок</a>
			</div>
			<div class="contact-call-link">
				<div class="contact-icon contact-icon-call"></div>
				<a href="<?=site_url('consultation');?>">Консультация специалиста</a>
			</div>
			<!-- Yandex.Metrika informer -->
			<a style="margin: 20px;" href="http://metrika.yandex.ru/stat/?id=678997&amp;from=informer"
			target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/678997/3_1_76DCBFFF_56BC9FFF_1_pageviews"
			style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:678997,lang:'ru'});return false}catch(e){}"/></a>
			<!-- /Yandex.Metrika informer -->
			<script type="text/javascript" src="<?=base_url('js/vendor/orphus.js');?>"></script>
			<a href="http://orphus.ru" id="orphus" target="_blank">
				<img alt="Система Orphus" src="<?=base_url('js/vendor/orphus.png');?>" border="0" width="183" height="33" style="margin-left: 1.6em;" />
			</a>
		</div>
	</div>
</footer> 
<?php $this->load->view('guests_interface/modal/order-a-call');?>