function(e, v, m) {
	var name = $(m.e).attr('name');
	var $inputs = $('input[name="' + name + '"]');
	var m_id = $(m.e).attr('id');
	var e_id = $(e).attr('id');
	var input_i = 0;
	if(e_id.lastIndexOf('_F') > 0) {
		input_i = parseInt(e_id.substr(e_id.lastIndexOf('F') + 1, e_id.length));
	}
	var label_i = $inputs.length - 2;
	var $label = $('.MultiFile-label:eq(' + label_i + ')', $('#' + m_id + '_wrap_list'));

	if(e.files) {

		if(e.files.length > 1) {
			$('.MultiFile-title', $label).text(e.files.length + ' images');
		}

		$.each(e.files, function(index, value) {
			if(value) {

				if(value.size < 64 * 1024) {
					alert('The file "' + value.name + '" is too small. Its size cannot be smaller than ' + (64 * 1024) + ' bytes.');
					$('.MultiFile-remove', $label).trigger('click');
				}

				if(value.size > 2.5 * (1024 * 1024)) {
					alert('The file "' + value.name + '" is too large. Its size cannot exceed ' + (2.5 * (1024 * 1024)) + ' bytes.');
					$('.MultiFile-remove', $label).trigger('click');
				}

			}
		});

		var length = 0;
		$inputs.each(function() {
			length += $(this).get(0).files.length;
		});

		if(length >= 5) {
			setTimeout(function() {
				$('#' + m_id + '_F' + (input_i + 1)).attr('disabled', true);
			}, 0);
		}

		if(length > 5) {
			alert('Image(s) cannot accept more than 5 files.');
			$('.MultiFile-remove', $label).trigger('click');
			setTimeout(function() {
				$('#' + m_id + '_F' + (input_i + 1)).attr('disabled', false);
			}, 0);
		}

	}

}
