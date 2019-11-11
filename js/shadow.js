function shadow(idCheck, idDiv) {
	check = document.getElementById(idCheck);
	div = document.getElementById(idDiv);
	if (check.checked) {
		div.classList.add('valid');
		div.style.background = "#93e5aa";
	} else { 
		div.classList.remove('valid');
		div.style.background = "white";
	}
}