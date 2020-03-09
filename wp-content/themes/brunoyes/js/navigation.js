/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function($) {
	var menuContainer, container, button, closeButton, menu, links, i, len, bgColor, color, contentColor, backToTopDiv;
    const widgetArea = $('.widget-area');

    // site global color:
    const article = $('article');
    bgColor = article.data('bgcolor');
    color = article.data('color');
    contentColor = article.data('colorcontent');

    if (bgColor) {
        $('html').css('background-color', bgColor);

        var backgroundImage = $('.background-image-container').data('url');
        if (!backgroundImage) {
            document.styleSheets[0].addRule('.site-header::before', 'background-color: ' + bgColor + ' !important;');
        } else {
            document.styleSheets[0].addRule('.site-header::before', 'background-color: rgba(0, 0, 0, 0) !important;');
        }
    }

    if (color) {
        $('.global-stroke').css('stroke', color);
        $('.global-fill').css('fill', color);
        $('.global-color').css('fill', color).css('stroke', color);
        $('.site-title').find('a').css('color', color);
        $('.menu-item').find('a').css('color', color);
        $('.menu-container').css('border-color', color);
        widgetArea.css('border-color', color).css('color', color).find('a').css('color', color);
        document.styleSheets[0].addRule('.main-navigation .current-menu-item > a::after','background-color: ' + color + ' !important;');
    }

	container = document.getElementById( 'site-navigation' );
    menuContainer = document.getElementById('menu-container');

	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

    function checkIfOutside(e) {
        if (menuContainer.contains(e.target) || button.contains(e.target)) {
            return;
        } else {
            hideMenu();
        }
    }

    function removeClickOutsideEventListener() {
        window.removeEventListener('click', checkIfOutside);
    }

    function addClickOutsideEventListener() {
        window.addEventListener('click', checkIfOutside);
    }

    function hideMenu() {
        container.className = container.className.replace( ' toggled', '' );
        button.setAttribute( 'aria-expanded', 'false' );
        menu.setAttribute( 'aria-expanded', 'false' );
        removeClickOutsideEventListener();
    }

    function showMenu() {
        container.className += ' toggled';
        button.setAttribute( 'aria-expanded', 'true' );
        menu.setAttribute( 'aria-expanded', 'true' );
        addClickOutsideEventListener();
    }

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
            hideMenu();
		} else {
            showMenu();
		}
	};

    closeButton = container.getElementsByClassName( 'close-btn' )[0];

    closeButton.onclick = function() {
        hideMenu();
    }

    //////////////////////////
    // Scrolling
    function handleScroll() {
        const header = document.getElementsByClassName('site')[0];

        if (window.scrollY ||
            window.pageYOffset ||
            document.body.scrollTop +
                (document.documentElement && document.documentElement.scrollTop || 0)
            ) { // the user has scrolled down.

          // fix the header
          if (!header.className.includes('fixed')) {
            header.className = `${header.className} fixed`;
          }

          // show the back to top button
          backToTopDiv.show();
        } else {
          header.className = header.className.replace(' fixed', '');
        }
    }
    window.addEventListener('scroll', handleScroll);

    function handleImageVisibility(index, elem) {
        var $elem = $(elem);
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $elem.offset().top;
        var elemBottom = elemTop + $elem.height();

        if (elemBottom > (docViewTop - 200) && elemTop < (docViewBottom + 200)) {
            window.showImage($elem);
        }
    }
    function handleImagesVisibility() {
        $('.image_preload:not(.loaded)').each(handleImageVisibility);
    }
    window.addEventListener('scroll', handleImagesVisibility);
    setTimeout(handleImagesVisibility, 150);
    window.handleImagesVisibility = handleImagesVisibility;

    window.showImage = function ($elem) {
        var image = $(atob($elem.data('image')));
        image.addClass('loading');
        $elem.addClass('loaded');

        image.load(function () {
            $elem.hide().after(image);
            setTimeout(function () {
                image.removeClass('loading');
            }, 10);
        });
    };

    //////////////////////////
    // Archive fake hovering:
    const archiveLink = $('.archive article');
    archiveLink
        .on('click', function(e) {
            var $this = $(this);
            if ($this.hasClass('hovered')) {
                return;
            } else {
                e.preventDefault();
                e.stopPropagation();
                archiveLink.removeClass('hovered');
                $this.addClass('hovered');
            }
        })
        .on('mouseenter', function (e) {
            if(!!('ontouchstart' in window)) {
                return;
            }
            $(this).addClass('hovered');
        })
        .on('mouseleave', function (e) {
            if(!!('ontouchstart' in window)) {
                return;
            }
            $(this).removeClass('hovered');
        });

    /////////////////////////////////////
    // Show back to top button if needed
    backToTopDiv = $('<div>')
        .html('Back to top <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.971 6.552"><defs><style>.a{fill:none;stroke:#000;}</style></defs><path class="a content-stroke" d="M115.352,335.617l6.151-5.509,6.151,5.509" transform="translate(127.988 335.99) rotate(180)"/></svg>')
        .addClass('back-to-top')
        .on('click', function () {
            $('html, body').animate({ scrollTop: 0 }, 250);
        })
        .hide();

    widgetArea.before(backToTopDiv);
    if (contentColor) {
        backToTopDiv.css('color', contentColor);
        backToTopDiv.find('.content-stroke').css('stroke', contentColor).css('fill', 'none');
    }

    backToTopDiv.appendTo('.footer-container');
    widgetArea.appendTo('.footer-container');

} )(jQuery);
