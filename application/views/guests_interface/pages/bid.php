<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
</head>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. 
	Please <a href="http://browsehappy.com/">upgrade your browser</a> or 
	<a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="wrapper">
		<div class="main clearfix">
			<div class="texture-left"></div>
			<div class="texture-right"></div>
			<div class="main-container">
				<?php $this->load->view('guests_interface/includes/small-menu');?>
				<?php $this->load->view('guests_interface/includes/header');?>
				<?php $this->load->view('guests_interface/includes/navigation');?>
				<h1 class="hidden"></h1>
				<section class="bag clearfix bid-section">
					<header>
						<div class="header_bg">
							<h2> Корзина </h2>
						</div>
					</header>
				<?php if(!empty($products)):?>
					<table class="bid-table form-send-order">
						<thead>
							<tr>
								<th>Наименование</th>
								<th>Объем</th>
								<th>Количество</th>
							</tr>
						</thead>
						<tbody class="full-order-product-list">
						<?php for($i=0;$i<count($products);$i++):?>
							<tr class="order-product-list" data-order-number="<?=$products[$i]['number'];?>">
								<td class="name">
									<a href="<?=site_url('product/'.$products[$i]['page_url'])?>"><?=$products[$i]['title'];?></a>
								</td>
								<td class="value">
									<label>
										<select name="size_product" class="select-size-product">
									<?php for($j=0;$j<count($products[$i]['tara']);$j++):?>
											<optgroup label="<?=$products[$i]['tara'][$j]['title'];?>">
										<?php for($k=0;$k<count($products[$i]['sizes']);$k++):?>
											<?php if($products[$i]['sizes'][$k]['tara'] == $products[$i]['tara'][$j]['id'] && $products[$i]['sizes'][$k]['isSize'] === TRUE):?>
											<option value="<?=$products[$i]['sizes'][$k]['id'];?>" <?=($products[$i]['sizes'][$k]['id'] == $products[$i]['product_size'])?' selected="selected"':'';?>>
												<?=$products[$i]['sizes'][$k]['title'];?>
											</option>
											<?php endif;?>
										<?php endfor;?>
											</optgroup>
									<?php endfor;?>
										</select>
									</label>
								</td>
								<td class="quantity">
									<input class="quantity input-count-product" name="count_product" value="<?=$products[$i]['product_count'];?>" />
								</td>
								<td class="button">
									<div class="order-right-button order-delete-product">&#10005;</div>
								</td>
							</tr>
						<?php endfor;?>
						</tbody>
					</table>
				<?php else:?>
					<p>Корзина пуста</p>
				<?php endif;?>
				</section>
			<?php if(!empty($products)):?>
				<section class="bid-form clearfix form-send-order">
					<header>
						<div class="header_bg">
							<h2> Заявка </h2>
						</div>
					</header>
					<?php $this->load->view('guests_interface/forms/bid-order')?>
				</section>
			<?php endif;?>
			</div>
		</div>
	</div>
	<?php $this->load->view('guests_interface/forms/order-call');?>
	<?php $this->load->view('guests_interface/includes/small-footer');?>
	<?php $this->load->view('guests_interface/includes/footer');?>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<?php $this->load->view('guests_interface/includes/google-analytics');?>
</body>
</html>