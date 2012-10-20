	cinemaSelected = daySelected = false;
	maxTimeAtomsSpanned = 4;
	formIsDisplayed = false;
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

	function getColumnFirstCell(table, column)
	{
		var firstTr = getNthChild(document.getElementById("tbody"+table));
		var columnFirstCell = getNthChild(firstTr, column);
		return columnFirstCell;
	}

	function getColumnRoom(table, column)
	{
		var firstThead = getNthChild(document.getElementById("thead"+table));
		var roomCell = getNthChild(firstThead, column+1);
		return roomCell.innerHTML;
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
	 * column: the column of tdObj (without counting the first column
	 * i.e. the column of the hours)
	 */
	function restrictAreaTimeAvailability(tdObj, tdSpan, column)
	{
		var availableQuarters = 1;
		var td = tdObj;
		var realColumn;
		for (var i=1; i <= maxTimeAtomsSpanned; i++)
		{
			var tr = td.parentNode;
			tr = getPreviousSibling(tr);
			if (!tr) // We reached the top of the table
				break;
			realColumn = getRealColumn(tr, column);
			td = getNthChild(tr, realColumn);

			// Replacement of the last attribute (updating the number of
			// available quarters of hour from this td)
			setOnclickAvailableQuarters(td, availableQuarters);
			availableQuarters++;
		}
		td = tdObj;
		availableQuarters = 0;

		setOnclickAvailableQuarters(td, availableQuarters);
		for (var i=1; i < tdSpan; i++)
		{
			var tr = td.parentNode;
			tr = getNextSibling(tr); // does exist
			realColumn = getRealColumn(tr, column);
			td = getNthChild(tr, realColumn);

			// Sets to 0 the number of available quarters of hour
			// from this td, as there is already an implanted session
			// at this place
			setOnclickAvailableQuarters(td, availableQuarters);
		}
	}

	function getRealColumn(tr, col)
	{
		// There's one column more at tables' first row, that of the <th>
		// which spans over all the other rows
		return (getNthChild(tr).nodeName != "TH") ? col : col + 1;
	}

	function setOnclickAvailableQuarters(td, availableQuarters)
	{
		var onclickValue = td.getAttribute('onclick');
		onclickValue = onclickValue.slice(0, -2);
		onclickValue = onclickValue.concat(availableQuarters + ")");
		td.setAttribute('onclick', onclickValue);
	}

	/*
	 * Make a session div from a model and attach it to the grid
	 * tdSpan: number of TDs spanned by the session
	 */
	function implant(sessionBeginTd, tdSpan, column)
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
		restrictAreaTimeAvailability(sessionBeginTd, tdSpan, column);
	}


	/*
	 * Display a session div using the column's first cell as a model cell
	 * to determine the width, height and pos of the session div.
	 *
	 * column: the session's column
	 * beginTimePos: where the session div must begins; in pixels;
	 * relative to the column's first cell position.
	 * nbQuartersSpanned: number of the session spans over, as a cell
	 * represents a quarter of an hour.
	 */
	function setSessionPosAndDimensions(movieSession, table, column, beginTimePos, nbQuartersSpanned)
	{
		var paddingRight = 15, paddingHeight = 2;
		var modelCell = getColumnFirstCell(table, column);
		var modelCellPos = findPos(modelCell);
		var cellWidth = modelCell.offsetWidth - paddingRight;
		var cellHeight = modelCell.offsetHeight * nbQuartersSpanned - paddingHeight;

		movieSession.style.position = "absolute";
		movieSession.style.top = (modelCellPos[0] + beginTimePos) +'px';
		movieSession.style.left = modelCellPos[1] +'px';
		movieSession.style.width = cellWidth +'px';
		movieSession.style.height = cellHeight +'px';
	}

	/*
	 * tdOb: the <td> the user clicked
	 * column: the colum of tdObj
	 * firstHour and lastHour: first and last hour of the table; with
	 *  them we compute the availableQuarters and the position on the screen
	 *  corresponding to the beginning of the session (beginTimePos).
	 * hour: the hour corresponding to the td
	 * hourQuarter: the quarter of hour the td corresponds to.
	 * availableQuarters: number of rows a session can span over from tdObj
	 */
	function proposeSession(tdObj, column, table, firstHour, lastHour, hour, hourQuarter, availableQuarters)
	{
		if (availableQuarters <= 0 // to avoid overlapping of session DIVs
			|| formIsDisplayed == true) 
			return;

		var sessionModel = document.getElementById("movie-session-model");
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
		var beginTimePos = getBeginTimePos(table, firstHour, lastHour, hour, beginMinInPixels)

		setSessionPosAndDimensions(sessionModel, table, column + 1, beginTimePos, nbQuartersSpanned);

		/* We put an id to the td which corresponds to the beginning of the
			session so we can later get this td when we want to implant,
			move or remove the session div */
		var sessionBeginTdId = nextSessionBeginTdId();
		tdObj.setAttribute('id', sessionBeginTdId);

		sessionModel.setAttribute('ondblclick', 'displayMovieSessionForm("'+ sessionBeginTdId +'",'+ nbQuartersSpanned +','+ table +','+ column +')');
		sessionModel.style.visibility = "visible";

		var endMin = (beginMin + nbQuartersSpanned * 15) % 60;
		fillSessionDivContent(sessionModel, hour, beginMin, hour + 1, endMin);
	}


	function getBeginTimePos(table, firstHour, lastHour, hour, beginMinInPixels)
	{
		var hourHeight = 72;
		var intertableSpace = document.getElementById("first-cell").offsetHeight + 28;
		return (hour - firstHour) * hourHeight + beginMinInPixels;
	}

	function fillSessionDivContent(movieSession, hour, beginMin, endHour, endMin)
	{
		var beginTime = hour + ":" + ((beginMin <= 0) ? "0" + beginMin : beginMin);
		var endTime = endHour + ":" + ((endMin <= 0) ? "0" + endMin : endMin);
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

	function displayMovieSessionForm(sessionBeginTdId, tdSpan, table, column)
	{
		formIsDisplayed = true;
		var sessionFormDiv = document.getElementById("movie-session-form-div");
		var sessionModel = document.getElementById("movie-session-model");

		sessionFormDiv.style.display = "block"; // We make the form visible
		sessionFormDiv.style.top = (sessionModel.offsetTop - 25) + "px";

		var room = getColumnRoom(table, column);	/* ou directement à partir de l'id roomthX */
		room = room.substring(room.indexOf(' '));
		fillRoomSelecter(room);

		fillMovieSelecter();


/*

		document.getElementById("").innerHTML
		document.getElementById("sessionFormDate").innerHTML = ;
*/
		document.movieSessionForm.saveButton.setAttribute('onclick', 'sessionFormSubmit('+sessionBeginTdId+','+tdSpan+','+column+')');
	}

	/* la semaine, la date et l'heure; l'id du film, le cinéma, la salle
		doivent être mis en db; et décrémenter en db le nb de copies de
		ce film */

	function sessionFormSubmit(sessionBeginTd, tdSpan, column)
	{
		implant(sessionBeginTd, tdSpan, column);
		hideSessionForm();
	}

	function hideSessionForm()
	{
		document.getElementById("movie-session-form-div").style.display = "none";
		formIsDisplayed = false;
	}

	function sessionFormAbort()
	{
		hideSessionForm();
	}
/*
	function setDayDate()
	{
		
	}
*/

	function fillRoomSelecter(room)
	{
		var opt = document.movieSessionForm.roomSelecter.options[0];
		opt.value = room;
		opt.text = room;
	}

	function fillMovieSelecter()
	{

		selecter = document.getElementById('movie-selecter');
		while (selecter.firstChild)
			selecter.removeChild(selecter.firstChild);

		var ajaxReq;
		if (window.XMLHttpRequest)
		{
			ajaxReq = new XMLHttpRequest();
		}
		else
		{
			ajaxReq = new ActiveXObject("Microsoft.XMLHTTP");
		}

		ajaxReq.onreadystatechange = function()
		{
			if (ajaxReq.readyState == 4 && ajaxReq.status == 200)
			{
				selecter.innerHTML = ajaxReq.responseText;
			}
		}

		var cinema = document.getElementById('cinema').value;
		ajaxReq.open("GET", "../../model/programmation/ajax_cine_movies.php?cinema=" + cinema, true);
		ajaxReq.send(null);

	}

/************ Cinema and Day Selecters *************/

	function cinemaSelectHalfSubmit()
	{
		cinemaSelected = true;
		if (daySelected)
		{
			document.cineAndDaySelectForm.submit();
			cinemaSelected = false; // also set to false if the selected value is not a valid cinema
		}
	}

	function daySelectHalfSubmit()
	{
		daySelected = true;
		if (cinemaSelected)
		{
			document.cineAndDaySelectForm.submit();
			daySelected = false;
		}
	}

