const showPw = document.getElementsByClassName("show-password");
const hidePw = document.getElementsByClassName("hide-password");

const passwordInput = document.getElementsByClassName("password");
// SHOW PASSWORD
for (let i = 0; i < hidePw.length ; i ++) {
  let el = hidePw[i];
    el.addEventListener("click", function() {
    if(passwordInput.type = "password") {
      el.style.display = "none";
      el.nextElementSibling.style.display = "block";
      passwordInput[i].type = "text";
    }
});
}
  
for (let i = 0; i < showPw.length ; i ++) {
  let el = showPw[i];
 if(passwordInput.type= "text") {
    el.addEventListener("click", function() {
      el.style.display = "none";
      el.previousElementSibling.style.display = "block";
      passwordInput[i].type = "password";   
    });
  }
 }
