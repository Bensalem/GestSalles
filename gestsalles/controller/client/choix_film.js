
function openpop(movieTitle, duration, edition, desc) { 
	win = window.open("", "newwin", "height=350, width=350, top=200, left=500");
	win.document.write("<html><head><title>Description du film</title></head>");
	win.document.write("<body><table><tr>" +
		"Titre : " + movieTitle +
		"<br>Durée : " + duration +
		"<br>Date de sortie : " + edition +
		"<p>Synopsis : " + desc + "</p>" +
		"</tr></table></body>"); 
	win.document.close();
	self.name = "main"; 
}