errorMessages = {
  lastName : "Veuillez renseigner votre nom s'il vous plaît",
  firstName : "Veuillez renseigner votre prénom s'il vous plaît",
  birthdate : "Veuillez renseigner votre date de naissance s'il vous plaît",
  birthdateInvalid : "Veuillez entrer une date de naissance valide",
  city : "Veuillez entrer une ville s'il vous plaît",
  profession : "Veuillez sélectionner une profession",
  statut : "Veuillez sélectionner un ou plusieurs statuts",
  speciality : "Veuillez sélectionner une ou plusieurs spécialités",
  rpps : "Veuillez renseigner votre numéro RPPS",
  finess : "Veuillez renseigner votre numéro FINESS",
  email : "Veuillez renseigner votre e-mail",
  emailInvalid : "Cette adresse e-mail n'est pas valide",
  phone : "Veuillez renseigner votre numéro de téléphone",
  password : "Veuillez entrer un mot de passe",
  passwordConfirm : "Veuillez confirmer votre mot de passe",
  errorPasswords :" Veuillez entrer le même mot de passe",
  idCard : "Veuillez choisir un document",
  NotANumber : "Ce champ doit être en chiffres"
}

function setError (el,  message){
  el.parentNode.classList.add("input-error-border");
  el.parentNode.nextElementSibling.textContent = message;
}

function removeError (el){
  el.parentNode.classList.remove("input-error-border");
  el.parentNode.nextElementSibling.textContent = "";
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
function validateFirst(event) {
  //DOM ELEMENTS
const firstName = document.getElementById("first-name");
const lastName = document.getElementById("last-name");
const birthdate = document.getElementById("birthdate");
const city = document.getElementById("city");

  event.preventDefault();
  notEmpty(lastName, errorMessages.lastName);
  notEmpty(firstName, errorMessages.firstName);
  birthdateValidation(birthdate, errorMessages.birthdate);
  notEmpty(city, errorMessages.city)
 
  if (notEmpty(lastName, errorMessages.lastName)&&
     notEmpty(firstName, errorMessages.firstName)&&
     birthdateValidation(birthdate, errorMessages.birthdate)&&
     notEmpty(city, errorMessages.city)){
      window.location.href= "praticien-first-connexion-2.html";
    } 
}

// VALIDATION SECOND PAGE

function validateSecond(event) {
  event.preventDefault();
  const profession = document.getElementById("profession");
  const statut = document.getElementById("statut");
  const speciality= document.getElementById("speciality");
  const rpps = document.getElementById("rpps");
  const finess = document.getElementById("finess");

  notEmpty(profession, errorMessages.profession);
  notEmpty(statut, errorMessages.statut);
  notEmpty(speciality, errorMessages.speciality);
  notEmpty(rpps, errorMessages.rpps);
  notEmpty(finess, errorMessages.finess);
  isANumber(rpps, errorMessages.NotANumber);
  isANumber(finess, errorMessages.NotANumber)

  if (notEmpty(profession, errorMessages.profession)&&
  notEmpty(statut, errorMessages.statut)&&
  notEmpty(speciality, errorMessages.speciality)&&
  notEmpty(rpps, errorMessages.rpps)&&
  notEmpty(finess, errorMessages.finess)){
      window.location.href= "praticien-first-connexion-3.html";
    } 
}

//VALIDATION THIRD PAGE 

function validateThird(event) {
  event.preventDefault();
  const email = document.getElementById("email");
  const idCard = document.getElementById("id-card");
  const phone = document.getElementById("phone");
  const phoneError = document.getElementById("phone-error");
  const showPw = document.getElementsByClassName("show-password");
  const hidePw = document.getElementsByClassName("hide-password");

  const password1 = document.getElementById("password");
  const password2 = document.getElementById("confirmPassword");

  emailValidation(email, errorMessages.email);
  notEmpty(idCard, errorMessages.idCard);
  validationTel(phone, phoneError, errorMessages.phone);
  notEmpty(password1, errorMessages.password);
  notEmpty(password2, errorMessages.passwordConfirm);
  validatePassword(password1, password2);

  if (
    emailValidation(email, errorMessages.email)&&
    notEmpty(idCard, errorMessages.idCard)&&
    validationTel(phone, phoneError, errorMessages.phone)&&
    notEmpty(password1, errorMessages.password)&&
    notEmpty(password2, errorMessages.passwordConfirm)&&
    validatePassword(password1, password2)
  ) {
    console.log("youhou")
  }

}
