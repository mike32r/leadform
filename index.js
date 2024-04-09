var resultWrapper = document.querySelector('.spin-result-wrapper');
var wheel = document.querySelector('.wheel-img');

function spin() {
    if (wheel.classList.contains('rotated')) {
        resultWrapper.style.display = "block";
    } else {
        wheel.classList.add('spin');
        setTimeout(function() {
            resultWrapper.style.display = "block";
        }, 8000);
        setTimeout(function() {
            $('.spin-wrapper').slideUp();
            $('.order_block').slideDown();
            $('.order_block').css('display', 'flex');
            start_timer();
        }, 10000);
        wheel.classList.add('rotated');
    }
}
var closePopup = document.querySelector('.close-popup');
$('.close-popup, .pop-up-button').click(function(e) {
    e.preventDefault();
    $('.spin-result-wrapper').fadeOut();
})
var time = 600;
var intr;

function start_timer() {
    intr = setInterval(tick, 1000);
}

function tick() {
    time = time - 1;
    var mins = Math.floor(time / 60);
    var secs = time - mins * 60;
    if (mins == 0 && secs == 0) {
        clearInterval(intr);
    }
    secs = secs >= 10 ? secs : "0" + secs;
    $(".timer").html("0" + mins + ':' + secs);
}
$("a").not('.footer_links a').on("click", function(event) {
    event.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#order0").offset().top - 100
    }, 500);
})
$(document).ready(function() {
    $('.wheel-cursor').on('click', function() {
        spin();
    });
    $(".scroll").on("click", function (event) {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#form").offset().top
        }, 500);
    })
});