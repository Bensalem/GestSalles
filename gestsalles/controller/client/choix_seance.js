
function openReservationPage() {
	if (document.toNextPageForm.sessionId.value != "") {
		document.toNextPageForm.submit();
	}
	else {
		alert("Vous devez choisir une séance");
	}
}

var selectedSessionRow = null;

// Change the background color of the row of the selected session
// and save the selected session info in a hidden form
function setPostData(tr, sessionId, movieTitle, duration,
			beginHour, date, price) {
	document.toNextPageForm.sessionId.value = sessionId;
	document.toNextPageForm.date.value = date;
	document.toNextPageForm.movieTitle.value = movieTitle;
	document.toNextPageForm.beginHour.value = beginHour;
	document.toNextPageForm.duration.value = duration;
	document.toNextPageForm.price.value = price;

	var nb_columns = 3;
	for (i = 0; i < nb_columns; i++) {
		tr.children[i].style.backgroundColor = "cyan";
	}
	if (selectedSessionRow != null && selectedSessionRow != tr) {
		for (i = 0; i < nb_columns; i++) {
			selectedSessionRow.children[i].style.backgroundColor = "white";
		}
	}
	selectedSessionRow = tr;
}
