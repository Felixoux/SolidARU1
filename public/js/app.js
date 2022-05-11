// Site animation
$('article.card .card--category').hover(function () {
    $(this).animate({
        left:150
    })
})
// pre-loader
$(document).ready(function () {
    $('#pre-loader').addClass('active')
});
$(window).on('load',function() {
    $('#pre-loader').fadeOut(0).removeClass('active');
});
// burger animation

$('#js-burger').click(function () {
    $('.header').toggleClass('is-open');
    $('#js-burger span').toggleClass('burger-span');
})

$(".withSpace").keyup(function(){
    let replaceSpace = $(this).val();
    let result = replaceSpace.replace(/#|_| |@|<|>/g, "-")
        .replace(/é|è|ê/g, "e")
        .replaceAll('?', "-")
        .replaceAll('!', "-");
    // update
    $(".withDash").val(result);
});

// theme switcher
$(document).ready(function () {
    $('#theme-switcher').click(function () {
        $('body').toggleClass("light-theme")
    })
})

// === STICKY HEADER ===
let didScroll;
let lastScrollTop = 0;
let delta = 5;
let navbarHeight = $('nav.header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('nav.header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('nav.header').removeClass('nav-up').addClass('nav-down');
        }
    }

    lastScrollTop = st;
}

// Markdown
/*var simplemde = new SimpleMDE({ element: document.querySelector(".markDownEditorArea") });
simplemde.value();

if($('.editor-toolbar').hasClass('disabled-for-preview')) {
    $('.editor-toolbar.disabled-for-preview a:not(.no-disable)').css('background', '#F00')
}*/




