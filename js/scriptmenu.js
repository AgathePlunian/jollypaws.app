var menu = document.getElementById('full-screen');
var open = document.getElementById('burger-open');
var close = document.getElementById('close-menu');

open.addEventListener("click" ,function() {
  menu.classList.add('active');
});
    
close.addEventListener ( "click" ,function() {
  menu.classList.remove("active");
});
   