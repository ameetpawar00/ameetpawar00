function thebackground() {
$('.background img').css({opacity: 0.0});
$('.background img:first').css({opacity: 1.0});
setInterval('change()',5000);
}

function change() {
var current = ($('.background img.show')? $('.background img.show') : $('.background img:first'));
if ( current.length == 0 ) current = $('.background img:first');
var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('.background img:first') :current.next()) : $('.background img:first'));
next.css({opacity: 0.0})
.addClass('show')
.animate({opacity: 1.0}, 1000);
current.animate({opacity: 0.0}, 1000)
.removeClass('show');
};

$(document).ready(function() {
thebackground();	
$('.background').fadeIn(1000); // works for all the browsers other than IE
$('.background img').fadeIn(1000); // IE tweak
});
