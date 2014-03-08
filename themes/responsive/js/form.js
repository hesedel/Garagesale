$(function() {

$('form').submit(function() {
	$(this).bind('form.submit', function() {
		return false;
	});
	$('a.submit', $(this)).addClass('is-disabled');
});

$('input').bind('keypress', function(e) {
	if(e.which == 13)
		$('a.submit', $(this).parents('form')).trigger('click');
});

$('textarea')
	.css( {
		resize: 'none'
	})
	.TextAreaExpander(36, 216);

$('div.input-text, div.textarea').bind('click', function() {
	$('input[type=text], input[type=password], textarea', $(this)).focus();
});

$('input[type=text], input[type=password], textarea', 'div.input-text, div.textarea').each(function() {
	$(this)
		.bind('keydown keyup', function() {
			if($(this).val().length > 0) {
				$('span.placeholder', $(this).parent()).addClass('is-hidden')
			} else {
				$('span.placeholder', $(this).parent()).removeClass('is-hidden');
			}
		})
		.bind( {
			focus: function() {
				$(this).parent().addClass('is-focused');
			},
			blur: function() {
				$(this).parent().removeClass('is-focused');
			}
		})
		.trigger('keydown');
	$(':focus', $(this).parent()).trigger('focus');
});

});
