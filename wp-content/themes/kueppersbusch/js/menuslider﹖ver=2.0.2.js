(function($) {

	var classes = {
		container: 'menuslider',
		menu: 'menuslider_menu',
		slide: 'menuslider_slide',
		autoPos: 'menuslider_slide_pos',
		centerV: 'menuslider_slide_pos_center_v',
		addMenuX: 'menuslider_slide_pos_add_x',
	};

	var responsiveLimit = 981;

	var slideTime = 10000;

	var minMenuWidth = 150;
	var menuXOffset = 30;

	var MODE_FULL = 'MODE_FULL';
	var MODE_SIMPLE = 'MODE_SIMPLE';

	var $window = $(window);

	var intervals = {};

	function prepareMenuSliders() {

		var $menus = $('.' + classes.container);
		$menus.each(function() {
			createMenuSlider($(this));
		});
	}

	function createMenuSlider($container) {

		var originalHTML = $container.html();

		var $menu, $slides, $options, $verticalCenter, $addPadding, width, height, mode, resizeHandler;

		$window.resize(resize);
		resize();

		function updateSelectors() {
			$menu = $('.' + classes.menu, $container);
			$slides = $('.' + classes.slide, $container);
			$options = $('li', $menu);

			$autoPos = $('.' + classes.autoPos, $container);
			$verticalCenter = $('.' + classes.centerV, $container);
			$addMenuX = $('.' + classes.addMenuX, $container);
		}

		function resize() {

			width = $window.width();
			height = $window.height();

			if (width < responsiveLimit) {
				resizeHandler = showSimple();
			} else {
				resizeHandler = showFull();
			}

			resizeHandler();
		}

		function showSimple() {

			if (mode == MODE_SIMPLE) return resizeHandler;
			mode = MODE_SIMPLE;

			var i = 0;

			if (intervals.resize) clearInterval(intervals.resize);
			if (intervals.showSlide) clearInterval(intervals.showSlide);

			$container.html(originalHTML);
			updateSelectors();

			$options.each(function() {
				var $this = $(this);
				var index = i;
				var $slide = $($slides.get()[index]);
				
				$this.click(function() {
					showSlide(index);
				});

				++i;
			});

			function showSlide(index) {

				var $slide = $($slides.get()[index]);
				var top = $slide.offset().top;

				$('body, html').animate({scrollTop: top}, 500);
			}

			function resize() {
				$container.css({height: ''});
			}

			return resize;
		}

		function showFull() {

			if (mode == MODE_FULL) return resizeHandler;
			mode = MODE_FULL;
			
			var i = 0;
			var currentSlide = null;

			$container.html(originalHTML);
			updateSelectors();

			$container.css({
				position: 'relative'
			});

			$menu.css({
				position: 'absolute',
				top: '50%',
				width: 'auto',
				zIndex: 99999
			});

			$slides.css({
				position: 'absolute',
				top: 0,
				left: 0,
				width: '100%'
			});

			$options.each(function() {
				var $this = $(this);
				var index = i;
				var $slide = $($slides.get()[index]);
				
				$this.click(function() {
					if (intervals.showSlide) clearInterval(intervals.showSlide);
					showSlide(index);
				});

				++i;
			});

			if (intervals.resize) clearInterval(intervals.resize);
			if (intervals.showSlide) clearInterval(intervals.showSlide);

			intervals.resize = setInterval(function() {
				resize();
			}, 100);

			$slides.fadeOut(0);

			showSlide(0);

			intervals.showSlide = setInterval(function() {
				showSlide(((currentSlide + 1) % $slides.length ));
			}, slideTime);

			function showSlide(index) {

				if (index == currentSlide) return;
				
				var delay = 1;

				if (currentSlide !== null) {
					delay = 500;
					$($slides.get()[currentSlide]).fadeOut(500);
				}

				for (var i in $options.get()) {
					var $option = $($options.get()[i]);
					var $slide = $($slides.get()[i]);
					if (i == index) {
						$option.addClass('selected');
						$slide.addClass('selected');
					} else {
						$option.removeClass('selected');
						$slide.removeClass('selected');
					}
				}

				setTimeout(function() {
					$($slides.get()[index]).fadeIn(500);
				}, delay);

				currentSlide = index;
			}

			var lastHeight = 0;

			function resize() {

				var heights = [];

				$slides.each(function() {
					heights.push($(this).height());
				});

				var maxHeight = Math.max.apply(null, heights);
				
				if (maxHeight == lastHeight) return;

				lastHeight = maxHeight;

				$container.height(maxHeight);
				$menu.css({marginTop: -$menu.outerHeight() / 2});

				var slideHeight = maxHeight;
				var menuWidth = $menu.outerWidth();

				$verticalCenter.each(function() {
					var $this = $(this);

					var display = $this.css('display');

					$this.css({
						paddingTop: 0
					});

					var i = setInterval(function() {
						var h = $this.height();
						if (mode != MODE_FULL) clearInterval(i);
						if (h != 0) {
							clearInterval(i);
							$this.css({
								paddingTop: (slideHeight - h) / 2
							});
						}
					}, 100);
				});

				$addMenuX.each(function() {
					var $this = $(this);
					$this.css({
						paddingLeft: (menuWidth > minMenuWidth ? menuWidth : minMenuWidth) + menuXOffset
					});
				});
			}

			return resize;
		}

		function restore() {
			$container.html(originalHTML);
		}
	}


	$(document).ready(function() {
		prepareMenuSliders();
	});

})(jQuery);