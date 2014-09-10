<form action="<?=site_url('consultation-call')?>" method="POST" class="work-form">
	<p>
		Символом<span class="red-span"> * </span>отмечены поля, обязательные для заполнения
	</p>
	<fieldset>
		<label class="block-label" for="">Ф.И.О.:</label>
		<input class="" name="fio" type="text">
		<label class="block-label" for="">Электронная почта<span class="red-span">*</span>:</label>
		<input class="valid-required valid-email" name="email" type="text">
		<label class="block-label" for="">Сообщение:</label>
		<textarea name="message"> </textarea>
		<div class="div-form-operation">
			<input class="btn-submit no-clickable" type="submit" value="Отправить">
		</div>
	</fieldset>
</form>