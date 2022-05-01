// nav-burger animation 
let burger = document.getElementById('js-burger');

let burgerAnimation = function () {
    let header = document.querySelector('.header');
    header.classList.toggle("header-phone");

    let burgerSpan = burger.children[0];
    burgerSpan.classList.toggle("burger-span");
};

burger.addEventListener('click', burgerAnimation);

