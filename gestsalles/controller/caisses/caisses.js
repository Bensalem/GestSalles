
function isInt(value){
   return !isNaN(parseInt(value * 1));
}

function getXMLHttpRequest() {
	var ajaxReq = null;
	if (window.XMLHttpRequest) {
		ajaxReq = new XMLHttpRequest();
	} else {
		ajaxReq = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return ajaxReq;
}

function updateTillContent(tillId) {
	var ajaxReq = getXMLHttpRequest();
	var tillContentField = document.getElementById('tillContentField');
	var newContent = document.getElementById('contentSetter').value;
	if (!isInt(newContent)) {
		return;
	}

	ajaxReq.onreadystatechange = function () {
		if (ajaxReq.readyState === 4 && ajaxReq.status === 200) {
			tillContentField.value = ajaxReq.responseText;
		}
	};
	var url = "../../model/caisses/ajax_update_till_content.php?id_caisse=" +
			tillId + "&new_content=" + newContent;

	ajaxReq.open("GET", url, true);
	ajaxReq.send(null);
}

function submitToChoixPaiementForm(sessionId, movieTitle, edition,
			beginHour, duration, room, price) {
	document.toChoixPaiementForm.sessionId.value = sessionId;
	document.toChoixPaiementForm.movieTitle.value = movieTitle;
	document.toChoixPaiementForm.edition.value = edition;
	document.toChoixPaiementForm.beginHour.value = beginHour;
	document.toChoixPaiementForm.duration.value = duration;
	document.toChoixPaiementForm.room.value = room;
	document.toChoixPaiementForm.price.value = price;
	document.toChoixPaiementForm.submit();
}

function submitToPaiementForm() {
	var i;
	for(i = 0; i <= 1; i++) {
		if (document.toPaiementForm.paiement[i].checked) {
			type_paiement = document.toPaiementForm.paiement[i].value;
		}
	}
	if(type_paiement == "carte") {
		document.toPaiementForm.action = "paiement_carte.php";
	}
	else {
		document.toPaiementForm.action = "paiement_especes.php";
	}
	document.toPaiementForm.submit();
}

function incrReservationNb(sessionId) {
	var ajaxReq = getXMLHttpRequest();
	var url = "../../model/caisses/ajax_incr_reservation_nb.php?id_seance=" +
			sessionId;
	ajaxReq.open("GET", url, true);
	ajaxReq.send(null);
	document.returnToEcranPrincipalForm.submit();
}

function printHowMuchToGiveBack(price) {
	var received = document.getElementById('received').value;
	var toGiveBack = document.getElementById('toGiveBack');
	toGiveBack.innerHTML = received - price;
}