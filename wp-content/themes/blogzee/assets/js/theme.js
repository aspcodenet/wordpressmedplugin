jQuery(document).ready(function($) {
    const { ajaxUrl, themeColor, _wpnonce: wpnonce, ticker } = blogzeeObject

    $(window).on("resize", function() {
        let selector = $('body')
        if( $(window).width() <= 426 ) {
            selector.removeClass( 'is-desktop is-tablet' ).addClass( 'is-smartphone' )
        } else if( $(window).width() <= 769 ) {
            selector.removeClass( 'is-desktop is-smartphone' ).addClass( 'is-tablet' )
        } else {
            selector.removeClass( 'is-smartphone is-tablet' ).addClass( 'is-desktop' )
        }
    })

    // top date time
    var timeElement = $( ".top-date-time .time" )
    if( timeElement.length > 0 ) {
        setInterval(function() {
            timeElement.html(new Date().toLocaleTimeString())
        },1000);
    }
    
    // handle preloader
    function blogzeePreloader( timeOut = 3000 ) {
        setTimeout(function() {
            $('body .blogzee_loading_box').hide();
        }, timeOut);
    }

    blogzeePreloader()

    // breadcrumb separator
    var breadcrumbSeparatorContainer = $('.blogzee-breadcrumb-element')
    if( breadcrumbSeparatorContainer.length > 0 ) {
        var listElement = breadcrumbSeparatorContainer.find('li.trail-item')
        var elementToAppend = '<span class="item-separator"><i class="fa-solid fa-angles-right"></i></span>'
        listElement.append(elementToAppend)
    }

    // header - normal search
    var searchSectionContainer = $('.search-wrap')
    if( searchSectionContainer.length > 0 ) {
        searchSectionContainer.on( 'click', '.search-trigger', function(){
            var _this = $(this)
            _this.siblings().show()
            _this.parent().addClass('toggled')
            _this.siblings().find('.search-field').focus()
            onElementOutsideClick( _this.parent(), function(){
                _this.parent().removeClass( 'toggled' )
                _this.siblings().find( '.search-form-close' ).click()
                $( 'body' ).removeClass( 'search-active' )
            })
            if( ! _this.parent().hasClass( 'search-type--default' ) ) $( 'body' ).addClass( 'search-active' )
        })

        // close search popup
        var closeButton = searchSectionContainer.find('.search-form-wrap')
        if( closeButton.length > 0 ) {
            closeButton.on('click', '.search-form-close', function(){
                var _thisButton = $(this), parentElement = _thisButton.parents('.search-wrap')
                parentElement.removeClass('toggled')
                _thisButton.parent().hide()
                $('body').removeClass( 'search-active' )
            })
        }

        // on ESC button click
        $(document).on('keydown', function( event ){
            if( event.keyCode == 27 ) {
                closeButton.hide()
                closeButton.parent().removeClass('toggled')
            }
        })
    }
    
     // check for dark mode drafts
     if( localStorage.getItem( "themeMode" ) != null ) {
        if( localStorage.getItem("themeMode") == "dark" ) {
            $('body').addClass( 'blogzee-dark-mode' ).removeClass('blogzee-light-mode')
        } else {
            $('body').addClass( 'blogzee-light-mode' ).removeClass('blogzee-dark-mode')
        }
    }

    // header - theme mode
    var themeModeContainer = $('.mode-toggle-wrap')
    if( themeModeContainer.length > 0 ) {
        themeModeContainer.on( 'click', '.mode-toggle', function(){
            var _this = $(this), bodyElement = _this.parents('body')
            if( bodyElement.hasClass('blogzee-dark-mode') ) {
                localStorage.setItem( 'themeMode', 'light' )
                bodyElement.removeClass('blogzee-dark-mode').addClass('blogzee-light-mode')
            } else {
                localStorage.setItem( 'themeMode', 'dark' )
                bodyElement.removeClass('blogzee-light-mode').addClass('blogzee-dark-mode')
            }
        })
    }

    // header - canvas menu
    var canvasMenuContainer = $('.blogzee-canvas-menu')
    if( canvasMenuContainer.length > 0 ) {
        canvasMenuContainer.on( 'click', '.canvas-menu-icon', function() {
            var _this = $(this), bodyElement = _this.parents('body')
            bodyElement.toggleClass('blogzee-model-open');
            onElementOutsideClick( _this.siblings(), function(){
                bodyElement.removeClass( 'blogzee-model-open' )
            })
        })
    }

    // on element outside click function
    function onElementOutsideClick( currentElement, callback ) {
        $(document).mouseup(function( e ) {
            var container = $(currentElement);
            if ( !container.is(e.target) && container.has(e.target).length === 0) callback();
        })
    }

    // back to top script
    if( $( "#blogzee-scroll-to-top" ).length ) {
        var scrollContainer = $( "#blogzee-scroll-to-top" );
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 500 ) {
                scrollContainer.addClass('show');
            } else {
                scrollContainer.removeClass('show');
            }
        });
        scrollContainer.on( 'click', '.scroll-to-top-wrapper, .icon-text', function(event) {
            event.preventDefault();
            // Animate the scrolling motion.
            $("html, body").animate({scrollTop:0},"slow");
        });
    }

    // main header sticky
    if( blogzeeObject.headerSticky ) {
        let isLoggedIn = $('body').hasClass('admin-bar')
        let allStickyRows = $('header#masthead .row-sticky')
        let dynamicTopValue = 0
        allStickyRows.each(function(){
            let _this = $(this)
            dynamicTopValue += _this.outerHeight()
        })
        if( isLoggedIn ) dynamicTopValue += 35
        $(window).on('scroll', function(){
            var scroll = $(window).scrollTop()
            var mainHeaderContainer = $('header.site-header')
            if( scroll >= 200 ) {
                mainHeaderContainer.addClass('header-sticky--enabled').removeClass('header-sticky--disabled')
            } else {
                mainHeaderContainer.addClass('header-sticky--disabled').removeClass('header-sticky--enabled')
            }
        })
    }

    // cursor animation
    var cursorContainer = $('.blogzee-cursor')
    if( cursorContainer.length > 0 ) {
        $(document).on( 'mousemove', function( event ){
            cursorContainer[0].style.top = 'calc('+ event.pageY +'px - 15px)'
            cursorContainer[0].style.left = 'calc('+ event.pageX +'px - 15px)'
        })
        var selector = 'a, button, input[type="submit"], #blogzee-scroll-to-top .icon-text, #blogzee-scroll-to-top .icon-holder, .blogzee-widget-loader .load-more, .mode-toggle-wrap .mode-toggle, .blogzee-canvas-menu .canvas-menu-icon, .blogzee-table-of-content .toc-fixed-icon, .blogzee-social-share.show-on-click'
        $( selector ).on( 'mouseover', function(){
            $( cursorContainer ).addClass( 'isActive' )
        })
        $( selector ).on( 'mouseout', function(){
            $( cursorContainer ).removeClass( 'isActive' )
        })
    }

    /**
     * convert string true or false to bool true or false
     * 
     * @since 1.0.0
     */
    const blogzeeConverToBoolean = ( value ) => {
        return ( value === 'true' ) ? true : false
    }

    /**
     * Initialize swiper js
     * 
     * @since 1.0.0
     */
    const blogzeeInitializeSwiper = ( props ) => {
        const { arrows, fade, loop, speed, autoplay, autoplaySpeed, slidesPerView, slidesPerGroup, breakpoints, swiperClass, autoHeight, direction, spaceBetween, navigation } = props
        let swiperObject = {
            arrows: blogzeeConverToBoolean( arrows ) || true,
            loop: blogzeeConverToBoolean( loop ),
            speed: parseInt( speed ) || 500,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
        }
        if( navigation ) swiperObject = { ...swiperObject, navigation: navigation }
        if( autoHeight !== undefined ) swiperObject = { ...swiperObject, autoHeight: autoHeight }
        if( spaceBetween !== undefined ) swiperObject = { ...swiperObject, spaceBetween: spaceBetween }
        if( direction !== undefined ) swiperObject = { ...swiperObject, direction: direction }
        if( slidesPerView !== undefined ) swiperObject = { ...swiperObject, slidesPerView: parseInt( slidesPerView ) }
        if( slidesPerGroup !== undefined ) swiperObject = { ...swiperObject, slidesPerGroup: parseInt( slidesPerGroup ) }
        if( breakpoints !== undefined ) swiperObject = { ...swiperObject, breakpoints: { ...breakpoints } }
        if( ( fade !== undefined ) || true ) swiperObject = { 
            ...swiperObject,
            effect: blogzeeConverToBoolean( fade ) ? 'fade' : 'slide',
            fadeEffect: {
                crossFade: true
            }
        }
        if( blogzeeConverToBoolean( autoplay ) || false ) swiperObject = { 
            ...swiperObject,
            autoplay: { 
                delay: parseInt( autoplaySpeed ) || 3000,
                stopOnLastSlide: true
            }
        }
        return new Swiper( swiperClass, swiperObject );
    }

    /**
     * Main Banner JS
     * 
     * @since 1.0.0
     */
    var fullWidthBannerContainer = $('#blogzee-main-banner-section')
    if( fullWidthBannerContainer.length > 0 ) {
        const { arrows = true, fade = true, infiniteLoop = true, speed = 500, autoplay = false, autoplaySpeed = 3000 } = blogzeeObject;
        var mainBannerTopObject = {
            arrows: true,
            fade: fade,
            loop: infiniteLoop,
            speed: speed,
            autoplay: autoplay,
            autoplaySpeed: autoplaySpeed,
            navigation: false,
            navigation: {
                nextEl: '.custom-button-next',
                prevEl: '.custom-button-prev'
            },
            swiperClass: '.main-banner-wrap.swiper'
        }
        blogzeeInitializeSwiper( mainBannerTopObject )
    }

    /**
     * Carousel JS
     * 
     * @since 1.0.0
     */
    var carouselContainer = $('.blogzee-carousel-section')
    if( carouselContainer.length > 0 ) {
        let _this = carouselContainer
        blogzeeInitializeSwiper({
            arrows: true,
            loop: true,
            speed: 500,
            autoplay: false,
            autoplaySpeed: 3000,
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: _this.hasClass( 'carousel-layout--two' ) ? 15 : 24,
            navigation: { nextEl: '.custom-button-next', prevEl: '.custom-button-prev' },
            breakpoints: {
                50: { slidesPerView: 1 },
                610: { slidesPerView: 2 },
                769: { slidesPerView: 3 },
            },
            swiperClass: '#blogzee-carousel-section .swiper'
        })
    }

    /**
     * Carousel Posts JS
     * 
     * @since 1.0.0
     */
    var cpWidgets = $( ".blogzee-widget-carousel-posts" )
    cpWidgets.each(function() {
        var _this = $(this), parentWidgetContainerId = _this.parents( ".widget.widget_blogzee_carousel_widget" ).attr( "id" ), parentWidgetContainer
        if( typeof parentWidgetContainerId != 'undefined' ) {
            parentWidgetContainer = $( "#" + parentWidgetContainerId )
            var ppWidget = parentWidgetContainer.find( ".carousel-posts-wrap" );
        } else {
            var ppWidget = _this;
        }
        if( ppWidget.length > 0 ) {
            let swiperObject = {
                arrows: true,
                loop: true,
                autoplay: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoHeight: true,
                direction: 'horizontal',
                navigation: { nextEl: _this.find( '.custom-button-next' )[0], prevEl: _this.find( '.custom-button-prev' )[0] },
            }
            new Swiper( _this.find( '.swiper' )[0], swiperObject )
        }
    })

    // handle the post gallery post format
    var postGalleryElems = $("body #primary article.format-gallery .post-thumbnail-wrapper")
    if( postGalleryElems.length > 0 ) {
        postGalleryElems.each(function() {
            let swiperObject = {
                navigation: {
                    nextEl: $(this).find( '.custom-button-next' )[0],
                    prevEl: $(this).find( '.custom-button-prev' )[0]
                }
            }
            new Swiper( $(this).find('.swiper')[0], swiperObject )
        })
    }

    /**
     * Responsive header builder toggle button
     * 
     * @since 1.0.0
     */
    var responsiveHeaderBuilderWrapper = $('.bb-bldr--responsive')
    if( responsiveHeaderBuilderWrapper.length > 0 ) {
        let toggleButton = responsiveHeaderBuilderWrapper.find( '.toggle-button-wrapper' )
        toggleButton.on("click", function() {
            let _this = $(this)
            _this.parents( '.bb-bldr-row' ).siblings( '.bb-bldr-row.mobile-canvas' ).toggleClass( 'open' )
        })
    }

    const progressBar = {
        init: function() {
            this.scrollEvent()
        },
        selectors: {
            'scroll-to-top': {
                'selector': '#blogzee-scroll-to-top.display--fixed .scroll-to-top-wrapper',
                'property': 'background',
                'usesBackground': true
            },
            'single-progress': {
                'selector': 'body.page .single-progress, body.single .single-progress, body.archive .single-progress, body.search .single-progress',
                'property': 'width',
                'usesBackground': false
            }
        },
        totalScrollableArea: $('body')[0].clientHeight,
        sizeOfScrollBar: window.innerHeight,
        scrollEvent: function() {
            let self = this
            $(window).on("scroll", function(){
                let scrollBarPosition = window.scrollY
                if( scrollBarPosition < 1 ) {   /* Hide when Top is reached */
                    $( self.selectors['single-progress'].selector ).hide()
                } else {
                    $( self.selectors['single-progress'].selector ).show()
                }
                let width = self.getWidth( scrollBarPosition )
                if( self.isBottom() ) width = 100   /* Run when bottom is reached */
                let background = 'conic-gradient('+ themeColor +' '+ width +'%, transparent '+ width +'%)'
                Object.entries( self.selectors ).forEach(( current ) => {
                    const [ ID, selectorValues ] = current
                    const { selector, property, usesBackground } = selectorValues
                    if( usesBackground ) {
                        $( selector ).attr( 'style', property + ': ' + background )
                    } else {
                        $( selector ).css( property, width + '%' )
                    }
                })
            })
        },
        getWidth: function( scrollBarPosition ) {
            let width = ( ( ( scrollBarPosition + this.sizeOfScrollBar ) / this.totalScrollableArea ) * 100 )
            return Math.round( width );
        },
        isBottom: function() {
            if ( $(window).scrollTop() + $(window).height() >= $(document).height()) return true
        }
    }
    progressBar.init()

    /**
     * Ticker News
     * 
     * @since 1.0.0
     */
    let tickerNewsContainer = $( '.blogzee-ticker-news' )
    if( tickerNewsContainer.length > 0 ) {
        let marqueeInstance = tickerNewsContainer.find( ".ticker-item-wrap" ).marquee({
            duration: 15000,
            gap: 20,
            delayBeforeStart: 0,
            // direction,
            duplicated: true,
            startVisible: true,
            pauseOnHover: true
        });
        tickerNewsContainer.on( "click", ".controller-icon", function() {
            let _this = $( this ),
                parent = _this.parent();
                
            _this.find( 'i' ).removeClass().addClass( parent.hasClass( 'playing' ) ? 'fa-solid fa-play' : 'fa-solid fa-pause' )
            parent.toggleClass( 'playing paused' )
            marqueeInstance.marquee( "toggle" )
        })
    }

    // console.log( $( '.pause-overlay' ) )
    $( '.video-overlay' ).on( 'click', function(){
        let _this = $( this ),
            iframe = _this.siblings( 'iframe' ),
            parent = _this.parents( '.blogzee-article-inner' ),
            src = iframe.attr( 'src' ),
            newSrc = '';
        _this.remove()
        parent.toggleClass( 'playing' )
        if( parent.hasClass( 'playing' ) ) {
            newSrc = src + '&autoplay=1';
        } else {
            newSrc = src.replace(/[?&]autoplay=1/, '');
        }
        iframe.attr( 'src', newSrc )
    })
})