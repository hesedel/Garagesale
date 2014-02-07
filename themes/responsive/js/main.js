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
	if(!$(this).hasClass('is-clicked')) {
		$(this).addClass('is-clicked');
		$('.filters', '#table').removeClass('is-hidden');
	} else {
		$(this).removeClass('is-clicked');
		$('.filters', '#table').addClass('is-hidden');
	}
});

$('input[type=text]', '#search').bind( {
	focus: function() {
		$('.a:not(.is-clicked)', '#filters').trigger('click');
	},
	blur: function() {
		$('.a.is-clicked', '#filters').trigger('click');
	}
});

//$('time.timeago').timeago();

});

$(window).load(function() {

setTimeout(function() {
	$('.alert-success.timeout').slideUp();
}, 10000);

});
