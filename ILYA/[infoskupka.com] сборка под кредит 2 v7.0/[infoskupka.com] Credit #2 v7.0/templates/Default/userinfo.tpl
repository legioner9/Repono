<article class="box story">
	<h1 class="back-cont-tit">
		<img src="{foto}" style="border-radius: 50%; height: 30px; margin-right: 20px;">{usertitle}
	</h1>
	<div class="clr"></div>
	<div class="box_in">
		<div class="tab-content">
			<div class="tab-pane active" id="user1">
				<ul class="usinf">
					<li><div class="ui-c1 grey">Имя</div> <div class="ui-c2">{fullname}[not-fullname]Неизвестно[/not-fullname]</div></li>
					<li><div class="ui-c1 grey">Место жительства</div> <div class="ui-c2">{land}[not-land]Неизвестно[/not-land]</div></li>
					<li><div class="ui-c1 grey">Последняя активность</div> <div class="ui-c2">{lastdate}</div></li>
					<li><div class="ui-c1 grey">Группа</div> <div class="ui-c2">{status}</div></li>
					<li><div class="ui-c1 grey">Статус</div> <div class="ui-c2">[online]<span style="color: #70bb39;">Онлайн</span>[/online][offline]Офлайн[/offline]</div></li>
				</ul>
				<ul class="usinf">
					<li><div class="ui-c1 grey">Кол-во комментариев</div> <div class="ui-c2">{comm-num}</div></li>
				</ul>
			</div>
			<div class="editprof">{edituser}</div>
			[not-logged]
			<div class="tab-pane" id="user2">
				<!-- Настройки пользователя -->
				<div id="options" style="display:none;">
					<div class="addform">
						<div class="back-cont-time">
							<div class="back-cont-field"><input placeholder="Ваше имя" type="text" name="fullname" id="fullname" value="{fullname}" class="wide"></div>
							<div class="back-cont-field"><input placeholder="Ваш E-mail" type="text" name="email" id="email" value="{editmail}" class="wide" required></div>
							<div class="back-cont-field"><input placeholder="Город" type="text" name="land" id="land" value="{land}" class="wide"></div>
							<div class="back-cont-field"><input placeholder="Старый пароль" type="password" name="altpass" id="altpass" class="wide"></div>
							<div class="back-cont-field"><input placeholder="Новый пароль" type="password" name="password1" id="password1" class="wide"></div>
							<div class="back-cont-field"><input placeholder="Повторите новый пароль" type="password" name="password2" id="password2" class="wide"></div>
							<div class="back-cont-field-no">Загрузите аватар</div>
							<div class="back-cont-field"><input type="file" name="image" id="image" class="wide"></div>
						</div>
					</div>
					<div class="form_submit">
							<button class="back-cont-btn-add" name="submit" type="submit"><b>Сохранить</b></button>
							<input name="submit" type="hidden" id="submit" value="submit">
					</div>
				</div>
				<!-- / Настройки пользователя -->
			</div>
			[/not-logged]
		</div>
	</div>
</article>