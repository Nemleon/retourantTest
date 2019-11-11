<?php list($dishes, $drinks, $jams) = $data; ?>
<div class = 'main'>
	<form method = "POST" action = "/order" name='form'>
		<div class = 'spaceText'><h1>ВАЖНО! Перед любыми действиями на сайте, обязательно ознакомьтесь с информацией во вкладке "О нас"! Всем добра и позитива!)</h1>
		<!--Если были допущены ошибки при отправке данных-->
			<?php if ($errors) { ?>
		    <div class = 'formErrors'>
				<p>Упс, прошу исправить ошибки!</p>
				<ul>
					<li> <?= implode('</li><li>', $errors); ?> </li>
				</ul>
			</div>
			<?php } ?>
			<h1>Меню</h1>
			
			<h3>В меню <em>НЕОБХОДИМО</em> выбрать хотя-бы одну сладость!</h3>
		</div>	
			<!--Часть с Вкусняхами-->
			
			<div class = 'formErrors' id='dish_error'></div>
			<div class = 'articles'><h2>Сладости *</h2></div>
			<div class = 'spaceMenu'>
				
				<?php $id = 1000; for ($t=0; $t < count($dishes); $t++) { $id += 1; ?>
				
				<div class = 'menu' id = 'div<?= $id ?>'>	
					<div class = 'checkbox'>
						<input data-rule="dishes" type="checkbox" name= "dishes[]" value= <?= $dishes[$t]["id"] ?> id= <?= $id ?> onchange = 'shadow("<?= $id ?>", "div<?= $id ?>")'>
					</div>	
					<div class = 'nameFood'>
						Название: <?= $dishes[$t]["name"] ?></b>
					</div>
					<div class = 'cost'>
						Стоимость: <?= $dishes[$t]["cost"] ?> (грн)
					</div>
					<div class = 'mass'>
						Масса: <?= $dishes[$t]["mass"] ?> (грамм)
					</div>
					<div class = 'label'>
						<label class = 'label' for= <?= $id ?>></label>
						<div class = 'image'>	
							<img src= <?= $dishes[$t]["url"] ?> width = '100%' height = '50%' alt = <?= $dishes[$t]["name"] ?> >
						</div>
					</div>
				</div>
				<?php } ?>
			</div>

			<!--Часть с Напитками-->
			
			<div class = 'articles'><h2>Напитки</h2></div>
					   
			<div class = 'spaceMenu'>	
					
				<?php $id = 2000; for ($t=0; $t < count($drinks); $t++) { $id += 1; ?>
					
				<div class = 'menu' id = 'div<?= $id ?>'>	
					<div class = 'checkbox'>
						<input data-rule="drinks" type="checkbox" name= "drinks[]" value= <?= $drinks[$t]["id"] ?> id= <?= $id ?> onchange = 'shadow("<?= $id ?>", "div<?= $id ?>")'>
					</div>	
					<div class = 'nameFood'>
						Название: <?= $drinks[$t]["name"] ?></b>
					</div>
					<div class = 'cost'>
						Стоимость: <?= $drinks[$t]["cost"] ?> (грн)
					</div>
					<div class = 'mass'>
						Масса: <?= $drinks[$t]["mass"] ?> (грамм)
					</div>
					<div class = 'label'>
						<label class = 'label' for= <?= $id ?>></label>
						<div class = 'image'>	
							<img src= <?= $drinks[$t]["url"] ?> width = '100%' height = '50%'>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>

			<!--Часть с Джемами-->

			<div class = 'articles'><h2>Джемы</h2></div>
			
			<div class = 'spaceMenu'>	
					
				<?php $id = 3000; for ($t=0; $t < count($jams); $t++) { $id += 1; ?>
					
				<div class = 'menu'  id = 'div<?= $id ?>'>	
					<div class = 'checkbox'>
						<input data-rule="jams" type="checkbox" name= "jams[]" value= <?= $jams[$t]["id"] ?> id= <?= $id ?> onchange = 'shadow("<?= $id ?>", "div<?= $id ?>")'>
					</div>	
					<div class = 'nameFood'>
						Название: <?= $jams[$t]["name"] ?></b>
					</div>
					<div class = 'cost'>
						Стоимость: <?= $jams[$t]["cost"] ?> (грн)
					</div>
					<div class = 'mass'>
						Масса: <?= $jams[$t]["mass"] ?> (грамм)
					</div>
					<div class = 'label'>
						<label class = 'label' for= <?= $id ?>></label>
						<div class = 'image'>	
							<img src= <?= $jams[$t]["url"] ?> width = '100%' height = '50%'>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			
			<!--Дополнительная информация-->
			<div class = 'articles'><h2>Введите дополнительную информацию. Звездочкой '*' отмечены обязательные поля</h2></div>
			<div class = 'spaceContent'>
					<p><b>Имя *</b></p>
					<div>
						<div id="firstName_error"></div>
						<input  type="text" data-rule="firstName" class = "textInput" name="firstName" id="firstName" placeholder="Алексей">
					</div>
					<p><b>Фамилия *</b></p>
					<div>
						<div id="secondName_error"></div>
						<input  type="text" data-rule="secondName" class = "textInput" name="secondName" id="secondName" placeholder="Удалько">
					</div>
					<p><b>Номер телефона *</b></p>
					<div>
						<div id="fNumber_error"></div>
						<input class = 'textInput' type="text" data-rule="number" id="number" name="number" placeholder="0995554144">
					</div>
						
					<!--Выбор формы доставки-->
					<div id='delv_error'></div>
					<p id='delvs'><b>Способ доставки *</b></p>
					<div class="deliverySpace">
						  <input data-rule="delivery" onClick="change_visibility ('r0', 'r1')"
						  type="radio" name="delivery" id="delv" value="yes">
						  <label for="delv">Доставка</label>
						  <div class = 'space'></div>
						  <input data-rule="delivery" onClick="change_visibility ('r1', 'r0')"
						  type="radio" name="delivery" id="self" value="no">
						  <label for="self">Самовывоз</label>
					</div>

					<!--Доставка на дом-->
					<div id="r1" style="display:none">
						<p><h4>Введите информацию, как показанно в примере</h4></p>
						<div><p>Название улицы *</p>
							<div id="street_error"></div>
							<input class = 'textInput' type="text" data-rule="street" id="street" name="street" placeholder="Колотушкина">
						</div>
						<div><p>Номер дома *</p>
							<div id="house_error"></div>
							<input class = 'textInput' type="text" data-rule="house" id="house" name="house" placeholder="13В">
						</div>
						<div><p>Номер квартиры *</p>
							<div id="apartmentError"></div>
							<input class = 'textInput' type="text" data-rule="apartment" id="apartment" name="apartment" placeholder="111">
						</div>	
						<div><p>Номер подъезда/парадной</p>
							<div id="entranceError"></div>
							<input class = 'textInput' type="text" data-rule="entrance" id="entrance" name="entrance" placeholder="5">
						</div>
					</div>

					<!--Самовывоз-->
					<div id="r0" style="display:none">
						<p>Выбран самовывоз</p>
					</div><br>
					<div class = 'positioningBut'>
						<input class = 'buttonSend' type="submit" name="send" disabled = 'true' value="Заказать">
						<div class = 'space'></div>
						<input class = 'buttonDelete' type="reset" value="Очистить">
					</div>
			</div>
	</form>
</div>
<script src="js/validation_menu.js"></script>
