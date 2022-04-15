var burger = document.getElementById('js-burger');

burger.addEventListener('click', function () {
    var header = document.querySelector('.header');
    header.classList.toggle("header-phone");
})
