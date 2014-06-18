$(function() {

	window.alert = function(message) {
		$('.modal-body', '.Alert').text(message);
		$('.Alert').modal();
	};

	$('.XS-menu-toggle').bind('touchend click', function(e) {

		// needed by Android <= 4.3
		if(e.type === 'touchend') {
			$(document).bind('click.XS-menu', function() {
				$(this).unbind('click.XS-menu');
				return false;
			});
			setTimeout(function() {
				$(document).unbind('click.XS-menu');
			}, 500);
		}

		if(!$(this).hasClass('XS-menu-toggle--is-active')) {
			$(this).addClass('XS-menu-toggle--is-active');
			$('.XS-menu').addClass('XS-menu--is-active');
			$('body')
				.addClass('is-animating')
				.addClass('is-menuActive');
			setTimeout(function() {
				$('body').removeClass('is-animating');
			}, 125);
		} else {
			$(this).removeClass('XS-menu-toggle--is-active');
			setTimeout(function() {
				$('.XS-menu').removeClass('XS-menu--is-active');
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

	$('.XS-menu-x').bind( {
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
			$('.XS, .XS-menu-x, .XS-menu-footer').css( {
				left: (75 * percent) + '%'
			});
			return false;
		},
		touchend: function(e) {

			// needed by Android <= 4.1.2
			$(document).bind('click.XS-menu', function() {
				$(this).unbind('click.XS-menu');
				return false;
			});
			setTimeout(function() {
				$(document).unbind('click.XS-menu');
			}, 500);

			var x = e.originalEvent.changedTouches[0].screenX;
			if(x === $(this).data('x')) {
				$('.XS-menu-toggle').trigger('touchend');
			}	else {
				var percent = $(this).offset().left / $(window).width();
				$('body').addClass('is-animating');
				if(percent > 0.5) {
					$('.XS, .XS-menu-x, .XS-menu-footer').css( {
						left: '75%'
					});
					setTimeout(function() {
						$('body').removeClass('is-animating');
					}, 125);
				} else {
					$('.XS, .XS-menu-x, .XS-menu-footer').css( {
						left: '0'
					});
					setTimeout(function() {
						$('.XS-menu-toggle').trigger('touchend');
					}, 125);
				}
				setTimeout(function() {
					$('.XS, .XS-menu-x, .XS-menu-footer').attr('style', '');
				}, 125);
			}
			return false;
		},
		click: function() {
			$('.XS-menu-toggle').trigger('click');
		}
	});

	$('.Search-toggle').bind('touchend click', function(e) {

		// needed by Android <= 4.3
		if(e.type === 'touchend') {
			$(this).unbind('click');
		}

		if(!$(this).hasClass('Search-toggle--is-active')) {
			$(this).addClass('Search-toggle--is-active');
			$('.Search').addClass('Search--is-active');
		} else {
			$(this).removeClass('Search-toggle--is-active');
			$('.Search').removeClass('Search--is-active');
		}

		return false;
	});

	$('.User__div').data('hover', false);
	$('.User__a').bind( {
		touchstart: function() {
			if(!$('.User__div').data('hover')) {
				$('.User__div').data('hover', true);
				$('.User__ul').removeClass('hidden');
			} else {
				$('.User__div').data('hover', false);
				$('.User__ul').addClass('hidden');
				return false;
			}
		},
		touchend: function() {
			return false;
		},
		click: function() {
			return false;
		}
	});

	/*
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
	*/

	$('.hes-slider').hesSlider();
	$('time.timeago').timeago();

});

$(window).load(function() {

	setTimeout(function() {
		$('.Flash--timeout').slideUp();
	}, 10000);

});
