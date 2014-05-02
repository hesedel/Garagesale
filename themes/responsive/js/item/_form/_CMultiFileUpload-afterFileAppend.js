function(e, v, m) {
	var $inputs = $('input[name="' + $(m.e).attr('name') + '"]');
	var i = $inputs.length - 2;
	var $label = $('.MultiFile-label:eq(' + i + ')', $('#' + $(m.e).attr('id') + '_wrap_list'));

	if(e.files) {

		if(e.files.length > 1) {
			$('.MultiFile-title', $label).text(e.files.length + ' images');
		}

		var length = 0;
		$inputs.each(function() {
			length += $(this).get(0).files.length;
		});

		if(length >= 5) {
			$inputs.attr('disabled', true);
		}

		if(length > 5) {
			alert('You are only allowed to upload 5 images at a time.');
			$('.MultiFile-remove', $label).trigger('click');
			$inputs.attr('disabled', false);
		}

	}

}
