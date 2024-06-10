$(document).ready(function(){

    //ANIMATION BURGER MENU
	let menuToggle = document.getElementById("toggle-menu");
	let burgerMenu = document.getElementById("burger-menu");

	burgerMenu.addEventListener('click' , function () {
		if(this.classList.contains("open")) {
			this.classList.remove("open");
			menuToggle.classList.add("display-none-menu");
		}
		else {
			this.classList.add("open");
			menuToggle.classList.remove("display-none-menu");
		}
	})

    //CAROUSEL

    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
           $('.main-nav-scroll').addClass('nav-bg');
        } else {
           $('.main-nav-scroll').removeClass('nav-bg');
        }
    });

  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:32,
    nav:true,
    dots: true,

    responsive:{
        0:{
            margin:24,
            stagePadding: 30,
            center: false,
            items:1
           
        },
        600:{
            stagePadding: 50,
            items:2
        },
        1000:{
            items:3
        }
    }
})
});