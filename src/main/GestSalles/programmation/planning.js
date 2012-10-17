	maxTimeAtomsSpanned = 4;
	aSessionHasBeenImplanted = false;
	sessionNum = 1;

	function findPos(obj)
	{
		var top = left = 0;
		if (obj.offsetParent)
		{
			top = obj.offsetTop;
			left = obj.offsetLeft;

			while (obj = obj.offsetParent)
			{
				top += obj.offsetTop;
				left += obj.offsetLeft;
			}
		}
		return [top, left];
	}

	function getPreviousSibling(obj)
	{
		prev = obj.previousSibling;
		while (prev.nodeType != 1)
		{
			prev = prev.previousSibling;
			if (!prev)
				return null;
		}
		return prev;
	}

	function getNextSibling(obj)
	{
		do {
        	obj = obj.nextSibling;
    	} while (obj && obj.nodeType != 1);
		return obj;  
	}

	function getNthChild(parent, index)
	{
		index = index || 1;

		var child = (parent.firstChild && parent.firstChild.nodeType == 1) ?
						parent.firstChild :
						getNextSibling(parent.firstChild);
		for (var i=1; i < index; i++)
			child = getNextSibling(child);
		return child;
	}

	function highlight(obj)
	{
		obj.style.backgroundColor = "#f6f6f5";
	}

	function unHighlight(obj)
	{
		obj.style.backgroundColor = "#ebeaeb";
	}

	function getColumnFirstCell(column)
	{
		var firstTr = getNthChild(document.getElementById("tbodyId"));
		var columnFirstCell = getNthChild(firstTr, column);
		return columnFirstCell;
	}

	function cloneSessionDiv(model)
	{
		var newSessionDiv = document.createElement("DIV");
		newSessionDiv.className = model.className;
		/* à rajouter onmousedlbclk: appeler popup de modif et quand modif terminée, déshilighter */
		newSessionDiv.setAttribute('onmouseover', 'highlight(this)');
		newSessionDiv.setAttribute('onmouseout', 'unHighlight(this)');
		newSessionDiv.innerHTML = model.innerHTML;
		newSessionDiv.style.position = model.style.position;
		newSessionDiv.style.top = model.style.top;
		newSessionDiv.style.left = model.style.left;
		newSessionDiv.style.width = model.style.width;
		newSessionDiv.style.height = model.style.height;
		return newSessionDiv;
	}

	/*
	 * day: from it we know the column of tdObj
	 */
	function restrictAreaTimeAvailability(tdObj, tdSpan, day)
	{
		var availableQuarters = 1;
		var td = tdObj;
		var column;
		for (var i=1; i <= maxTimeAtomsSpanned; i++)
		{
			var tr = td.parentNode;
			tr = getPreviousSibling(tr);
			if (!tr)
				break;
			column = (getNthChild(tr).nodeName != "TH") ? day : day + 1;
			td = getNthChild(tr, column);

			/* Replacement of the last attribute (updating the number of
			   available quarters of hour from this td) */
			var onclickValue = td.getAttribute('onclick');
			onclickValue = onclickValue.slice(0, -2);
			onclickValue = onclickValue.concat(availableQuarters + ")");
			td.setAttribute('onclick', onclickValue);

			availableQuarters++;
		}

		td = tdObj;
		availableQuarters = 0;
/*alert(td.getAttribute('onclick'));*/

		var onclickValue = td.getAttribute('onclick');
		onclickValue = onclickValue.slice(0, -2);
		onclickValue = onclickValue.concat(availableQuarters + ")");
		td.setAttribute('onclick', onclickValue);
		for (var i=1; i < tdSpan; i++)
		{
			var tr = td.parentNode;
			tr = getNextSibling(tr); // does exist
			column = (getNthChild(tr).nodeName != "TH") ? day : day + 1;
			td = getNthChild(tr, column);

			/* Sets to 0 the number of available quarters of hour
				from this td, as there is already an implanted session
				at this place */
			onclickValue = td.getAttribute('onclick');
			onclickValue = onclickValue.slice(0, -2);
			onclickValue = onclickValue.concat(availableQuarters + ")");
			td.setAttribute('onclick', onclickValue);
		}
	}

	/*
	 * Make a session div from a model and attach it to the grid
	 * tdSpan: number of TDs spanned by the session
	 */
	function implant(sessionBeginTd, tdSpan, day)
	{
		/* If the session has been validated with the form by pressing submit */
		var div = document.getElementById("movie-sessions");
		var model = document.getElementById("movie-session-model");
		newSession = cloneSessionDiv(model);
		div.appendChild(newSession);
		aSessionHasBeenImplanted = true;

		newSession.setAttribute('id', 'session' + sessionNum);
		/*newSession.setAttribute('onclick', ''); 						popup*/



		/* Avoid overlapping of session divs */
		restrictAreaTimeAvailability(sessionBeginTd, tdSpan, day);
	}


	function displayMovieSessionForm(sessionBeginTdId, tdSpan, day)
	{
		var sessionFormDiv = document.getElementById("movie-session-form-div");
		var sessionModel = document.getElementById("movie-session-model");
		sessionFormDiv.style.display = "block"; // We make the form visible
		sessionFormDiv.style.top = (sessionModel.offsetTop - 25) + "px";

		document.movieSessionForm.saveButton.setAttribute('onclick', 'sessionFormSubmit('+sessionBeginTdId+','+tdSpan+','+day+')');
	}

	/*
	 * Print a session div using the column's first cell as a model cell
	 * to determine the width, height and pos of the session div.
	 *
	 * column: the session's column
	 * beginTimePos: where the session div must begins; in pixels;
	 * relative to the column's first cell position.
	 * nbQuartersSpanned: number of the session spans over, as a cell
	 * represents a quarter of an hour.
	 */
	function setSessionPosAndDimensions(movieSession, column, beginTimePos, nbQuartersSpanned)
	{
		var paddingRight = 15, paddingHeight = 2;
		var modelCell = getColumnFirstCell(column);
		var modelCellPos = findPos(modelCell);
		var cellWidth = modelCell.offsetWidth - paddingRight;
		var cellHeight = modelCell.offsetHeight * nbQuartersSpanned - paddingHeight;

		movieSession.style.position = "absolute";
		movieSession.style.top = (modelCellPos[0] + beginTimePos) +'px';
		movieSession.style.left = modelCellPos[1] +'px';
		movieSession.style.width = cellWidth +'px';
		movieSession.style.height = cellHeight +'px';
	}

	function proposeSession(tdObj, day, firstHour, lastHour, hour, hourQuarter, availableQuarters)
	{
		if (availableQuarters <= 0) 
			return;
		var sessionModel = document.getElementById("movie-session-model");
		var hourHeight = 72;
		var quarterHeight = 18;
		var beginMin, beginMinInPixels;

		switch (hourQuarter)
		{
			case 2:
				beginMin = 15;
				beginMinInPixels = quarterHeight;
				/* Il n'y a pas de séance ensuite mais il faut quand même
					limiter l'espace car il n'y a pas d'heure après */
				if ((hour == lastHour) && availableQuarters > 3)
					availableQuarters = 3;
				break;
			case 3:
				beginMin = 30;
				beginMinInPixels = quarterHeight * 2;
				if ((hour == lastHour) && availableQuarters > 2)
					availableQuarters = 2;
				break;
			case 4:
				beginMin = 45;
				beginMinInPixels = quarterHeight * 3;
				if ((hour == lastHour) && availableQuarters > 1)
					availableQuarters = 1;
				break;
			default:
				beginMin = 0;
				beginMinInPixels = 0;
		}
		var nbQuartersSpanned = availableQuarters;
		var beginTimePos = (hour - firstHour) * hourHeight + beginMinInPixels;

		setSessionPosAndDimensions(sessionModel, day + 1, beginTimePos, nbQuartersSpanned);

		/* We put an id to the td which corresponds to the beginning
			of the session so we can later get this td when we want
			to implant, move or	remove the session div */
		var sessionBeginTdId = nextSessionBeginTdId();
		tdObj.setAttribute('id', sessionBeginTdId);

		sessionModel.setAttribute('ondblclick', 'displayMovieSessionForm("'+ sessionBeginTdId +'",'+ nbQuartersSpanned +','+ day +')');
		sessionModel.style.visibility = "visible";

		var endMin = (beginMin + nbQuartersSpanned * 15) % 60;
		fillSessionDivContent(sessionModel, hour, beginMin, hour + 1, endMin);
		/*alert(document.getElementById(dayId).innerHTML);*/
	}

	function fillSessionDivContent(movieSession, hour, beginMin, endHour, endMin)
	{
		var beginTime = hour + ":" + ((beginMin == 0) ? "00" : beginMin);
		var endTime = endHour + ":" + ((endMin == 0) ? "00" : endMin);
		movieSession.innerHTML = "<span style=\"font-size: 10px; font-weight: bold;\">" + beginTime + " – " + endTime + "</span>";
	}

	function nextSessionBeginTdId()
	{
		if (aSessionHasBeenImplanted)
		{
			aSessionHasBeenImplanted = false;
			sessionNum++;
		}
		else
		{
			/* We want to keep the same id as before */
			oldProposedTd = document.getElementById("td" + sessionNum);
			if (oldProposedTd)
				oldProposedTd.setAttribute('id', '');
		}
		return "td" + sessionNum;
	}

/***** Movie Session Form Functions ******/

	/* la semaine, la date et l'heure; l'id du film, le cinéma, la salle
		doivent être mis en db; et décrémenter en db le nb de copies de
		ce film */

	function sessionFormSubmit(sessionBeginTd, tdSpan, day)
	{

		implant(sessionBeginTd, tdSpan, day);
	}
/*
	function sessionFormSubmit()
	{
		var form = document.forms["testforms"];
		var id_sujet = form.id_sujet.value;
		var categorie = form.categorie.value;
		var pseudo = form.pseudo.value;
		var com = form.com.value;
		var url = "traitement_com.php?id_sujet="+id_sujet+"&categorie="+categorie+"&pseudo="+pseudo+"&com="+com;
		alert(AJAX(url));
	}
*/
/*
function reset()
{
	for (var i=1; i < elems.length - 3; i++)
		document.movieSessionForm.elements[i].value="";
}*/

	function sessionFormAbort() {
		document.getElementById("movie-session-form-div").style.display = "none";
	}

