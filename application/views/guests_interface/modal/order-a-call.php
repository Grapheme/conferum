<div class="order-a-call">
	<div class="form-container">
		<div class="form-cross">✕</div>
		<div class="order-a-call-header">Заказать звонок</div>
		<form action="<?=site_url('order-a-call')?>" method="POST">
			<p>
				Символом <span class="red-span">*</span> отмечены поля, обязательные для заполнения
			</p>
			<div>
				<label>Ф.И.О.<span class="red-span">*</span>:</label>
				<input class="valid-required" name="fio" type="text">
			</div>
			<div>
				<label>Телефон<span class="red-span">*</span>:</label>
				<input class="valid-required valid-phone-number" name="phone" type="text">
			</div>
			<div>
				<label>Удобное время:</label>
				<input class="valid-required" name="time" type="text">
			</div>
			<div class="div-form-operation">
				<input type="submit" class="add-to-cart-btn btn-submit no-clickable" value="Отправить" >
			</div>
		</form>
	</div>
</div>