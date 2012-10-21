	cinemaSelected = daySelected = false;
	maxNbRoomsPerTable = 7;
	maxTimeAtomsSpannedAtFirst = 4;
	formIsDisplayed = false;
	aSessionHasBeenImplanted = false;
	sessionNum = 1;
	addSessionOperationStatus = 0;

/*********** Cinema and day selecters functions ************/

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

/*********** Table basic elements retrieval functions ************/

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

	function getColumnFirstCell(table, column)
	{
		var firstTr = getNthChild(document.getElementById("tbody" + table));
		var columnFirstCell = getNthChild(firstTr, column);
		return columnFirstCell;
	}

	function getColumnRoom(table, column)
	{
		var roomCellNum = column + (table - 1) * maxNbRoomsPerTable;
		var room = document.getElementById("room" + roomCellNum).innerHTML;
		room = room.substring(room.indexOf(' ') + 1);
		return room;
	}

/*********** Non-availabity of areas for movie session div/mark implantation ************/

	/*
	 * column: the column of tdObj (without counting the first column
	 * i.e. the column of the hours)
	 */
	function restrictAreaTimeAvailability(sessionBeginTdObj, tdSpan, column)
	{
		var availableQuarters = 1;
		var td = sessionBeginTdObj;
		var realColumn;
		for (var i=1; i <= maxTimeAtomsSpannedAtFirst; i++)
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
		td = sessionBeginTdObj;
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

/*********** Proposal of a Movie Session implantation position on grid ************/

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
	function proposeSession(tdObj, column, table, tableFirstHour, tableLastHour, hour, hourQuarter, availableQuarters)
	{
		if (availableQuarters <= 0 // to avoid overlapping of session DIVs
			|| formIsDisplayed == true) 
			return;

		var sessionModel = document.getElementById("movie-session-model");
		var beginMin, beginMinInPixels;

		switch (hourQuarter)
		{
			case 2:
				beginMin = 15;
				/* Il n'y a pas de séance ensuite mais il faut quand même
					limiter l'espace car il n'y a pas d'heure après */
				if ((hour == tableLastHour) && availableQuarters > 3)
					availableQuarters = 3;
				break;
			case 3:
				beginMin = 30;
				if ((hour == tableLastHour) && availableQuarters > 2)
					availableQuarters = 2;
				break;
			case 4:
				beginMin = 45;
				if ((hour == tableLastHour) && availableQuarters > 1)
					availableQuarters = 1;
				break;
			default:
				beginMin = 0;
		}
		var nbQuartersSpanned = availableQuarters;
		var endHour = getEndHour(hour, beginMin, nbQuartersSpanned);
		var endMin = getEndMin(beginMin, nbQuartersSpanned);

		setSessionPosAndDimensions(sessionModel, table, column, tableFirstHour, hour, endHour, beginMin, endMin);

		/* We put an id to the td which corresponds to the beginning of the
			session so we can later get this td when we want to implant,
			move or remove the session div (though it will be maybe useless) */
		var sessionBeginTdId = nextSessionBeginTdId();
		tdObj.setAttribute('id', sessionBeginTdId);

		fillSessionDivContent(sessionModel, hour, endHour, formatHour(beginMin), formatHour(endMin));

		sessionModel.setAttribute('ondblclick', 'displayMovieSessionForm("'+ sessionBeginTdId +'",'+ nbQuartersSpanned +','
							+ table +','+ column +','+tableFirstHour+','+tableLastHour+','+hour+','+beginMin+','+endHour+','+endMin+')');
		sessionModel.style.visibility = "visible";
	}


	/*
	 * Display a session div using the column's first cell as a model cell
	 * to determine the width, height and pos of the session div.
	 *
	 * column: the session's column
	 * beginTimePos: where the session div must begins; in pixels;
	 * relative to the column's first cell position.
	 * nbQuartersSpanned: number of TDs the session spans over, as a cell
	 *  represents a quarter of an hour.
	 */
	function setSessionPosAndDimensions(movieSession, table, column, tableFirstHour, beginHour, endHour, beginMin, endMin)
	{
		//tableFirstHour &tableLastHour: à mettre avec php dans un div spécial et le récup dedans
		var beginTimePos = getBeginTimePos(table, tableFirstHour, beginHour, beginMin);

		var modelCell = getColumnFirstCell(table, column + 1);
		var modelCellPos = findPos(modelCell);
		var paddingRight = 15, paddingHeight = 2;
		var sessionWidth = modelCell.offsetWidth - paddingRight;
		var sessionHeight = computeHeight(beginHour, endHour, beginMin, endMin) - paddingHeight;

		movieSession.style.position = "absolute";
		movieSession.style.top = (modelCellPos[0] + beginTimePos) +'px';
		movieSession.style.left = modelCellPos[1] +'px';
		movieSession.style.width = sessionWidth +'px';
		movieSession.style.height = sessionHeight +'px';
	}

	function getBeginTimePos(table, tableFirstHour, beginHour, beginMin)
	{
		var fiveMinsInPixels = 6;
		var hourHeight = fiveMinsInPixels * 12;
		var beginMinInPixels = (beginMin / 5) * fiveMinsInPixels;

		var intertableSpace = document.getElementById("first-cell").offsetHeight + 28;
		return (beginHour - tableFirstHour) * hourHeight + beginMinInPixels;
	}

	function computeHeight(beginHour, endHour, beginMin, endMin)
	{
		var fiveMinsInPixels = 6;
		var totalMins = (endHour - (beginHour + 1)) * 60 + (60 - beginMin) + endMin;
		return (totalMins / 5) * 6;
	}

	function fillSessionDivContent(movieSession, beginHour, endHour, beginMin, endMin)
	{
		var beginTime = beginHour + ":" + beginMin;
		var endTime = endHour + ":" + endMin;
		movieSession.innerHTML = "<span style=\"font-size: 10px; font-weight: bold;\">" + beginTime + " – " + endTime + "</span>";
	}

	function getEndHour(beginHour, beginMin, nbQuartersSpanned)
	{
		return Math.floor(((beginHour * 60) + beginMin + nbQuartersSpanned * 15) / 60);
	}

	function getEndMin(beginMin, nbQuartersSpanned)
	{
		return (beginMin + nbQuartersSpanned * 15) % 60;
	}

	function formatHour(mins)
	{
		return (mins < 10) ? "0" + mins : mins;
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
			// We want to keep the same id as before
			oldProposedTd = document.getElementById("td" + sessionNum);
			if (oldProposedTd)
				oldProposedTd.setAttribute('id', '');
		}
		return "td" + sessionNum;
	}

	function highlight(obj)
	{
		obj.style.backgroundColor = "#f6f6f5";
	}

	function unHighlight(obj)
	{
		obj.style.backgroundColor = "#ebeaeb";
	}

/*********** Movie Session Form functions ************/

	function displayMovieSessionForm(sessionBeginTdId, tdSpan, table, column, tableFirstHour, tableLastHour, beginHour, beginMin, endHour, endMin)
	{
		formIsDisplayed = true;
		var sessionFormDiv = document.getElementById("movie-session-form-div");
		var sessionModel = document.getElementById("movie-session-model");

		sessionFormDiv.style.display = "block"; // We make the form visible
		sessionFormDiv.style.top = (sessionModel.offsetTop - 25) + "px";

		var room = getColumnRoom(table, column);
		fillRoomSelecter(room);
		fillMovieSelecter();
		setTimeSlot(formatHour(beginHour), formatHour(endHour), formatHour(beginMin), formatHour(endMin));

		document.movieSessionForm.saveButton.setAttribute('onclick', 'sessionFormSubmit('+sessionBeginTdId+','+tdSpan+','+table+','+column+','+tableFirstHour+','+tableLastHour+')');
		document.movieSessionForm.resetButton.setAttribute('onclick', 'sessionFormReset('+beginHour+','+endHour+','+beginMin+','+endMin+')');
	}

	function sessionFormReset(beginHour, endHour, beginMin, endMin)
	{
		setTimeSlot(formatHour(beginHour), formatHour(endHour), formatHour(beginMin), formatHour(endMin));
	}

	function sessionFormAbort()
	{
		hideSessionForm();
	}

	function hideSessionForm()
	{
		document.getElementById("movie-session-form-div").style.display = "none";
		formIsDisplayed = false;
	}

	function setTimeSlot(beginHour, endHour, beginMin, endMin)
	{
		document.movieSessionForm.beginHour.value = beginHour;
		document.movieSessionForm.endHour.value = endHour;
		document.movieSessionForm.beginMin.value = beginMin;
		document.movieSessionForm.endMin.value = endMin;
	}

	function fillRoomSelecter(room)
	{
		var opt = document.movieSessionForm.roomSelecter.options[0];
		opt.value = room;
		opt.text = room;
	}


	function getXMLHttpRequest()
	{
		var ajaxReq = null;
		if (window.XMLHttpRequest)
		{
			ajaxReq = new XMLHttpRequest();
		}
		else
		{
			ajaxReq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		return ajaxReq;
	}

	function fillMovieSelecter()
	{
		var selecter = document.getElementById('movie-selecter');
		while (selecter.firstChild)
			selecter.removeChild(selecter.firstChild);

		var cinema = document.getElementById('cinema').value;

		var ajaxReq = getXMLHttpRequest();
		ajaxReq.onreadystatechange = function()
		{
			if (ajaxReq.readyState == 4 && ajaxReq.status == 200)
			{
				selecter.innerHTML = ajaxReq.responseText;
			}
		}
		ajaxReq.open("GET", "../../model/programmation/ajax_get_cine_movies.php?cinema=" + cinema, true);
		ajaxReq.send(null);
	}

	function addNewMovieSession(cinema, date, movie, room, beginTime, endTime)
	{
		var selecter = document.getElementById('movie-selecter');

		var ajaxReq = getXMLHttpRequest();

		var urlBase = "../../model/programmation/ajax_add_new_session.php?";
		var url = urlBase +"cinema="+ cinema +"&date="+ date +"&movie="+ movie
						+ "&room="+ room +"&begin="+ beginTime +"&end="+ endTime;

		// "false" i.e. synchronous because we don't want to continue executing
		// sessionFormSubmit()'s code if the session wasn't added in the db.
		ajaxReq.open("GET", url, false);
		ajaxReq.send(null);

		if (ajaxReq.readyState == 4 /*&& ajaxReq.status == 200*/)
		{
			return ajaxReq.responseText;
		}
	}

	/*
	 * Verify in the DB that the time slot is correct, i.e. whether there
	 * is no overlapping with an already existing session.
	 * If it is, then enter a new session in the DB with AJAX and display
	 * movie session info on the session div/mark on screen (and reajust
	 * its height if the time slot proposed at the beginning has been modified),
	 * and decrement the number of copies of this movie available in the
	 * communal stock.
	 */
	function sessionFormSubmit(sessionBeginTd, tdSpan, table, column, tableFirstHour, tableLastHour) // sessionBeginTd: pas besoin
	{
		hideSessionForm();

		var beginHour = parseInt(document.movieSessionForm.beginHour.value, 10);
		var endHour = parseInt(document.movieSessionForm.endHour.value, 10);
		var beginMin = parseInt(document.movieSessionForm.beginMin.value, 10);
		var endMin = parseInt(document.movieSessionForm.endMin.value, 10);

		if (! checkhInterval(beginHour, endHour, beginMin, endMin, tableFirstHour, tableLastHour+1))
		{
			alert("L'horaire n'est pas valide");
			return;
		}

		/* if(..funct si count = 0 return true) Here we must check in the db that there's no overlapping */

		/* We add the new session in the DB */
		var cinema = document.getElementById('cinema').value;
		var date = document.getElementById('date').value;
		var movie = getSelectValue('movie-selecter');
		var room = getSelectValue('room-selecter');

		var beginTime = toTimeFormat(beginHour, beginMin, 0);
		var endTime = toTimeFormat(endHour, endMin, 0);

		var status = addNewMovieSession(cinema, date, movie, room, beginTime, endTime);
		if (status == 1)
		{
			alert("A movie session is already spanning over this area");
			return;
		}
		
		/* Displaying of the new session on the screen */

		// We update the top and height style values of the session mark/model
		var sessionModel = document.getElementById("movie-session-model");

		// We update its content
		fillSessionDivContent(sessionModel, formatHour(beginHour), formatHour(endHour), formatHour(beginMin), formatHour(endMin));

		var sessionBeginTd = setSessionHeightAndTop(sessionModel, table, column,
						tableFirstHour, tableLastHour, beginHour, endHour, beginMin, endMin);

		var nbQuartersSpanned = Math.ceil(((endHour - (beginHour + 1)) * 60 + (60 - beginMin)) / 15)
								+ Math.ceil(endMin / 15);

		// We implant a clone of the session mark/model on the grid
		movieSession = implantSession(sessionBeginTd, nbQuartersSpanned, column);

		/* Ici la semaine, la date et l'heure; l'id du film, le cinéma, la salle
		doivent être mis en db; et décrémenter en db le nb de copies de
		ce film */

	}

	function checkhInterval(beginHour, endHour, beginMin, endMin, tableFirstHour, tableLastHour)
	{
		if (beginHour >= tableFirstHour && beginHour <= tableLastHour
			&& endHour >= tableFirstHour && endHour <= tableLastHour
			&& beginMin >= 0 && beginMin < 60 && endMin >= 0 && endMin < 60
			&& ((beginHour == endHour && beginMin < endMin) || beginHour < endHour))
			return true;
		else
			return false;
	}

	function getSelectValue(selectId)
	{
		var selectElem = document.getElementById(selectId);
		return selectElem.options[selectElem.selectedIndex].value;
	}

	function toTimeFormat(hour, mins, sec)
	{
		return formatHour(hour) + ":" + formatHour(mins) + ":" + formatHour(sec);
	}

/*********** Implantation of a Movie Session div/mark ************/

	/*
	 * Make a session div from a model and attach it to the grid
	 * this function is called when the session has been validated
	 * with the form.
	 * tdSpan: number of TDs spanned by the session
	 */
	function implantSession(sessionBeginTd, tdSpan, column)
	{
		var div = document.getElementById("movie-sessions");
		var model = document.getElementById("movie-session-model");
		newSession = cloneSessionDiv(model);
		div.appendChild(newSession);
		aSessionHasBeenImplanted = true;

		newSession.setAttribute('id', 'session' + sessionNum);
		/*newSession.setAttribute('onclick', ''); 						popup*/


		// Avoid overlapping of session divs
		restrictAreaTimeAvailability(sessionBeginTd, tdSpan, column);
		return newSession;
	}

	function cloneSessionDiv(model)
	{
		var newSessionDiv = document.createElement("DIV");
		newSessionDiv.className = model.className;
		/* à rajouter onmousedlbclk: appeler formulaire de modif (ou dans implantSession) et quand modif terminée, déshilighter */
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

	function setSessionHeightAndTop(movieSession, table, column, tableFirstHour, tableLastHour, beginHour, endHour, beginMin, endMin)
	{
		var beginTimePos = getBeginTimePos(table, tableFirstHour, beginHour, beginMin);
		var modelCell = getColumnFirstCell(table, column);
		var modelCellPos = findPos(modelCell);
		var paddingHeight = 2;

		var sessionHeight = computeHeight(beginHour, endHour, beginMin, endMin) - paddingHeight;

		movieSession.style.top = (modelCellPos[0] + beginTimePos) +'px';
		movieSession.style.height = sessionHeight +'px';

		var beginMinFromFirstHour = (beginHour * 60) + beginMin - (tableFirstHour * 60);
		// If the session doesn't start exactly at a quarter, we consider the quarter
		// (<=> td element) during which it starts as the td element of [start of] the
		// session - that's why we use ceil - so that we can make unavailable the TDs
		// from there and not from the one which precedes.
		var beginQuarterNum = Math.floor(beginMinFromFirstHour / 15);
		var beginSessionTd = getBeginSessionTd(table, column, beginQuarterNum);
		return beginSessionTd;
	}

	function getBeginSessionTd(table, col, beginQuarterNum)
	{
		var tr = document.getElementById("t"+ table +"-tr"+ beginQuarterNum);
		var column = getRealColumn(tr, col);
		return getNthChild(tr, column);
	}

