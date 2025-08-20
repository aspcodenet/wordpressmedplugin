( function( api, $ ) {
	api.controlConstructor['section-heading-toggle'] = api.Control.extend( {
		ready: function() {
			var control = this, container = control.container;
			container.on( "click", function() {
				var _this = $(this), currentTab = control.params.tab // give current tab
				_this.find(".toggle-button .dashicons").toggleClass("dashicons-arrow-down-alt2 dashicons-arrow-up-alt2")
				var sectionElements = _this.nextUntil( ".customize-control-section-heading-toggle" )
				var filteredElements = sectionElements.filter(function(){
					var _thisElement = $(this), elementId = _thisElement.attr('id')
					var removeCustomizeControlAttr = elementId.replace( 'customize-control-', '' )
					var elementsDetails = api.control( removeCustomizeControlAttr )
					if( ! elementsDetails.params.hasOwnProperty( 'tab' ) ) elementsDetails.params.tab = 'general'
					return ( elementsDetails.params.tab === currentTab )
				})
				filteredElements.slideToggle()
				filteredElements.each(function(){
					var _thisElement = $(this), elementId = _thisElement.attr('id')
					var removeCustomizeControlAttr = elementId.replace( 'customize-control-', '' )
					if( ! api.control( removeCustomizeControlAttr ).active() ) {
						_thisElement.hide()
					}
				})
			})
        }
    });
} )( wp.customize, jQuery );