<div class="page_reg">
	<div class="line-on-reg"> 
		<span>
		[registration]Регистрация[/registration]
		[validation]Продолжение регистрации[/validation]
		</span>
    </div> 

	<div class="page_form__form">
		<div class="reg-text">
		[registration]
			Регистрация на нашем сайте позволит Вам быть его полноценным участником портала.
			Вы сможете добавлять свои комментарии, просматривать скрытый текст, участвовать в акциях и многое другое.
			<br>В случае возникновения проблем с регистрацией, обратитесь к <a href="/index.php?do=feedback">администратору</a> сайта.
		[/registration]
		[validation]
			Ваш аккаунт был зарегистрирован на нашем сайте, однако информация о Вас является неполной, поэтому ОБЯЗАТЕЛЬНО заполните дополнительные поля в Вашем профиле.<br>
		[/validation]
		</div>
		<ul class="reg-form">
		[registration]
			<li class="form-group">
				<label for="name">Логин</label>
				<div class="login_check">
					<input type="text" name="name" id="name" class="wide" required>
				</div>
				<div id="result-registration"></div>
			</li>
			<li class="form-group">
				<label for="password1">Пароль</label>
				<input type="password" name="password1" id="password1" class="wide" required>
			</li>
			<li class="form-group">
				<label for="password2">Повторите пароль</label>
				<input type="password" name="password2" id="password2" class="wide" required>
			</li>
			<li class="form-group">
				<label for="email">E-mail</label>
				<input type="email" name="email" id="email" class="wide" required>
			</li>
		[question]
			<li class="form-group">
				<label for="question_answer">{question}</label>
				<input placeholder="Введите ответ" type="text" name="question_answer" id="question_answer" class="wide" required>
			</li>
		[/question]

		[recaptcha]
			<li class="form-group">{recaptcha}</li>
		[/recaptcha]
		[/registration]
		[validation]
			<li class="form-group">
				<label for="fullname">Ваше имя</label>
				<input type="text" id="fullname" name="fullname" class="wide">
			</li>
			<li class="form-group">
				{xfields}
			</li>
			<li class="form-group">
				<label for="land">Место жительства</label>
				<input type="text" id="land" name="land" class="wide">
			</li>
			<li class="form-group">
				<label for="image">О себе</label>
				<textarea id="info" name="info" rows="5" class="wide"></textarea>
			</li>
			<li class="form-group">
				<label for="image">Аватар</label>
				<input type="file" id="image" name="image" class="wide">
			</li>
		[/validation]
		</ul>
		<div class="form_submit">
			<button class="bnts" name="submit" type="submit">Зарегистрироваться</button>
		</div>
	</div>
</div>