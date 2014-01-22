$(function() {

$('.a', '#user').data('hover', false);
$('.a > a', '#user').bind( {
	touchstart: function() {
		if(!$(this).parent().data('hover')) {
			$(this).parent().data('hover', true);
			$('.dropdown-menu', $(this).parent()).removeClass('hidden');
		} else {
			$(this).parent().data('hover', false);
			$('.dropdown-menu', $(this).parent()).addClass('hidden');
			return false;
		}
	},
	touchend: function() {
		return false;
	}
});

$('.a', '#filters').bind('click', function() {
	if(!$(this).hasClass('click')) {
		$(this).addClass('click');
		$('.filters', '#table').removeClass('hidden');
	} else {
		$(this).removeClass('click');
		$('.filters', '#table').addClass('hidden');
	}
});

$('input[type=text]', '#search').bind( {
	focus: function() {
		$('.a:not(.click)', '#filters').trigger('click');
	},
	blur: function() {
		$('.a.click', '#filters').trigger('click');
	}
});

});

$(window).load(function() {

setTimeout(function() {
	$('.alert-success.timeout').slideUp();
}, 10000);

});
