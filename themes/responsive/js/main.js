$(function() {

$('.a > a', '#user').bind('touchend', function() {
	
	return false;
});

$('.a', '#filters').bind('click', function() {
	if(!$(this).hasClass('click')) {
		$(this).addClass('click');
		$('.filters', '#table').removeClass('hide');
	} else {
		$(this).removeClass('click');
		$('.filters', '#table').addClass('hide');
	}
});

});

$(window).load(function() {

setTimeout(function() {
	$('.alert-success.timeout').slideUp();
}, 10000);

});
