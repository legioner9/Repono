<div class="page_reg">
	<div class="line-on-reg"> 
		<span>Восстановить пароль</span>
    </div>
	<div class="page_form__form">
		<ul class="reg-form">
			<li class="form-group">
				<label for="lostname">Логин или E-mail</label>
				<input type="text" name="lostname" id="lostname" class="wide" required>
			</li>
		[sec_code]
			<li class="form-group">
				<div class="c-captcha">
					{code}
					<input placeholder="Повторите код" title="Введите код указанный на картинке" type="text" name="sec_code" id="sec_code" required>
				</div>
			</li>
		[/sec_code]
		[recaptcha]
			<li class="form-group">{recaptcha}</li>
		[/recaptcha]
		</ul>
		<div class="form_submit">
			<button class="bnts" name="submit" type="submit">Восстановить</button>
		</div>
	</div>
</div>