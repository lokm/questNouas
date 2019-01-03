var countQ = 0;
var nbRep = 0;
var countR = 0;
var countC = 1;
var tabQuest = [[],[],[]];

function addRep() {
	var parent = document.getElementById("questQview");
	
	var r = document.createElement("input");
  	r.type = "text";
	r.placeholder = "réponse n°"+(countR+1);
	r.name = "quest-Q"+countQ+"-R"+countR;
	
	var check = document.createElement("input");
  	check.type = "checkbox";
	check.name = "quest-Q"+countQ+"-R"+countR+"-C"+countR;

	var span = document.createElement("span");
	span.classList.add('reponseQ'+countQ);
	span.appendChild(r);
	span.appendChild(check);
	span.appendChild(document.createElement("br"));

	parent.appendChild(span);
	countR++;
}

function addQuest(option) {
	var parent = document.getElementById("questQview");

	if (parent.childNodes[countC]) {
		tabQuest[countQ] = parent.childNodes[countC].value;
		//console.log("tabQuest de "+countQ+" : "+tabQuest[countQ]);
		countC = countC + 4;
		nbRep = parent.getElementsByClassName("reponseQ"+countQ).length;
		Reps = parent.getElementsByClassName("reponseQ"+countQ);	
		for (var i = 0; i < nbRep; i++) {
			tabQuest[countQ][i] = parent.querySelector("input[name='quest-Q"+countQ+"-R"+i+"']").value;
			console.log(parent.querySelector("input[name='quest-Q"+countQ+"-R"+i+"']").value);
			console.log("tabQuest["+countQ+"]["+i+"] : "+tabQuest[countQ][i]);
		}
    }
	/*if (parent.childNodes[countC]) {
		tabQuest.push(parent.childNodes[countC].value);
		
		console.log(tabQuest[countC]);
		var listNode = parent.querySelector("span").childElementCount;
		console.log("listNode : "+listNode);
		tabQuest[countQ] = new Array(listNode);
		for (var i = 0; i < listNode; i++) {
			tabQuest[countQ][i] = parent.querySelector("span:nth-child("+i+")").firstChild.value;
		}
		countC = countC + 4;
	}*/
	countQ++;
	countR = 0;
  	var q = document.createElement("input");
  	q.type = "text";
  	switch (option) {
  		case 0:
		q.name = "quest-Q"+countQ;
  		q.placeholder = (countQ)+"°. question simple";
  		break;
  		case 1:
  		q.name = "qcm-Q"+countQ;
  		q.placeholder = (countQ)+"°. question QCM";
  		break;
  	}
	parent.appendChild(document.createElement("hr"));
	parent.appendChild(q);
	parent.appendChild(document.createElement("br"));
	
}

function removeLastRep() {
	var parent = document.getElementById("questQview");
	parent.removeChild(parent.lastChild);
	countR--;
}