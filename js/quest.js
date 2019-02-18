var countQ = 0;
var nbRep = 0;
var countC = 1;
var countR = 0;
var tabRepCheck = [[],[]];

var quizQ = 0;

$('.question:first').one( "submit", function(e) { 

                e.preventDefault();
                var has_empty = false;
                var countInput = 0;
                


                $(this).find( 'input[type!="hidden"]' ).each(function () {
                  countInput++;
                });

                for (var i = 0; i < countInput; i++) {
                   if ($(this).is('input[type="checkbox"]')) {
                    
                    console.log('is check ? '.$(this).checked);
                    
                    if ( ! $(this).checked ) { 
                        has_empty = true;
                    } else {
                       has_empty = false;
                        break;
                    }
                  } else if ($(this).is('input[type="text"]')) {
                    if ( ! $(this).val() ) { 
                        has_empty = true;
                    } else {
                       has_empty = false;
                        break;
                    }
                  }
                }
                  
                console.log('vide ? '+has_empty);

               if ( has_empty ) { 
                  $(this).append('<input type="hidden" name="vide" value="Non répondu" />');
               }

              $(this).submit();
               
            });

            

var nbQ = $("input[name='nbQ']").val();
var nbC = $("input[name='nbC']").val();


 var userType = $("input[name='userType']").val();

var questType = $("input[name='questType']").val();

 if (userType == 0) {
  for (var j = 0; j < nbC; j++) {
   document.getElementById('btnUpdateC'+j).addEventListener('click',updateC);
  }
}
console.log('userType : '+userType);
for (var i = 0; i < nbQ; i++) {
   if (userType == 0) {
    // document.getElementById('submitQ'+i).addEventListener('click',submit);
   document.getElementById('btnRepUp'+i).addEventListener('click',addRepUp);
   document.getElementById('btnRemoveRepUp'+i).addEventListener('click',removeLastRepUp);
    document.getElementById('btnUpdateQ'+i).addEventListener('click',updateQ);
    document.getElementById('btnDelete'+i).addEventListener('click',supp);
   } else {
    // document.getElementById('btnSubmit'+i).addEventListener('click',submit);
    if (questType == 1) {
      if (i != 0) {$('#Q'+i).hide()}
    }
   }
}



function supp() {
  var qId = $(this).attr('name');
  var questId = $(this).attr('value');
  var question = $(this).parents('div:first');

  var link = new URL(window.location.protocol + "//" + window.location.host +'/apprentis/questionnaire/Question/delete/'+qId);

  if (confirm("Etes-vous sûre de vouloir supprimer cette question ?")) {
   $.ajax({
      type: 'POST',
      url: link,
      data: 'questId=' + questId 
    })
    .done(function() {
      // Make sure that the formMessages div has the 'success' class.
      $(question).load("Question supprimée");
      console.log('delete send !');
    })
    .fail(function(data) {
      // Make sure that the messages div has the 'error' class.
    console.log('post fail !');
    }); 
  } 



}

function updateQ() {
  var question = $(this).parents('div:first');

  var span = question.parents('span:first');
  var form = span.find('.formUpdateQ');

    $(question).css("display", "none");
    $(form).css("display", "block");

}

function updateC() {
  var categorie = $(this).parents('article:first');
  var cat = $(this).parents('div:first');
  var form = categorie.find('.formUpdateC');
console.log(form);
    $(cat).css("display", "none");
    $(form).css("display", "block");

}

/*document.getElementsByClass('btnSubmit').addEventListener('click',submit);*/
function submit() {

  var form = $(this).parents('form:first');

  if (form.id != 'addQuest') {
    console.log(form);
  $(form).submit(function(e) {
   
    // Stop the browser from submitting the form.
    e.preventDefault();
    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData
    })
    .done(function() {
      // Make sure that the formMessages div has the 'success' class.
      $(form).find('.reponse').text('Réponse envoyée');
      $(form).find('.reponse').addClass('success');
      $(form).find('.btnSubmit').hide();
      
      if (questType == 1 && quizQ < nbQ) {
        /* $("#clock").load(location.href + " #clock");
         $("#timer").data('timer',3).TimeCircles(configTimer).rebuild().restart().addListener(configTimerListen);
         $("#timer").hide();
         $("#timer").show();*/
        $('#Q'+quizQ).hide();
      
        quizQ++;
        $('#Q'+quizQ).show();
      }
     console.log('post send !');
    })
    .fail(function(data) {
      // Make sure that the messages div has the 'error' class.
    console.log('post fail !');
    });

  });
}



}

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

  $("#btnQuestionUp").click(function(){

    var parent = document.getElementsByName("questQviewUp");
    

      for (var i = 0; i < countR; i++) {
        tabRepCheck[0].push(document.getElementsByName("R"+i)[0].value);
        tabRepCheck[1].push(document.getElementsByName("C"+i)[0].checked);
      }

      console.log("tabRepCheck : ");
      console.dir(tabRepCheck);


      
     
  });

  $("#btnUpdateQuest").click(function(){
    $('#questInfo').css("display", "none");
    $('#btnUpdateQuest').css("display", "none");
    $('#formUpdateQuest').css("display", "block");
  });

 $("#btnAddCat").click(function(){
    $('#selectCat2').css("display", "none");
    $('#btnAddCat').css("display", "none");
    $('#addCat').css("display", "block");
  });


  $(".checkRep").click(function(){
    if (this.value == 0) {
      this.value = 1;
    } else {
      this.value = 0;
    }
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

function addRepUp(nbQ) { 

  var pId =  "#questQviewUp"+nbQ;
  var nbRId =  "#nbR"+nbQ;
    
  var parentUp = $(pId);
  var nbR = parseInt($(nbRId).val());
  
  console.log(nbR);
  var r = document.createElement("input");
    r.type = "text";
  r.placeholder = "réponse n°"+(nbR+1);
  r.name = "R"+nbR;
  r.id = "idR"+nbR;
  r.classList.add('R'+nbR);
  

  var check = document.createElement("input");
    check.type = "checkbox";
    check.value = 1;
  check.name = "C"+nbR;
  check.classList.add('C'+nbR);

  var checkmark = document.createElement("span");
  checkmark.className='checkmark';

  var container = document.createElement("label");
  container.className='container';

  container.appendChild(check);
  container.appendChild(checkmark);

  var span = document.createElement("span");
  span.appendChild(r);
  span.appendChild(container);


  parentUp[0].appendChild(span);
  nbR++;
  $(nbRId).val(nbR);

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

function updateQuest() {

}

function removeLastRep() {
  var parent = document.getElementById("questQview");
  parent.removeChild(parent.lastChild);
  countR--;
}

function removeLastRepUp(nbQ) {
  var pId =  "#questQviewUp"+nbQ;
  var nbRId =  "#nbR"+nbQ;
  
  var nbR = parseInt($(nbRId).val());
  var parentUpRem = $(pId);
 
  parentUpRem[0].removeChild(parentUpRem[0].lastChild);
  nbR--;
  $(nbRId).val(nbR);
}