$(function() {

	$('i', '#menu-toggle').bind('click', function() {
		if(!$(this).parents('#menu-toggle').hasClass('is-active')) {
			$(this).parents('#menu-toggle').addClass('is-active');
			$('#menu').addClass('is-active');
			$('body').addClass('is-animating');
			setTimeout(function() {
				$('body').removeClass('is-animating');
			}, 125);
			$('html, body').addClass('is-menu');
		} else {
			$(this).parents('#menu-toggle').removeClass('is-active');
			setTimeout(function() {
				$('#menu').removeClass('is-active');
			}, 125);
			$('body').addClass('is-animating');
			setTimeout(function() {
				$('body').removeClass('is-animating');
			}, 125);
			$('html, body').removeClass('is-menu');
		}
	});

	$('.x', '#menu').bind('click', function() {
		$('i', '#menu-toggle').trigger('click');
	});

	/*
	$(window).bind('touchend', function() {
		if($('html').hasClass('is-menu')) {
			if($(window).scrollLeft() > $(window).width() * .25) {
				$('html, body').animate( {
					scrollLeft:  $(window).width() * .75
				}, 125, function() {
					$('body')
						.css( {
							left: 0
						})
						.removeClass('is-menu')
						.attr('style', '');
					//$('i', '#menu-toggle').trigger('click');
				});
			} else {
				$('html, body').animate( {
					scrollLeft: 0
				}, 125);
			}
		}
	});
	*/

	$('#is-menu-before').bind( {
		click: function() {
			$('i', '#menu-toggle').trigger('click');
		},
		touchstart: function(e) {
			$(this).data('x', e.originalEvent.touches[0].screenX);
		},
		touchmove: function(e) {
			e.preventDefault();
			var x = e.originalEvent.touches[0].screenX;
			var percent = 1 - (($(this).data('x') - x) / $(window).width());
			$('body, #is-menu-before, #is-menu-after').css( {
				left: (75 * percent) + '%'
			});
		},
		touchend: function(e) {
			$('body').addClass('is-animating');
			setTimeout(function() {
				$('body').removeClass('is-animating');
			}, 125);
			var percent = $(this).offset().left / $(window).width()
			if(percent > .5) {
				$('body, #is-menu-before, #is-menu-after').css( {
					left: '75%'
				});
				setTimeout(function() {
					$('body, #is-menu-before, #is-menu-after').attr('style', '');
				}, 125);
			} else {
				$('body, #is-menu-before, #is-menu-after').css( {
					left: '0%'
				});
				setTimeout(function() {
					$('body, #is-menu-before, #is-menu-after').attr('style', '');
					$('i', '#menu-toggle').trigger('click');
				}, 125);
			}
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
