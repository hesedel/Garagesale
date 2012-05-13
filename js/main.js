$('body').removeClass('no-js');
// IE7 fix
$('a', '.ie7').click(function() {
	$(this).blur();
});

setTimeout(function() {
	$('div.alert-success').slideUp();
}, 3000);
$('form').submit(function() {
	$(this).submit(function() {
		return false;
	});
	$('a.submit', this).addClass('disabled');
});
$('input').bind('keypress', function(e) {
	if(e.which == 13)
		$(this).parents('form').find('a.submit').click();
});
$('textarea')
	.css( {
		resize: 'none'
	})
	.TextAreaExpander(36, 216);
$('div.input-text, div.textarea').click(function() {
	$('input[type=text], input[type=password], textarea', $(this)).focus();
});
$('input[type=text], input[type=password], textarea', 'div.input-text, div.textarea').each(function() {
	$(this).bind('keydown keyup', function() {
		if($(this).val().length > 0) {
			$('span.placeholder', $(this).parent()).hide();
		} else {
			$('span.placeholder', $(this).parent()).show();
		}
	})
	.bind( {
		focus: function() {
			$(this).parent().addClass('focus');
		},
		blur: function() {
			$(this).parent().removeClass('focus');
		}
	})
	.keydown();
	$(':focus', $(this).parent()).focus();
});

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