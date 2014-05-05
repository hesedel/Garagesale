$(function() {

	window.alert = function(message) {
		$('.modal-body', '#alert').text(message);
		$('#alert').modal();
	}

	$('#menu-toggle').bind('touchend click', function() {

		// needed by Android < 4.3
		$(document).bind('click.menu', function() {
			$(this).unbind('click.menu');
			return false;
		});

		if(!$(this).hasClass('is-active')) {
			$(this).addClass('is-active');
			$('#menu').addClass('is-active');
			$('body')
				.addClass('is-animating')
				.addClass('is-menuActive');
			setTimeout(function() {
				$('body').removeClass('is-animating');

				// needed by Android < 4.3
				$('body').hide();
				setTimeout(function() {
					$('body').show();
				}, 0);

			}, 125);
		} else {
			$(this).removeClass('is-active');
			setTimeout(function() {
				$('#menu').removeClass('is-active');
			}, 125);
			$('body')
				.addClass('is-animating')
				.removeClass('is-menuActive');
			setTimeout(function() {
				$('body').removeClass('is-animating');
			}, 125);
		}
		return false;
	});

	$('#menu-x').bind( {
		touchstart: function(e) {
			$(this).data('x', e.originalEvent.touches[0].screenX);
		},
		touchmove: function(e) {
			var x = e.originalEvent.touches[0].screenX;
			var distance = $(this).data('x') - x;
			distance *= 2; // acceleration
			var percent = 1 - (distance / $(window).width());
			if(percent < 0) {
				percent = 0;
			}
			if(percent > 1) {
				percent = 1;
			}
			$('body, #menu-x, #menu-footer').css( {
				left: (75 * percent) + '%'
			});
			return false;
		},
		touchend: function(e) {
			var x = e.originalEvent.changedTouches[0].screenX;
			if(x === $(this).data('x')) {
				$('#menu-toggle').trigger('touchend');
			}	else {
				var percent = $(this).offset().left / $(window).width();
				$('body').addClass('is-animating');
				if(percent > 0.5) {
					$('body, #menu-x, #menu-footer').css( {
						left: '75%'
					});
					setTimeout(function() {
						$('body').removeClass('is-animating');
					}, 125);
				} else {
					$('body, #menu-x, #menu-footer').css( {
						left: '0'
					});
					setTimeout(function() {
						$('#menu-toggle').trigger('touchend');
					}, 125);
				}
				setTimeout(function() {
					$('body, #menu-x, #menu-footer').attr('style', '');
				}, 125);
			}
			return false;
		},
		click: function() {
			$('#menu-toggle').trigger('click');
		}
	});

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

	$('.a', '#filters').bind( {
		mouseover: function() {
			$(this).removeClass('is-inactive');
		},
		click: function() {
			if(!$(this).hasClass('is-active')) {
				$(this)
					.removeClass('is-inactive')
					.addClass('is-active');
				$('.filters', '#table').removeClass('is-hidden');
			} else {
				$(this)
					.removeClass('is-active')
					.addClass('is-inactive');
				$('.filters', '#table').addClass('is-hidden');
			}
		}
	});

	$('input[type=text]', '#search').bind( {
		focus: function() {
			$('.a:not(.is-active)', '#filters').trigger('click');
		},
		blur: function() {
			$('.a.is-active', '#filters').trigger('click');
		}
	});

	$('.hes-slider').hesSlider();
	$('time.timeago').timeago();

});

$(window).load(function() {

	setTimeout(function() {
		$('.alert-success.timeout').slideUp();
	}, 10000);

});
