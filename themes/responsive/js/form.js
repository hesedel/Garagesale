$(function() {

$('input').bind('keypress', function(e) {
	if(e.which === 13) {
		$('a.submit', $(this).parents('form')).trigger('click');
	}
});

/*
$('textarea')
	.css( {
		resize: 'none'
	})
	.TextAreaExpander(36, 216);
*/

$('div.input-text, div.textarea').bind('click', function() {
	$('input[type=text], input[type=password], textarea', $(this)).trigger('focus');
});

$('input[type=text], input[type=password], textarea', 'div.input-text, div.textarea').each(function() {
	$(this)
		.bind('keydown keyup', function() {
			if($(this).val().length > 0) {
				$('span.placeholder', $(this).parent()).addClass('is-hidden');
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

$('form').bind('submit', function() {
	$(this).bind('submit.form', function() {
		return false;
	});
	$('a.submit', $(this)).addClass('is-disabled');
});

$('form.ajax').bind('submit', function() {
	var $this = $(this);

	var yiiactiveform = '';
	var re = new RegExp('jQuery\\(\'#' + $this.attr('id') + '\'\\)\.yiiactiveform\\([\\S|\\s]+\\);');
	$('script').each(function() {
		if($(this).html().length > 0 && (yiiactiveform = $(this).html().match(re))) {
			yiiactiveform = yiiactiveform[0];

			var i = 1;
			for(var j = yiiactiveform.indexOf('(', yiiactiveform.indexOf('(') + 1) + 1; j < yiiactiveform.length; j++) {
				if(yiiactiveform.charAt(j) === '(') {
					i++;
				} else if(yiiactiveform.charAt(j) === ')') {
					i--;
				}
				if(i === 0) {
					yiiactiveform = yiiactiveform.substring(0, j + 1) + ';';
					break;
				}
			}

		}
	});

	var events = [];
	var i = 0;
	events[i] = {};
	$.extend(true, events[i], $._data($this.get(0), 'events'));
	i++;
	$('*', $this).each(function() {
		events[i] = {};
		$.extend(true, events[i], $._data($(this).get(0), 'events'));
		i++;
	});

	$.post(window.location.pathname, $this.serialize() + '&ajax=' + $this.attr('id'), function(data) {
		alert('a');
		var id = $this.attr('id');
		$this.replaceWith(data);
		$this = $('#' + id);

		i = 0;
		$.each(events[i], function(eventType, e) {
			$.each(e, function(j, h) {
				$this.bind(eventType + (h.namespace ? '.' + h.namespace : ''), h.handler);
			});
		});
		$this.unbind('submit.form');
		i++;
		$('*', $this).each(function() {
			$.each(events[i], function(eventType, e) {
				$.each(e, function(j, h) {
					$('*:eq(' + (i - 1) + ')', $this).bind(eventType + (h.namespace ? '.' + h.namespace : ''), h.handler);
				});
			});
			i++;
		});

		eval(yiiactiveform);

		$('.error:eq(0)', $this).trigger('focus');

		$($('input[type=text], input[type=password], textarea', 'div.input-text, div.textarea'), $this).each(function() {
			$(this).trigger('keydown');
			$(':focus', $(this).parent()).trigger('focus');
		});

	});

	return false;
});

});
