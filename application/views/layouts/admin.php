<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?= $title ?></title>
	<link href="/public/css/normalize.css" rel="stylesheet" type="text/css">
	<link href="/public/css/cms_style.css" rel="stylesheet" type="text/css">
	<link href="/public/img/favicon_adm.png" rel="shortcut icon">
	<script src="/public/scripts/jquery.js"></script>
	<!--<script src="/public/scripts/form.js"></script>-->
</head>
<body>

<div class="wrapper">
	<header>
		<div class="container_header">
			<div class="container_head_adm">
				<a href="/admin">ADMIN</a>
			</div>
			<div class="container_head_main">
				<a href="/">ГЛАВНАЯ</a>
			</div>
			<?php if (isset($_SESSION['user']['login'])) : ?>
				<div class="container_head_profile">
					<span class="profile">Hello, <?= '<span>'.$_SESSION['user']['login'].'</span>' ?>!</span>
				</div>
			<?php endif; ?>
		</div>
	</header>

	<div class="content">
		<div style="width: 1170px; margin: 20px auto ">
			<?= $content ?>
		</div>

	</div>

	<div class="footer">
		<footer></footer>
	</div>
</div>