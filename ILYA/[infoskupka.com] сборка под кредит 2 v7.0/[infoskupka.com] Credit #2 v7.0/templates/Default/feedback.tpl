<div class="page_reg">
	<div class="line-on-reg"> 
		<span>Обратная связь</span>
    </div>
	<ul class="reg-form">
	[not-logged]
		<li class="form-group">
			<label for="name">Имя</label>
			<input type="text" maxlength="35" name="name" id="name" class="wide" required>
		</li>
		<li class="form-group">
			<label for="email">Email</label>
			<input type="email" maxlength="35" name="email" id="email" class="wide" required>
		</li>
	[/not-logged]
				<li class="form-group">
					<label for="subject">Тема сообщения</label>
					<input type="text" maxlength="45" name="subject" id="subject" class="wide" required>
				</li>
				<div style="display:none;"><select name="recip"><option selected="selected" value="1">Администрация</option></select></div>
				<li class="form-group">
					<textarea name="message" id="message" rows="8" class="wide" required></textarea>
				</li>
			[recaptcha]
				<li class="form-group">{recaptcha}</li>
			[/recaptcha]
			[question]
				<li class="form-group">
					<label for="question_answer">Вопрос: {question}</label>
					<input placeholder="Ответ" type="text" name="question_answer" id="question_answer" class="wide" required>
				</li>
			[/question]
			</ul>
			<div class="form_submit">
				<button class="bnts" type="submit" name="send_btn"><b>Отправить сообщение</b></button>
			</div>
		</div>
</div>
