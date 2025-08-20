/**
 * Theme Info
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

jQuery( document ).ready(function( $ ){
    var ajaxUrl = blogzeeThemeInfoObject.ajaxUrl, _wpnonce = blogzeeThemeInfoObject._wpnonce
    // not having importer
    var buttonContainer = $('.nexus-status').not('.importer')
    if( buttonContainer.length > 0 ) {
        buttonContainer.each( function(){
            var _thisButton = $(this)
            _thisButton.on( 'click', function( event ){
                event.preventDefault()
                var _this = $(this), downloadLink = _this.data('link'), file = _this.data( 'file' ), plugin_action, buttonMessage
                var importerOrNot = _this.hasClass( 'action-trigger' )
                if( _this.hasClass( 'not-installed' ) ) {
                    plugin_action = 'not-installed'
                    buttonMessage = 'Installing...'
                } else if( _this.hasClass( 'inactive' ) ) {
                    plugin_action = 'inactive'
                    buttonMessage = 'Activating...'
                } else {
                    plugin_action = 'active'
                }
                $.ajax({
                    url: ajaxUrl,
                    type: 'post',
                    data: {
                        "action": "blogzee_importer_plugin_action",
                        "_wpnonce": _wpnonce,
                        "plugin_action": plugin_action,
                        "link": downloadLink,
                        "file": file,
                        "importer_or_not": importerOrNot
                    },
                    beforeSend: function () {
                        _this.text( buttonMessage )
                    },
                    success: function( result ) {
                        var info = JSON.parse( result );
                        if( info.message ) _this.hide().html('').fadeIn().html( info.message );
                    },
                    complete: function() {
                        $('#blogzee-form').submit()
                        // location.reload();
                    }
                })
            })
        } )
    }

    // view all button
    var ViewAllContainer = $('#blogzee-info-page')
    if( ViewAllContainer.length > 0 ) {
        ViewAllContainer.on('click', '.canvas-expand', function(){
            var _this = $(this)
            _this.toggleClass( 'open' )
            _this.parents( ViewAllContainer ).find( '.starter-sites-section-wrap' ).toggleClass('active')
            if( _this.hasClass( 'open' ) ){
                _this.find('.button-label').text( 'Close' )
                _this.find('.button-icon').appendTo( _this ).removeClass( 'dashicons-arrow-left-alt2' ).addClass( 'dashicons-arrow-right-alt2' )
            } else {
                _this.find('.button-label').text( 'View all' )
                _this.find('.button-icon').prependTo( _this ).removeClass( 'dashicons-arrow-right-alt2' ).addClass( 'dashicons-arrow-left-alt2' )
                _this.siblings('.demo-listing.canvas-body').find('.demo-item').show()
                _this.siblings('.canvas-header.is-open').find('.canvas-search #demo_search').val('')
            }
        })
    }

    var starterSitesContainer = $('.starter-sites-section-wrap')
    if( starterSitesContainer.length > 0 ) {
        // filter tab
        starterSitesContainer.on( 'click', '.filter-tabs .tab', function(){
            var _this = $(this), allClasses = _this.attr( 'class' ), activeClass = ''
            var toRender = _this.parents( '.canvas-header.is-open' ).siblings( '.demo-listing.canvas-body' ).find( '.demo-items-wrap' )
            if( _this.hasClass( 'active' ) ) return;
            _this.addClass('active').siblings().removeClass('active')
            if( allClasses.includes( 'tab' ) ) activeClass = allClasses.replace( 'tab ', '' )
            if( activeClass != 'all' ) {
                toRender.find('.demo-item.' + activeClass ).show()
                toRender.find('.demo-item' ).not('.' + activeClass).hide()
            } else {
                toRender.find('.demo-item').show()
            }
        })

        // canvas search
        starterSitesContainer.on( 'change, keyup', '.canvas-search #demo_search', function( event ){
            var _this = $(this), currentValue = event.target.value
            var toRender = _this.parents( '.canvas-header.is-open' ).siblings( '.demo-listing.canvas-body' ).find( '.demo-items-wrap' )
            var demoItem = toRender.find( '.demo-item' )
            demoItem.each(function(){
                var _thisItem = $(this), allClasses = _thisItem.attr( 'class' ), activeClass = ''
                var label = _thisItem.find('.demo-label').text()
                if( allClasses.includes( 'demo-item' ) ) activeClass = allClasses.replace( 'demo-item  ', '' )
                if( activeClass.indexOf( currentValue ) !== -1 || (label.toLowerCase()).indexOf( currentValue ) !== -1 ) {
                    _thisItem.show()
                } else {
                    _thisItem.hide()
                }
            })
        })

        // system info popup
        starterSitesContainer.on('click', '.system-info-button', function(){
            var _this = $(this)
            _this.parent().siblings().toggleClass( 'open close' )
        })
    }
})