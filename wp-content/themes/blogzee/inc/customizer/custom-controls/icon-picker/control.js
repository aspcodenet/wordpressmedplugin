( function( api, $ ) {
	api.controlConstructor['icon-picker'] = api.Control.extend( {
		ready: function() {
			var control = this, container = control.container, newValue = [];
			container.on( "click", ".button-action", function() {
				var button = $(this)
				button.addClass("active").siblings().removeClass("active")
				if( button.hasClass( 'select-upload' ) ) {
					if ( frame ) {
						frame.open();
						return;
					}
					var frame = wp.media({
						title: 'Select or Upload svg Image',
						library: {
							type: ['image/svg+xml']
						},
						button: {
							text: 'Add svg'
						},
						multiple: false
					});
					frame.open();
					frame.on( 'select', function() {
						var attachment = frame.state().get('selection').first().toJSON();
						newValue = {
							type: 'svg',
							value: attachment.id
						}
						wp.customize.instance( control.id ).set( newValue );
					})
				} else if( button.hasClass( 'select-icon' ) ) {
					container.find( ".icon-picker-modal" ).slideToggle()
				} else {
					newValue = {
						type: 'none',
						value: ''
					}
					wp.customize.instance( control.id ).set( newValue );
				}
			})
			this.triggerCloseModal(container)
			this.handleIconpicker(container,control.id)
        },
		triggerCloseModal: function(container) {
			onElementOutsideClick( container.find( ".icon-picker-modal" ), function() {
				container.find( ".icon-picker-modal" ).slideUp()
			})
		},
		handleIconpicker: function(container,control_id) {
			container.find( ".icon-picker-modal .icon-picker-list span" ).on( "click", function() {
				var _thisIcon = $(this),
				newIcon = _thisIcon.find("i").attr("class")
				container.find(".picker-buttons-wrap .select-icon i").attr("class",newIcon)
				_thisIcon.addClass("selected").siblings().removeClass("selected")
				newValue = {
					type: 'icon',
					value: newIcon
				}
				wp.customize.instance( control_id ).set( newValue );
			})

			container.on( "input", ".icon-picker-search input", function(e) {
				var iconListItems = container.find(".icon-picker-list span.icon-item")
				if( e.target.value == '' ) {
					iconListItems.show()
				} else {
					iconListItems.find( "i" ).each( function() {
						var iconClass= $(this).attr("class")
						if( iconClass.includes(e.target.value.trim()) ) {
							$(this).parent().show()
						} else {
							$(this).parent().hide()
						}
					})
				}
			})
		}
    });

	function onElementOutsideClick(currentElement, callback) {
		$(document).mouseup(function (e) {
			var container = $(currentElement);
			var excludeElement = container.siblings( '.picker-buttons-wrap' ).find('.button-action.select-icon')
			if( ! $(e.target).is( excludeElement ) && ! $(e.target).is( excludeElement.find('i') ) ) {
				if (!container.is(e.target) && container.has(e.target).length === 0 ) callback();
			}
		})
	}
} )( wp.customize, jQuery );