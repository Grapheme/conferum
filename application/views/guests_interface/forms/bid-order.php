<form action="<?=site_url('order-products')?>" method="POST" enctype="multipart/form-data" class="work-form">
	<p>Символом<span class="red-span">*</span>отмечены поля, обязательные для заполнения</p>
	<fieldset>
		<label class="block-label" for="">Ф.И.О.:<span class="red-span">*</span></label>
		<input class="valid-required" name="fio" type="text">
		<label class="block-label" for="">Электронная почта:</label>
		<input class="valid-email" name="email" type="text">
		<label class="block-label" for="">Телефон:<span class="red-span">*</span></label>
		<input class="valid-required valid-phone-number" name="phone" type="text">
		<label class="block-label" for="">Город:<span class="red-span">*</span></label>
		<input class="valid-required" name="city" type="text">
		<label class="block-label" for="">Реквизиты:</label>
		<input name="file" type="file">
		<div class="div-form-operation">
			<input class="btn-submit no-clickable" name="submit" type="submit" value="Отправить">
		</div>
	</fieldset>
</form>