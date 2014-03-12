/*
 * jQuery hesSlider v0.0.1
 * Hesedel Pajaron
 */

(function($) {

$.hesSlider = function(el, options) {
	var $slider = $(el);

	$slider.settings = $.extend( {

	}, options);

	var
		$scroll = $('.hes-slider-scroll', $slider),
		$slides = $('.hes-slider-slides', $slider),
		methods = {};

	$.data(el, 'hesSlider', $slider);

	// private methods
	methods = {
		init: function() {
			methods.scroll.hideScrollbar();
			methods.slides.removeWhiteSpaces();

			$scroll.data('scrollLeft', 0);
			$scroll
				.bind('touchstart', methods.scroll.bindTouchstart)
				.bind('scroll', methods.scroll.bindScroll)
				.bind('touchend', methods.scroll.bindTouchend);
		},
		scroll: {
			bindTouchstart: function() {
				$scroll.data('touchstart', true);
			},
			bindScroll: function() {
				$scroll.data('scrolling', true);

				clearTimeout($scroll.data('timeout'));

				if(!$scroll.data('touchstart')) {
					if(methods.scroll.scrollDistance() === 0) {
						$scroll.data('scrollLeft', $scroll.scrollLeft());
					} else {
						$scroll.data('timeout', setTimeout(function() {
							if(methods.scroll.scrollDistance() < 0 && $scroll.data('scrollLeft') !== 0) {
								methods.scroll.prev();
							}
							if(methods.scroll.scrollDistance() > 0 && $scroll.data('scrollLeft') !== methods.slides.width() - methods.slide.width()) {
								methods.scroll.next();
							}
						}, (0)));
					}
				}

				if(Math.abs($scroll.scrollLeft() - $scroll.data('scrollLeft2')) <= 5) {
					$scroll.data('scrolling', false);
				}
				$scroll.data('scrollLeft2', $scroll.scrollLeft());
			},
			bindTouchend: function() {
				$scroll.data('touchstart', false);
				if(!$scroll.data('scrolling')) {
					$scroll.trigger('scroll');
				}
			},
			hideScrollbar: function() {
				$scroll.wrap('<div>').parent().css( {
					overflow: 'hidden'
				});
				$scroll.css( {
					'margin-bottom': $slides.height() - $scroll.height()
				});
			},
			prev: function() {
				$scroll.unbind('scroll', methods.scroll.bindScroll);
				$scroll.stop().animate( {
					scrollLeft: $scroll.scrollLeft() - methods.slide.width() - (($scroll.scrollLeft() - $scroll.data('scrollLeft')) % methods.slide.width())
				}, 'fast', function() {
					$scroll.data('scrollLeft', $scroll.scrollLeft());
					$scroll.bind('scroll', methods.scroll.bindScroll);
				});
			},
			next: function() {
				$scroll.unbind('scroll', methods.scroll.bindScroll);
				$scroll.stop().animate( {
					scrollLeft: $scroll.scrollLeft() + methods.slide.width() - ($scroll.scrollLeft() % methods.slide.width())
				}, 'fast', function() {
					$scroll.data('scrollLeft', $scroll.scrollLeft());
					$scroll.bind('scroll', methods.scroll.bindScroll);
				});
			},
			scrollDistance: function() {
				return ($scroll.scrollLeft() - $scroll.data('scrollLeft')) % methods.slide.width();
			}
		},
		slides: {
			removeWhiteSpaces: function() {
				$slides.contents().filter(function() {
					return this.nodeType === 3;
				}).remove();
			},
			width: function() {
				return $slides.width() * $('> *', $slides).length;
			}
		},
		slide: {
			width: function() {
				return $('> *', $slides).width();
			}
		}
	};

	// public methods
	$slider.someFunction = function() {

	};

	methods.init();
};

$.fn.hesSlider = function(options) {
	if(options === undefined) {
		options = {};
	}

	if(typeof options === 'object') {
		return this.each(function() {
			$.hesSlider(this, options);
		});
	}
};

}(jQuery));
