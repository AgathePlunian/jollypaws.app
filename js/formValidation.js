window.onload = function() {
 
  var lastName = document.getElementById('last-name');
  var firstName = document.getElementById('first-name');
  var form  = document.getElementById('form-message');
  var email = document.getElementById('email');
  var situation = document.getElementById('situation');
  var message = document.getElementById('message');

  
  var errorMail = document.getElementsByClassName('error')[2];
  var errorLastName = document.getElementsByClassName('error')[0];
  var errorFirstName = document.getElementsByClassName('error')[1];
  var errorSituation = document.getElementsByClassName('error')[3];
  var errorMessage = document.getElementsByClassName('error')[4];

  var unvalidatedInput= document.getElementsByClassName('input')[2];
  


//PRESELECTED FOCUS LAST NAME
lastName.focus();
document.getElementsByClassName('input')[0].style.border = "1px solid #0093ad";



/////FOCUS 
//LAST NAME
lastName.addEventListener("focus", function(){
  document.getElementsByClassName('input')[0].style.border = "1px solid #0093ad";
});

lastName.addEventListener("blur", function(){
  document.getElementsByClassName('input')[0].style.border = "none";
});

//FIRST NAME
firstName.addEventListener("focus", function(){
  document.getElementsByClassName('input')[1].style.border = "1px solid #0093ad";
});

firstName.addEventListener("blur", function(){
  document.getElementsByClassName('input')[1].style.border = "none";
});

//EMAIL
email.addEventListener("focus", function(){
  document.getElementsByClassName('input')[2].style.border = "1px solid #0093ad";
});

email.addEventListener("blur", function(){
  document.getElementsByClassName('input')[2].style.border = "none";
});

//SELECT FOCUS

situation.addEventListener("focus", function(){
 situation.style.border = "1px solid #0093ad";
});

situation.addEventListener("blur", function(){
 situation.style.border = "none";
});

//MESSAGE FOCUS

message.addEventListener("focus", function(){
 message.style.border = "1px solid #0093ad";
 });
 
 message.addEventListener("blur", function(){
  message.style.border = "none";
 });


  //VALIDATION EMAIL

  email.onblur = function (){
     
  var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  
    if(email.value.match(mailformat)) {
      errorMail.innerHTML = " "
      email.style.background = "white";
     unvalidatedInput.style.background = "white";
    }
  
    else if (!email.value.match(mailformat) && (email.value != "")) {
    errorMail.innerHTML = "Adresse e-mail invalide "
    document.getElementsByClassName('input')[2].style.border = "1px solid #fc6500";
  }
}

//VALIDATION SELECT 

    situation.onchange = function() {
      if (situation.value != "null") { 
       situation.style.color = "#212121";
    }
    else {
      situation.style.color = "grey";
    }
  }

  //VALIDATION SUBMIT
 
  form.addEventListener("submit", function(event) {
  
    if (lastName.value == "") {
     event.preventDefault();
     if (document.documentElement.lang === "en") {
      errorLastName.innerHTML = "Please fill in your Last Name"
     }
     else {
      errorLastName.innerHTML = "Veuillez renseignez votre nom s'il vous plaît"
     }
      document.getElementsByClassName('input')[0].style.border = "1px solid #fc6500";
    }
   
    if (firstName.value == "") {
     event.preventDefault();

     if (document.documentElement.lang === "en") {
      errorFirstName.innerHTML = "Please fill in your First Name"
     }
      else {
      errorFirstName.innerHTML = "Veuillez renseignez votre prénom s'il vous plaît"
      }
     document.getElementsByClassName('input')[1].style.border = "1px solid #fc6500"; 
    }

    if (email.value == "") {
      event.preventDefault();
      if (document.documentElement.lang === "en") {
        errorMail.innerHTML = "Please fill in your e-mail address"
       }
      else {
      errorMail.innerHTML = "Veuillez renseignez votre e-mail s'il vous plaît"
      }
      document.getElementsByClassName('input')[2].style.border = "1px solid #fc6500"; 
    }

    if (situation.value == "null") {
      event.preventDefault();
      if (document.documentElement.lang === "en") {
        errorSituation.innerHTML = "Please select an option"
       }
      else {
        errorSituation.innerHTML = "Veuillez sélectionner une option s'il vous plaît"
      }
      document.getElementById('situation').style.border = "1px solid #fc6500"; 
    }

     if (message.value == "") {
      event.preventDefault();
      if (document.documentElement.lang === "en") {
        errorMessage.innerHTML = "Don't forget to leave a message :)"
       }
      else {
        errorMessage.innerHTML = "N'oubliez pas de laisser un message :)"
      }

      document.getElementById('message').style.border = "1px solid #fc6500"; 
     
     }

    else {
    return true;
    }

  });


  

}