// nav-burger animation 
var burger = document.getElementById('js-burger');

var burgerAnimation = function() {
    var header = document.querySelector('.header');
    header.classList.toggle("header-phone");

    var burgerSpan = burger.children[0];
    burgerSpan.classList.toggle("burger-span");
}

burger.addEventListener('click', burgerAnimation);
