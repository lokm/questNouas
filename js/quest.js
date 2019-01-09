var countQ = 0;
var nbRep = 0;
var countC = 1;
var countR = 0;
var tabRepCheck = [[],[]];

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

$(document).ready(function() {
$("#btnQuestion").click(function(){

	var parent = document.getElementsByName("questQview");
	

		for (var i = 0; i < countR; i++) {
			tabRepCheck[0].push(document.getElementsByName("R"+i)[0].value);
			tabRepCheck[1].push(document.getElementsByName("C"+i)[0].checked);
		}

    console.log("tabRepCheck : ");
    console.dir(tabRepCheck);


    $.ajax({
       url : window.location.protocol+"//"+window.location.hostname+"/questionnaire/Questionnaire/addQuestion", // La ressource ciblée
       type : 'POST', // Le type de la requête HTTP.
       data : {
       		questId : document.getElementsByName("questId")[0].value,
       		type : document.getElementsByName("type")[0].value,
       		question : document.getElementsByName("question")[0].value,
       		aide : document.getElementsByName("aide")[0].value,
       		tabRep : tabRepCheck
       }
    }).done(function() {
    tabRepCheck = [[],[]];
    console.log("post send !");
   /*window.location.replace(window.location.protocol+"//"+window.location.hostname+"/questionnaire/Questionnaire/addQuestion");*/
  });
   
});
});

function addRep() {	
	var parent = document.getElementById("questQview");
	
	var r = document.createElement("input");
  	r.type = "text";
	r.placeholder = "réponse n°"+(countR+1);
	r.name = "R"+countR;
	r.classList.add('R'+countR);
	
	var check = document.createElement("input");
  	check.type = "checkbox";
  	check.value = 1;
	check.name = "C"+countR;
	check.classList.add('C'+countR);	

	var span = document.createElement("span");
	span.appendChild(r);
	span.appendChild(check);
	span.appendChild(document.createElement("br"));

	parent.appendChild(span);
	countR++;
  document.getElementById("nbRep").value = countR;

}

function addQuest(option) {
	var parent = document.getElementById("questQview");
	countQ++;
	countR = 0;
  	var q = document.createElement("input");
  	var submit = document.createElement("submit");
  	//var save = document.createElement("button");
  	/*save.setAttribute("onclick","addToTab();");*/
  	//save.innerHTML = "sauvegarder";
  	q.type = "text";
  	switch (option) {

  		case 0:
		q.name = "Q"+countQ;
  		q.placeholder = (countQ)+"°. question simple";
  		break;
  		case 1:
  		q.name = "Q"+countQ;
  		q.placeholder = (countQ)+"°. question QCM";
  		break;

  	}
	parent.appendChild(document.createElement("hr"));
	parent.appendChild(document.createElement("br"));
	parent.appendChild(q);
	parent.appendChild(submit);
	parent.appendChild(document.createElement("br"));

	
	
}



function removeLastRep() {
	var parent = document.getElementById("questQview");
	parent.removeChild(parent.lastChild);
	countR--;
}