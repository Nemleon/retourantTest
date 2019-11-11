function visibility (block) {
	if (document.getElementById(block).style.display == 'none' || document.getElementById(block).style.display == '') {
		document.getElementById(block).style.display='flex';
	} else {
		document.getElementById(block).style.display='none';
	}
}