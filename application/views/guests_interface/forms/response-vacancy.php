<form action="<?=site_url('send-response-vacancy')?>" method="POST" class="work-form">
	<input name="vacancy" type="hidden" value="<?=$vacancy['id'];?>">
	<fieldset>
		<label class="block-label" for="">Ф.И.О.<span class="red-span"> *</span>:</label>
		<input class="valid-required" name="fio" type="text">
		<label class="block-label" for="">Электронная почта:</label>
		<input class="valid-email" name="email" type="text">
		<label class="block-label" for="">Телефон:<span class="red-span"> *</span></label>
		<input class="valid-required valid-phone-number" name="phone" type="text">
		<label class="block-label" for="">О себе:</label>
		<textarea name="message"> </textarea>
		<div class="input-fieldset">
			<label for="input-file">Приложить резюме:<span class="red-span">*</span></label>
			<label class="input-file-button" for="input-file">выберите файл</label>
			<input class="hidden" id="input-file"type="file" />
		</div>
		<div class="div-form-operation">
			<input class="btn-submit no-clickable" name="submit" type="submit" value="Отправить">
		</div>
	</fieldset>
</form>