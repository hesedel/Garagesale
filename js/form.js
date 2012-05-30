$('form').submit(function() {
	$this = $(this);
	$this.bind('form.submit', function() {
		return false;
	});
	$('a.submit', this).addClass('disabled');
	/*
	var interval = setInterval(function() {
		if($('.error', $this).length > 0) {
			clearInterval(interval);
			$this.unbind('form.submit');
			$('a.submit', $this).removeClass('disabled');
		}
	}, 125);
	*/
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