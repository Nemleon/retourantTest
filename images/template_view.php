<!DOCTYPE HTML>
<html lang='ru'>
	<head>
		<meta charset="utf-8">
		<title><?= $title ?></title>
		<link rel="shortcut icon" href="images/ico.png" type="image/png">
		<style><?php include_once 'css/style.css' ?> </style>
		<script src="js/hidder.js"></script>
		<script src="js/shadow.js"></script>
		<script src="js/visibility.js"></script>
	</head>
	<body>
		<header class='header'>
		<div class = 'headerSpace'>
			<div class = 'logo'>
				<a class = 'linkLogo' href="/"><img src = 'images/logomak_logo.png' alt = 'Пожирашки у Михашки' width = '100%' height = '50'></a>
			</div>
			<div class = 'hat' id = 'block1'>
				<h3><a class = 'link' href="/">Главная/Меню</a></h3></label>

				<h3><a class = 'link' href="/contacts">Контакты</a></h3>

				<h3><a class = 'link' href="/about">О нас</a></h3>

				<h3><a class = 'linkFeed' href="/feedback">Обратная связь</a></h3>
			</div>
			<div class = 'navigation' onClick="visibility('block1')"><h3>Навигация по сайту</h3></div>
		</div>
		</header>
		<div class = 'wrapper'>

			<?php include 'applications/views/'.$contentView; ?>

		</div>
		<footer class = 'footer'>
				<div class = 'footSpace'>
					<div class = 'footImg'><img src = 'images/logomak_logo.png' alt = 'Пожирашки у Михашки' width = '200' height = '50'></div>
					<div class = 'footList'>
						<a class = 'foot' href="/">Главная/Меню</a>
						<a class = 'foot' href="/contacts">Контакты</a>
						<a class = 'foot' href="/about">О нас</a>
						<a class = 'foot' href="/feedback">Обратная связь</a>
					</div>
					<div class = 'footEnd'><b>&copy; 2019</b></div>
				</div>
		</footer>
	</body>
</html>
