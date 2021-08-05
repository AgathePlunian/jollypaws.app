errorMessages = {
  statutSexe : "Veuillez renseigner ce champ s'il vous plaît",
  firstName : "Veuillez renseigner votre prénom s'il vous plaît",
  lastName : "Veuillez renseigner votre nom s'il vous plaît",
  birthdate : "Veuillez renseigner votre date de naissance s'il vous plaît",
  birthdateInvalid : "Veuillez entrer une date de naissance valide",
  city : "Veuillez entrer une ville s'il vous plaît",
  phone : "Veuillez renseigner votre numéro de téléphone",
  email : "Veuillez renseigner votre e-mail",
  emailInvalid : "Cette adresse e-mail n'est pas valide",
  password : "Veuillez entrer un mot de passe",
  passwordConfirm : "Veuillez confirmer votre mot de passe",
  errorPasswords :" Veuillez entrer le même mot de passe",
  errorConditions : "Les conditions d'utilisation doivent être acceptées",
  NotANumber : "Ce champ doit être en chiffres",
  statutSexe : "Veuillez sélectionner une option"
}

//BOUTON MADAME MONSIEUR
window.onload = function(event) {
  let femme = document.getElementsByClassName("sexe-select")[0];
  let homme = document.getElementsByClassName("sexe-select")[1];
    
  femme.addEventListener("click", function() {  
    if (homme.classList.contains("checked")) {
      homme.classList.remove("checked");
    }

    if(!femme.classList.contains("checked")) {
      femme.classList.add("checked");
    }
   else {
     femme.classList.remove("checked")
   }
   let statutSexe = "Madame";
  
  });
   
   homme.addEventListener("click", function() {
    if (femme.classList.contains("checked")) {
      femme.classList.remove("checked");
    }
    if(!homme.classList.contains("checked")) {
    homme.classList.add("checked");
    }
    else {
      homme.classList.remove("checked")
    }
    let statutSexe = "Monsieur";
   
  });
}

//CHECHED MADAME OU MONSIEUR SELECTED
function checkStatut (madame, monsieur, message) {
  if ((!madame.classList.contains("checked")) && (!monsieur.classList.contains("checked"))) {
    setError(madame, message);
    return false;
    }
     else {
      removeError(madame);
      return true;
    } 
}

//SET ERROR 

function setError (el,  message){
  el.parentNode.classList.add("input-error-border");
  el.parentNode.nextElementSibling.textContent = message;
}

//REMOVE ERROR
function removeError (el){
  el.parentNode.classList.remove("input-error-border");
  el.parentNode.nextElementSibling.textContent = "";
}


//VALIDATION CONDITION D'UTILISATION

function isChecked (el, message) {
  if(!el.checked) {
    setError(el, message);
  }
  else {
    removeError(el)
  }
}

//IF NOT EMPTY

function notEmpty(el, message){
 if (el.value == "" || el.value == "null") {
  setError(el, message);
  return false;
  }
   else {
    removeError(el);
    return true;
  } 
}

//BIRTHDATE VALIDATION
function birthdateValidation (date, message) {
  if (birthdate.value == "") {
    setError(date, message);
    return false;
  }
  else {
    let birthdate = new Date(date.value);
  	let today = new Date();
		if (
			birthdate.getDate() >= today.getDate() &&
			birthdate.getMonth() == today.getMonth() &&
			birthdate.getFullYear() == today.getFullYear()
		) {
      setError(date, errorMessages.birthdateInvalid);
      return false;
    }
    else {
      removeError(date);
      return true;
    }
  }
}

//EMAIL VALIDATION

  function emailValidation(email, message) {
    if (email.value == "") {
      setError(email, message);
      return (false);
    }
    else {
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email.value))
    {
      removeError(email);
      return (true)
    }
    else {
      setError(email, errorMessages.emailInvalid);
      return (false)
      }
    }
   }

// TEL VALIDATION
function validationTel(el, errorArea, message) {
  if(el.value == "") {
    errorArea.textContent = message;
    el.parentNode.parentNode.classList.add("input-error-border"); 
    return false;
  }

  else {
    if(isNaN(el.value)) {
      el.parentNode.parentNode.classList.add("input-error-border"); 
      errorArea.textContent = errorMessages.NotANumber;
    }
    else {
    errorArea.textContent ="";
    el.parentNode.parentNode.classList.remove("input-error-border"); 
    return true;
    }
  }
}

//SAME PASSWORDS VALIDATION 
function validatePassword(password1 , password2) {
  if(password1.value!= "" && password2.value!="") {
   if (password1.value == password2.value) {
    removeError(password2);
    removeError(password1);
    return true;
  }
  else {
    setError(password1, errorMessages.errorPasswords);
    setError(password2, errorMessages.errorPasswords);
    return false;
    }
  }
}

//NAN
function isANumber (el, message) {
  if (el.value != "") {
    if(isNaN(el.value)) {
      setError(el, message);
      return false;
    }
    else {
      removeError(el);
      return true;
    }
  }
}
  

// VALIDATION FIRST PAGE
function validatePatient(event) {
  //DOM ELEMENTS

const firstName = document.getElementById("firstname");
const lastName = document.getElementById("lastname");
const birthdate = document.getElementById("birthdate");
const city = document.getElementById("city");
const tel = document.getElementById("phonetel")
const errorTel = document.getElementById("error-phone")
const email = document.getElementById("email");
const password1 = document.getElementById("password");
const password2 = document.getElementById("confirmPassword");
const madame = document.getElementsByClassName("sexe-select")[0];
const monsieur = document.getElementsByClassName("sexe-select")[1];
const checkbox = document.getElementById("conditions");

  event.preventDefault();
  notEmpty(lastName, errorMessages.lastName);
  notEmpty(firstName, errorMessages.firstName);
  birthdateValidation(birthdate, errorMessages.birthdate);
  notEmpty(city, errorMessages.city);
  emailValidation(email, errorMessages.email);
  validationTel(tel, errorTel, errorMessages.phone);
  notEmpty(password1, errorMessages.password);
  notEmpty(password2, errorMessages.passwordConfirm);
  validatePassword(password1 , password2);
  checkStatut(madame, monsieur, errorMessages.statutSexe);
  isChecked(checkbox, errorMessages.errorConditions);
 
}

