
function updateCinemaNameSelected(selecter) {
    var selectedValue = selecter.options[selecter.selectedIndex].text;
	document.toNextPageForm.cinemaName.value = selectedValue;
    alert(selectedValue);
}
