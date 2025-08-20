/**
 * Handles widgets scripts
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
jQuery(document).ready( function($) {
    widgetAjaxUrl = widgetData.widgetAjaxUrl, widgetNonce = widgetData.widgetNonce
    function blogzee_widgets_handler() {
        // multicheckbox field
        $( ".blogzee-multicheckbox-field" ).on( "click, change", ".multicheckbox-content input", function() {
            var _this = $(this), parent = _this.parents( ".blogzee-multicheckbox-field" ), currentVal, currentFieldVal = parent.find( ".widefat" ).val();
            currentFieldVal = JSON.parse( currentFieldVal )
            currentVal = _this.val();
            if( _this.is(":checked") ) {
                if( currentFieldVal != 'null' ) {
                    currentFieldVal.push(currentVal)
                }
            } else {
                if( currentFieldVal != 'null' ) {
                    currentFieldVal.splice( $.inArray( currentVal, currentFieldVal ), 1 );
                }
            }
            parent.find( ".widefat" ).val(JSON.stringify(currentFieldVal))
        })

        // checkbox field
        $( ".blogzee-checkbox-field" ).on( "click, change", "input", function() {
            var _this = $(this)
            if( _this.is(":checked") ) {
                _this.val( "1" )
            } else {
                _this.val( "0" )
            }
        })

        // responsive number field 
        $( ".blogzee-responsive-number-field" ).on( "change", ".responsive-fields-wrapper .single-field", function() {
            var _thisField = $(this), fields = _thisField.parent().find(".single-field"), elmToStoreValue = _thisField.parents(".blogzee-responsive-number-field").find(".widefat")
            var fieldsValues = {}
            fields.each(function() {
                fieldsValues[$(this).data("device")] = $(this).val()
            })
            elmToStoreValue.val(JSON.stringify(fieldsValues))
        })

        $( ".blogzee-responsive-number-field" ).on( "click", ".responsive-devices span", function() {
            var _thisField = $(this), fieldsWrapper = _thisField.parents(".blogzee-responsive-number-field").find(".responsive-fields-wrapper")
            var currentDevice = _thisField.data("device")
            _thisField.removeClass("isActive").addClass("isActive").siblings().removeClass("isActive")
            fieldsWrapper.find( "." + currentDevice + "-field").show().siblings().hide()
            _thisField.parents(".blogzee-responsive-number-field").siblings(".blogzee-responsive-number-field").find( '.responsive-devices span[data-device="' + currentDevice + '"]' ).removeClass("isActive").addClass("isActive").siblings().removeClass("isActive")  // trigger another field responsive control
            _thisField.parents(".blogzee-responsive-number-field").siblings(".blogzee-responsive-number-field").find( '.responsive-fields-wrapper input[data-device="' + currentDevice + '"]' ).show().siblings().hide()  // trigger another field responsive control
        })
        
        // upload field
        $( ".blogzee-upload-field" ).on( "click", ".upload-trigger", function(event) {
            event.preventDefault();
            if ( frame ) {
                frame.open();
                return;
            }
            var _this = $(this), frame = wp.media({
                title: 'Select or Upload Author Image',
                button: {
                    text: 'Add Author Image'
                },
                multiple: false
            });
            frame.open();
            frame.on( 'select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                _this.toggleClass( "selected not-selected" );
                _this.next().toggleClass( "selected not-selected" );
                _this.next().find("img").attr( "src", attachment.url ).toggleClass( "nothasImage" );
                _this.siblings(".widefat").val( attachment.url ).trigger("change");
            })
        })
        // remove image
        $( ".blogzee-upload-field" ).on( "click", ".upload-buttons .remove-image", function(event) {
            event.preventDefault();
            var _this = $(this);
            _this.prev().attr( "src", "" ).toggleClass( "nothasImage" );
            _this.parent().toggleClass( "selected not-selected" ).prev().toggleClass( "selected not-selected" );
            _this.parent().next().val( "" ).trigger("change");
        })

        // icon text handler
        var iconTextContainer = $( ".blogzee-icon-text-field" )
        iconTextContainer.each(function() {
            var _this = $(this), iconSelector = _this.find( ".icon-selector-wrap" ), iconField = _this.find( ".icon-field" ), textField = _this.find( ".text-field input" )
            iconSelector.on( "click", "i", function() {
                var newIcon = $(this).attr( "class" )
                iconField.data( "value", newIcon )
                iconField.find( ".icon-selector i" ).removeClass().addClass(newIcon)
                setIconTextFieldValue(_this,iconField,textField)
            })
            textField.on( "change", function() {
                setIconTextFieldValue(_this,iconField,textField)
            })
            iconField.on( "click", function() {
                var innerThis = $(this)
                innerThis.siblings(".icon-selector-wrap" ).slideDown()
            })
        })

        // select2 field
        var selectTwoContainer = $('.blogzee-select-two-field')
        if( selectTwoContainer.length > 0 ) {
            selectTwoContainer.each(function() {
                var _this = $(this)
                var selectHandler = _this.find('select.widefat').select2({
                    dropdownCssClass: 'blogzee-select-two-dropdown',
                    multiple: true,
                    ajax: {
                        url: widgetAjaxUrl,
                        type: 'POST',
                        data: function( params ) {
                            var _this = $(this)
                            return {
                                action: 'blogzee_widget_control_get_tags_options',
                                type: _this.siblings('input[type="hidden"]').data('type'),
                                exclude: _this.siblings('input[type="hidden"]').val(),
                                search: params.term,
                                security: widgetNonce
                            }
                        },
                        processResults: function( results ) {
                            return {
                                results: results.data
                            }
                        }
                    },
                    cache: true
                })
    
                // on open
                var categories = [], tags = [], users = []
                selectHandler.on( 'select2:open', function( event ) {
                    var _thisSelectTwo = $(this)
                    var selectTwoSiblingInputValue = _thisSelectTwo.siblings('input[type="hidden"].widefat').val()
                    var selectTwoSiblingInput = _thisSelectTwo.siblings('input[type="hidden"].widefat').data('type')
                    if( selectTwoSiblingInput == 'category' ) {
                        categories = ( selectTwoSiblingInputValue != '' ) ? [selectTwoSiblingInputValue] : []
                    } else if( selectTwoSiblingInput == 'tag' ) {
                        tags = ( selectTwoSiblingInputValue != '' ) ? [selectTwoSiblingInputValue] : []
                    } else {
                        users = ( selectTwoSiblingInputValue != '' ) ? [selectTwoSiblingInputValue] : []
                    }
                })
    
                // on select
                selectHandler.on( 'select2:select', function( event ){
                    var _thisSelect = $(this)
                    var inputTypeHidden = _thisSelect.siblings('input[type="hidden"].widefat')
                    var selectTwoSiblingInputValue = _thisSelect.siblings('input[type="hidden"].widefat').val().split(',')
                    selectTwoSiblingInputValue.push( event.params.data.id )
                    // removing duplicate ids
                    var rawFilteredIds = selectTwoSiblingInputValue.filter(function( element, index, self ) {
                        return index == self.indexOf( element )
                    })
                    var filteredIds = rawFilteredIds.filter( function( index ) { 
                        return index !== ''
                    })
                    inputTypeHidden.attr('value', filteredIds )
                })
    
                // on unselect
                selectHandler.on( 'select2:unselect', function( event ){
                    var _thisUnSelect = $(this)
                    var selectTwoSiblingInputValue = _thisUnSelect.siblings('input[type="hidden"].widefat').val()
                    var selectTwoSiblingInput = _thisUnSelect.siblings('input[type="hidden"].widefat')
                    var removedElements = $.grep( selectTwoSiblingInputValue.split(','), function( key ) {
                        return key != event.params.data.id
                    })
                    selectTwoSiblingInput.attr('value', removedElements )
                })
            })
        }

        function setIconTextFieldValue(el,iconEl,txtEl) {
            el.find( 'input.widefat[type="hidden"]' ).val(JSON.stringify( {icon: iconEl.data( "value" ), title: txtEl.val()} )).trigger("change")
        }
    }
    blogzee_widgets_handler();
    
    // run on widgets added and updated
    $( document ).on( 'load widget-added widget-updated', function() {
        blogzee_widgets_handler();
    });
})