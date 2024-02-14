[not-group=5] 
<div class="login-box">
	<div class="login-avatar">
		<div class="avatar-box">
			<img src="{foto}" title="{login}" alt="{login}" />
		</div>
	</div>
	<div class="login-title">{login}</div>
	<ul class="login-menu">
		[admin-link]<li><a href="{admin-link}" target="_blank">Админпанель</a></li>[/admin-link]
		<li><a href="{profile-link}">Мой профиль</a></li>
		<li><a href="{newposts-link}">Непрочитанное</a></li>
		<li><a href="{logout-link}">Выйти</a></li>
	</ul>
</div>
[/not-group]
[group=5]
<div class="login-box">
	<div class="login-title">Вход на сайт</div>
	<div class="login-form">
		<form method="post">
			<div class="login-input">
				<input type="text" name="login_name" id="login_name" placeholder="Ваш email"/></li>
			</div>
			<div class="login-input">
				<input type="password" name="login_password" id="login_password" placeholder="Ваш пароль" /></li>
			</div>
			<div class="login-button">
				<button onclick="submit();" type="submit" title="Вход">Войти на сайт</button>
				<input name="login" type="hidden" id="login" value="submit" />
			</div>
			<div class="login-checkbox">
				<input type="checkbox" name="login_not_save" id="login_not_save" value="1"/>
				<label for="login_not_save">&nbsp;Чужой компьютер</label> 
			</div>
			<div class="login-links clearfix">
				<a href="{lostpassword-link}">Забыли пароль?</a>
				<a href="{registration-link}" class="log-register">Регистрация</a>
			</div>
		</form>
	</div>
	<div class="clr"></div>
	<div class="login-social clearfix">
	    [vk]<a href="{vk_url}" target="_blank"><img src="{THEME}/images/social/vkontakte.gif" /></a>[/vk]
	    [odnoklassniki]<a href="{odnoklassniki_url}" target="_blank"><img src="{THEME}/images/social/odnoklassniki.gif" /></a>[/odnoklassniki]
	    [facebook]<a href="{facebook_url}" target="_blank"><img src="{THEME}/images/social/facebook.gif" /></a>[/facebook]
	    [mailru]<a href="{mailru_url}" target="_blank"><img src="{THEME}/images/social/mailru.gif" /></a>[/mailru]
	    [yandex]<a href="{yandex_url}" target="_blank"><img src="{THEME}/images/social/yandex.gif" /></a>[/yandex]
	    [google]<a href="{google_url}" target="_blank"><img src="{THEME}/images/social/google.gif" /></a>[/google]				
	</div>
</div>																																																																																																																																	[aviable=showfull]<span style="display:none;">лучший сайт где можно скачать <a href="http://newtemplates.ru/dle112/">шаблоны для dle 11.2</a> бесплатно</span>[/aviable]
[/group]