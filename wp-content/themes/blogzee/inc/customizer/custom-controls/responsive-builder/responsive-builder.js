( function( api, $ ) {
	api.controlConstructor['responsive-builder'] = api.Control.extend({
		ready: function() {
			var control = this, container = control.container
			let settings = this.params
            const { widgets, builder_settings_section: builderSettingsSection, placement } = settings
            // responsiveBuilderID
            // const responsiveBuilderInstance = api.section( responsiveBuilderID )
            const widgetSections = this.getWidgetSection( widgets )
            const rowSections = this.getRowSections( placement )
            // const allSections = ( responsiveBuilderInstance !== undefined ) ? [ ...widgetSections, ...rowSections, responsiveBuilderID ] : [ ...widgetSections, ...rowSections]
            const allSections = [ ...widgetSections, ...rowSections]
            this.addCommonBuilderClass( container.parent() )
            this.appendAtTheEnd( container )
            this.addIsActiveClass( container, builderSettingsSection )
            this.addCustomSectionClass([ ...allSections, builderSettingsSection ], builderSettingsSection )
            // this.onResponsiveButtonClick( responsiveBuilderInstance.contentContainer, container.parent() )
        },
        getWidgetSection: function( widgets ) {
            return Object.values( widgets ).map( widget => widget.section )
        },
        getRowSections: function( placement ) {
            let rowCount = [ 1, 2, 3 ]
            return rowCount.map(( row ) => placement + "_" + this.convertToString( row ) + "_row" )
        },
        appendAtTheEnd: function( container ) {
            let themeControlsDiv = $('#customize-theme-controls')
            container.parent().appendTo( themeControlsDiv )
        },
        addCustomSectionClass: function( sections, toSkip ) {
            sections.map(( section ) => {
                const sectionInstance = api.section( section )
                let sectionContainer = sectionInstance.contentContainer
                sectionContainer.addClass( 'blogzee-builder-related' )    // ul
                if( toSkip !== section ) sectionInstance.headContainer.addClass( 'blogzee-builder-related-parent' )    // li
            })
        },
        addIsActiveClass: function( container, builderSettingsSection ) {
            const sectionInstance = api.section( builderSettingsSection )
            const sectionContent = sectionInstance.contentContainer
            sectionInstance.expanded.bind(function ( isExpanded ) {
                if ( isExpanded ) {
                    sectionContent.addClass( 'active-builder-setting' )
                    container.parent().addClass( 'is-active' )
                    sectionContent.parents( '#customize-controls' ).siblings('#customize-preview').addClass( 'blogzee-builder--on' )
                }
            });
            const sectionContainerBackButton = sectionContent.find( '.section-meta .customize-section-back' )
            sectionContainerBackButton.on("click", function(){
                sectionContent.removeClass( 'active-builder-setting' )
                container.parent().removeClass( 'is-active' )
                sectionContent.parents( '#customize-controls' ).siblings('#customize-preview').removeClass( 'blogzee-builder--on' )
            })
        },
        convertToString: function( number ){
            switch( number ) {
                case 2:
                    return 'second'
                    break;
                case 3:
                    return 'third'
                    break;
                default: 
                    return 'first'
            }
        },
        onResponsiveButtonClick: function( responsiveBuilder, normalBuilder ) {
            const responsiveButtonsWrapper = $('#customize-footer-actions .devices')
            responsiveButtonsWrapper.find( 'button' ).each(function(){
                let _this = $(this)
                _this.on("click", function(){
                    let _thisButton = $(this)
                    let currentDevice = _thisButton.data( 'device' )
                    if( [ 'tablet', 'mobile' ].includes( currentDevice ) ) {
                        normalBuilder.removeClass( 'is-active' )
                        responsiveBuilder.addClass( 'is-active' )
                    } else {
                        normalBuilder.addClass( 'is-active' )
                        responsiveBuilder.removeClass( 'is-active' )
                    }
                })
            })
        },
        addCommonBuilderClass: function( parentContainer ) {
            parentContainer.addClass( 'blogzee-builder' )
        }
    });
} )( wp.customize, jQuery );