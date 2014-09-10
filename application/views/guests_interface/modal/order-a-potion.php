<div class="order-a-potion-popup">
	<div class="form-container">
		<div class="form-cross">
			✕
		</div>
		<div class="order-a-call-header">
			Заказать средство
		</div>
		<form action="<?=site_url('order-a-potion')?>" method="POST">
			<p>
				Символом <span class="red-span">*</span> отмечены поля, обязательные для заполнения
			</p>
			<div>
				<label>Ф.И.О.<span class="red-span">*</span>:</label>
				<input class="valid-required" name="fio" type="text">
			</div>
			<div>
				<label>Email или Телефон<span class="red-span">*</span>:</label>
				<input class="valid-required" name="email" type="text">
			</div>
			<div>
				<label>Требования к средству</label>
				<textarea name="message"></textarea>
			</div>
			<div class="div-form-operation">
				<input type="submit" class="add-to-cart-btn btn-submit no-clickable" value="Отправить" >
			</div>
		</form>
	</div>
</div>