let inputs = document.querySelectorAll('input[data-rule]');
let button = document.getElementsByName('send').item(0);

for (let input of inputs) {
	
	input.addEventListener('keypress', validate);
	input.addEventListener('blur', validate);
	input.addEventListener('click', validate);

}

 function validate() {

	let rule = this.dataset.rule;
	let value = this.value;
	let check;
	
	entranceCheck = true;

	switch (rule) {
	
		case 'dishes':
		
			let dish_error = document.getElementById('dish_error');
			let dishes = document.getElementsByName('dishes[]');
			
			dishesCheck = false;
			
			for(var i=0; i<dishes.length;i++){
				if(dishes[i].checked == true){
					
					dish_error.textContent = null;
					dishesCheck = true;
				}
			}
			
			if (dishesCheck == false) {
				
				dish_error.textContent = 'Выберите хотя-бы одну сладость!';
				dishesCheck = false;
				
			}	
		break;
	
		case 'delivery':
		
			deliveryCheck = false;
			selfDelvCheck = false;
		
			let delivery = document.getElementsByName('delivery');
			
			if(delivery[0].checked == true) {
			
				selfDelvCheck = false;
				deliveryCheck = true;
				
			} else if (delivery[1].checked == true) {
				
				deliveryCheck = false;
				selfDelvCheck = true;
				
			}
			
			
			
		break;
		
		case 'firstName':
		
			firstNameCheck = false;
			firstNameCheck = /^[a-zA-Zа-яёА-ЯЁ\-]{3,25}$/.test(value);
			if (firstNameCheck){
				
				this.classList.remove('invalid');
				this.classList.add('valid');
				firstName_error.textContent = null;
				firstNameCheck = true;
				
			} else {
				
				this.classList.remove('valid');
				this.classList.add('invalid');
				firstName_error.textContent = 'Введите имя *';
				firstNameCheck = false;
				
			}
		
		break;
	
		case 'secondName':
		
			secondNameCheck = false;
			secondNameCheck = /^[a-zA-Zа-яёА-ЯЁ\-]{3,25}$/.test(value);
			if (secondNameCheck){
				
				secondName_error.textContent = null;
				this.classList.remove('invalid');
				this.classList.add('valid');
				secondNameCheck = true;
				
				
			} else {
				
				this.classList.remove('valid');
				this.classList.add('invalid');
				secondName_error.textContent = 'Введите фамилию *';
				secondNameCheck = false;
				
			}
			
		break;
	
		case 'number':
		
			numberCheck = false;
			numberCheck = /^(\+)?(\(\d{2,3}\) ?\d|\d)(([ \-]?\d)|( ?\(\d{2,3}\) ?)){5,12}\d$/.test(value);
			if (numberCheck){
		
				fNumber_error.textContent = null;
				this.classList.remove('invalid');
				this.classList.add('valid');
				numberCheck = true;
			
			
			} else {
		
				this.classList.remove('valid');
				this.classList.add('invalid');
				fNumber_error.textContent = 'Введен неправильный номер телефона';
				numberCheck = false;
		
			}
			
		break;

		case 'street':
		
			streetCheck = false;
			streetCheck = /^[a-zA-Zа-яёА-ЯЁ0-9]{2,25}$/.test(value);		
			if (streetCheck){
		
				street_error.textContent = null;
				this.classList.remove('invalid');
				this.classList.add('valid');
				streetCheck = true;
			
			
			} else {
		
				this.classList.remove('valid');
				this.classList.add('invalid');
				street_error.textContent = 'Введите название улицы';
				streetCheck = false;
		
			}
			
		break;

		case 'house':
		
			houseCheck = false;
			houseCheck = /^[a-zA-Zа-яёА-ЯЁ0-9]{1,3}$/.test(value);
			if (houseCheck){
		
				house_error.textContent = null;
				this.classList.remove('invalid');
				this.classList.add('valid');
				houseCheck = true;
			
			
			} else {
		
				this.classList.remove('valid');
				this.classList.add('invalid');
				house_error.textContent = 'Введите номер дома';	
				houseCheck = false;
		
			}
			
		break;

		case 'entrance':
			
			entranceCheck = false;
			entranceCheck = /^[0-9]{1,2}$|^$/.test(value);
			if (entranceCheck){
		
				this.classList.remove('invalid');
				this.classList.add('valid');
				entranceError.textContent = null;
				entranceCheck = true;
			
			
			} else {
				
				this.classList.remove('valid');
				this.classList.add('invalid');
				entranceError.textContent = 'Измените значение, как показано в примере, или уберите его';
				entranceCheck = false;
		
			}
		break;
		  
		case 'apartment':
		
			apartmentCheck = false;
			apartmentCheck = /^[0-9]{1,5}$/.test(value);
			if (apartmentCheck){

				this.classList.remove('invalid');
				this.classList.add('valid');
				apartmentError.textContent = null;
				apartmentCheck = true;
			
			
			} else {
				
				this.classList.remove('valid');
				this.classList.add('invalid');
				apartmentError.textContent = 'Введите номер квартиры';
				apartmentCheck = false;
				
			}
		break;
	}
	
	//Условие снятия разблокировки с submit
	try {
		if (dishesCheck 
			&& deliveryCheck
			&& !selfDelvCheck
			&& firstNameCheck
			&& secondNameCheck
			&& numberCheck
			&& streetCheck
			&& houseCheck
			&& entranceCheck
			&& apartmentCheck) {

			button.removeAttribute('disabled');
			
		} else if (dishesCheck 
			&& !deliveryCheck
			&& selfDelvCheck
			&& firstNameCheck
			&& secondNameCheck) {
			
			button.removeAttribute('disabled');
		
		} else {
			
			button.setAttribute('disabled', true);
			
		}
		
	} catch {	
	}
	
}				 