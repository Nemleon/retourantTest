<?php list($meals, $sumCost, $name, $delivery, $error) = $data; ?>
<div class = 'main'>
	<h1>Заказ</h1>
	<div class = 'articles'><h2>Здравствуйте <?= $name['firstName'] ?>!</h2></div>
	<?php
	if (!$error) {
		echo 	"<div class = 'spaceContent'>
						<p><b>Ваш заказ принят в обработку. Вы выбрали:</b></p>
					<div class = 'spaceOrder'>	
						<ul>
							<li>" . implode('</li><li>', $meals) . "</li>
						</ul>
					</div>
					<div class = 'spaceText'>	
						<p>Стоимость заказа равна {$sumCost} грн (UAH).</p>
						<p>{$delivery}</p>
						<p>Если хотите нам что-то написать, прошу пройти по <a href='/feedback'>ссылке</a>. Любым сообщениям/отзывам будем рады! :)</p>
						<p><a href='/'>На главную</a></p>
					</div>
				</div>";
	} else {
		echo 	"<div class = 'spaceContent'>
					<div class = 'spaceText'>	
						<p>{$error}</p>
						<p>Есть возможность сделать заказ по телефону: ХХХ ХХХ ХХ ХХ. Просто назовите названия блюд и свой адрес оператору (если хотите с доставкой). Вам скажут сумму к оплате и приблизительное время доставки. Просим прощения за предоставленные неудобства.</p>
						<p><a href='/'>На главную</a></p>
					</div>
				</div>";
	}
	?>
</div>
