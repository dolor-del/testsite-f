<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?= $title ?></title>
	<link href="/public/css/normalize.css" rel="stylesheet" type="text/css">
	<link href="/public/css/style.css" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/public/img/favicon.png" rel="shortcut icon">
	<script src="/public/scripts/jquery.js"></script>
	<!--<script src="/public/scripts/form.js"></script>-->
</head>
<body>

<div class="content">

	<header>

		<div class="container_logo">
			<a href="/">
				ONLINE<span>TEST</span>
			</a>
		</div>

		<div class="panel_1">
			<ul>
				<?php if (isset($_SESSION['user'])) : ?>
					<span style="font-size: 13px">Вы вошли как </span><span style="color: #008000; font-weight:bold"><?= $_SESSION['user']['login'] ?></span>
				<?php endif; ?>

				<?php if ($_SERVER ['REMOTE_ADDR'] == '12.0.0.1' or ((isset($_SESSION['user']) and $_SESSION['user']['access'] == 5))) : ?>
					<li>
						<a href="/admin">АДМИН</a>
					</li>
				<?php endif; ?>

					<li>
						<a id="autho" href="<?= isset($_SESSION['user']) ? '/account/edit' : '/account/login' ?>">МОЙ АККАУНТ</a>
					</li>

				<?php if (isset($_SESSION['user'])) : ?>
					<li>
						<a href="/account/logout">ВЫЙТИ</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>

	</header>

	<div class="black_stripe_width">
		<div class="flex_black_stripe">
			<div>
				<ul>
					<li><a href="/">Главная</a></li>
					<li><a href="#">О нас</a></li>
					<li><a href="#">Контакты</a></li>
					<li><a href="#">Политика конфиденциальности</a></li>
				</ul>
			</div>
			<div class="container_search">
				<form action="" method="post">
					<input type="text" placeholder="Search" name="search" value="<?= $_POST['search'] ?? '' ?>">
					<button type="submit" name=""><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
			</div>
		</div>
	</div>

	<div style="width: 1170px; margin: 20px auto">
		<!-- ВЫВОДИМ СФОРМИРОВАННЫЙ КОНТЕНТ -->
		<?= $content ?>

	</div>
</div>

<div class="back_shadow">
	<footer>
		<a href="#">Powered by Shaboltas I.V.</a>
		&copy;<?= ' '.$created ?>
	</footer>
</div>
</body>
</html>