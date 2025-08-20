(function( api, $ ) {
    const { ajaxUrl, custom_callback: customCallback, _wpnonce, custom } = customizerExtrasObject

    // Change the previewed URL to the selected page when changing the page_for_posts.
    $.each( custom, function( key, val ) {
        if( key == 'single_section_panel' ) {
            api.panel( key, function ( panel ) {
                panel.expanded.bind(function ( isExpanded ) {
                    if ( isExpanded ) {
                        api.previewer.previewUrl.set( val );
                    }
                });
            });
        } else {
            api.section( key, function ( section ) {
                section.expanded.bind(function ( isExpanded ) {
                    const { id } = section
                    if( id === 'archive_general_section' && api.previewer.previewUrl() === val ) return
                    if ( isExpanded ) {
                        api.previewer.previewUrl.set( val );
                    }
                });
            });
        }
    })

    /**
     * Return current tab
     * 
     * @since 1.0.0
     */
    const getCurrentTab = ( controlID ) => {
        let controlInstance = api.control( controlID )
        let controlContainer = controlInstance.container
        let sectionTabFullId = controlContainer.siblings( '.customize-control-section-tab' ).attr( 'id' )
        let sectionTabId = sectionTabFullId.replace( 'customize-control-', '' )
        return api.control( sectionTabId ).setting.get()
    }

    // contextual
    $.each( customCallback, function( controlId, controlValue ) {
        wp.customize( controlId, function( value ) {
            value.bind( function( to ) {
                $.each( controlValue, function( index, toToggle ){
                    if( JSON.stringify( to ) == index ) {
                        $.each( toToggle, function( key, val ){
                            // let sectionTabValue = getCurrentTab( val )
                            let controlInstance = api.control( val )
                            controlInstance.activate()
                            // if( sectionTabValue !== controlInstance.params.tab ) controlInstance.deactivate()
                        })
                    } else {
                        $.each( toToggle, function( key, val ){
                            // let sectionTabValue = getCurrentTab( val )
                            let controlInstance = api.control( val )
                            controlInstance.deactivate()
                            // if( sectionTabValue !== controlInstance.params.tab ) controlInstance.deactivate()
                        })
                    }
                })
                if( to in controlValue ) {
                    $.each( controlValue[to], function( key, val ){
                        // let sectionTabValue = getCurrentTab( val )
                        let controlInstance = api.control( val )
                        controlInstance.activate()
                        // if( sectionTabValue !== controlInstance.params.tab ) controlInstance.deactivate()
                    })
                }
            });
        });    
    })

    // ajax calls
    $(document).on( "click", ".customize-info-box-action-control .info-box-button", function() {
        var _this = $(this), action = _this.data("action"), html = _this.html();
        $.ajax({
            method: 'post',
            url: ajaxUrl,
            data: ({
                'action': action,
                '_wpnonce': _wpnonce,
            }),
            beforeSend: function() {
                _this.html( 'Processing' )
                _this.attr( 'disabled', true )
            },
            success: function() {
                _this.html( html );
            },
            complete: function() {
                window.location.reload();
            }
        })
    })

    const builderHandler = {
        init: function(){
            this.headerBuilder();
            this.footerBuilder();
            this.addActiveClasses();
        },
        widgetSections: {},
        headerBuilderId: '',
        footerBuilderId: '',
        headerBuilder: function() {
            this.headerBuilderId = 'header_builder'
            this.widgetSections['header'] = this.builderBehaviour( this.headerBuilderId )
        },
        footerBuilder: function() {
            this.footerBuilderId = 'footer_builder'
            this.widgetSections['footer'] = this.builderBehaviour( this.footerBuilderId )
        },
        builderBehaviour: function( controlId ){
            let controlInstance = api.control( controlId )
            const { widgets, builder_settings_section } = controlInstance.params
            let widgetSections = this.getWidgetSections( widgets )
            return [ ...widgetSections, builder_settings_section ]
        },
        getWidgetSections: function( widgets ){
            return Object.values( widgets ).reduce(( newValue, widgetValue ) => {
                const { section } = widgetValue
                newValue = [ ...newValue, section ]
                return newValue
            }, [])
        },
        addActiveClasses: function(){
            const widgetSections = this.widgetSections
            const { header, footer } = widgetSections
            const headerBuilderId = this.headerBuilderId
            const footerBuilderId = this.footerBuilderId
            api.section.each(( sectionInstance, sectionID ) => {
                sectionInstance.expanded.bind(function( isExpanded ){
                    if( isExpanded ) {
                        if( sectionInstance.contentContainer.hasClass( 'blogzee-builder-related' ) ) {
                            let builderId = ''
                            if( header.includes( sectionID ) ) {
                                builderId = headerBuilderId
                            }
                            if( footer.includes( sectionID ) ) {
                                builderId = footerBuilderId
                            }
                            if( builderId !== '' ) {
                                let controlInstance = api.control( builderId )
                                const { builder_settings_section } = controlInstance.params
                                const { container } = controlInstance
                                const builderSettingsSection = api.section( builder_settings_section ).contentContainer
                                container.parent().addClass( 'is-active' ).siblings().removeClass( 'is-active' )
                                builderSettingsSection.addClass( 'active-builder-setting' ).siblings().removeClass( 'active-builder-setting' )
                                builderSettingsSection.parents( '#customize-controls' ).siblings('#customize-preview').addClass( 'blogzee-builder--on' )
                            }
                        } else {
                            if( $('.blogzee-builder.is-active') ) $('.blogzee-builder.is-active').removeClass( 'is-active' )
                            if( $('.blogzee-builder-related.active-builder-setting') ) $('.blogzee-builder-related.active-builder-setting').removeClass( 'active-builder-setting' )
                            $('#customize-preview').removeClass( 'blogzee-builder--on' )
                        }
                    }
                })
            })
        }
    }
    $(document).ready(function(){
        builderHandler.init()
    })
})( wp.customize, jQuery )