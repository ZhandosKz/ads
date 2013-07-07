<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#"><?=Yii::app()->name?></a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li>
						<a href="/publish-ads">Добавить объявление</a>
					</li>
				</ul>
				<?php if (Yii::app()->user->isGuest):?>
					<form class="navbar-form pull-right" action="/login" method="post">
						<input class="span2" type="text" placeholder="имя пользователя" name="LoginForm[username]">
						<input class="span2" type="password" placeholder="пароль" name="LoginForm[password]">
						<button class="btn" type="submit">Войти</button>
					</form>
					<?php else:?>
					<p class="navbar-text pull-right">
						Вы зашли как <?=Yii::app()->user->name?>, <a href="/cabinet">Кабинет</a> <a href="/logout">Выйти</a>
					</p>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>