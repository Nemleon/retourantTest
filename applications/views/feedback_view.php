<?php $title = "Обратная связь"; ?>
<div class = 'main'>
	<h1>Обратная связь</h1>
	<div class = 'articles'><h2>Здесь Вы можете оставить отзыв о нашем ресторане! Понравилось Вам или нет, что именно, ну или просто отблагодарить нас! :D</h2></div>
	<div class = 'spaceContent'>
			<p><?php if ($data) {echo $data;}?></p>
			<?php if ($errors) { ?>
			<div class = 'formErrors'>
				<p>Ошибочки! Прошу исправить:</p>
				<ul>
					<li> <?= implode('</li><li>', $errors); ?> </li>
				</ul>
			</div>
			<?php } ?>
			<form action='/feedback' method="POST" id="form">
				<p><b>Ваше имя</b></p>
					<input class = 'textInput' placeholder="Представьтесь" name="name" type="text" >
				<p><b>Ваш Email</b></p>
					<input class = 'textInput' placeholder="Укажите почту" name="email" type="text" >
				<p><b>Сообщение</b></p>
					<textarea maxlength = '500'  name="text"></textarea>
				<div class = 'positioningBut'>
					<input class = 'buttonSend' value="Отправить" type="submit">
					<div class = 'space'></div>
					<input class = 'buttonDelete' type="reset" value="Очистить">
				</div>	
				<p><a href="/">Вернуться на главную</a></p>
			</form>
	</div>
</div>