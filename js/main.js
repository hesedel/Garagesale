$('body').removeClass('no-js');
// IE7 fix
$('a', '.ie7').click(function() {
	$(this).blur();
});

setTimeout(function() {
	$('.alert-success.timeout').slideUp();
}, 10000);

$('a', '#filters').click(function() {
	if(!$(this).hasClass('click')) {
		$(this).addClass('click');
		$('.filters', '#table').removeClass('hide');
		/*
		$('#filters-shadow')
		.css( {
			top: $('#filters').position().top - 1,
			left: $('#filters').position().left + 4,
			width: $('#filters').outerWidth() - 3,
			height: $('#filters').outerHeight() + 1
		})
		.removeClass('hide');
		$('#tr_filters-shadow')
		.css( {
			top: $('.tr.filters', '#table').position().top,
			left: $('.td.filters-left', '#table').position().left + 4,
			width: $('.td.filters-left', '#table').outerWidth() + $('.td.filters-right', '#table').outerWidth() - 4,
			height: $('.tr.filters', '#table').outerHeight() + 1
		})
		.removeClass('hide');
		*/
	} else {
		$(this).removeClass('click');
		$('.filters', '#table').addClass('hide');
		/*
		$('#filters-shadow').addClass('hide');
		$('#tr_filters-shadow').addClass('hide');
		*/
	}
	return false;
});