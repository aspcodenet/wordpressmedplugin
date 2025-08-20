/**
 * Handles overall events and triggers for the repeater control
 * 
 * @since 1.0.0
 */
jQuery(document).ready(function($) {
    // on click outside of the element run callback function
    function blogzeeClickOutSideElm(elm, callback) {
        $(document).mouseup(function (e) {
            var container = $(elm);
            if( ! $(e.target).is('.settings-icon') ) {
                if (!container.is(e.target) && container.has(e.target).length === 0 ) {
                    callback();
                }
            }
        });
    }

    // General events handler for the control
    $( ".blogzee-repeater-control" ).each(function() {
        var container = $(this)
        container.on('click', '.alignment-field .alignment-item', function(){
            var _this = $(this)
            _this.addClass('isactive').siblings().removeClass('isactive')
            if( _this.hasClass('left') ) {
                _this.parent().siblings('input').val('left')
            } else if ( _this.hasClass('center') ) {
                _this.parent().siblings('input').val('center')
            } else {
                _this.parent().siblings('input').val('right')
            }
            repeater_value_refresh(_this);
        })

        // media control type handler
        container.on( "click", ".image-field .add-image-trigger", function(event) {
            event.preventDefault();
            if( frame ) {
                frame.open();
                return;
            }
            var _this = $(this), frame = wp.media({
                title: "Select or Upload Image",
                button: {
                    text: 'Add Image'
                },
                multiple: false
            });
            frame.open();
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                _this.slideUp().addClass("no-trigger");
                _this.next( ".repeater-field-value-holder" ).val(attachment.id);
                _this.parent().find("img").attr( "src",attachment.url);
                _this.prev().removeClass("no-image")
                _this.parents( ".blogzee-repeater-item" ).addClass("popupActive")
                _this.parents( '.item-control-fields' ).removeClass( "isHidden" ).addClass( "isShow" )
                repeater_value_refresh(_this);
            })
        })
        // remove image
        container.on( "click", ".image-field .remove-image", function(event) {
            var _this = $(this);
            _this.prev().attr( "src", "" );
            _this.parent().addClass("no-image");
            _this.parent().next().slideDown().removeClass("no-trigger");
            _this.parent().siblings( ".repeater-field-value-holder" ).val('')
            repeater_value_refresh(_this);
        })

        // fontawesome icon picker handler
        container.on( "click", ".fontawesome-icon-picker .icon-header", function() {
            var _this = $(this)
            _this.find( ".icon-list-trigger i" ).toggleClass( "fa-angle-down fa-angle-up" );
            _this.next().slideToggle();
        })

        container.on( "click", ".fontawesome-icon-picker .icons-list i", function() {
            var _this = $(this), newValue = _this.attr( "class" );
            if( ! _this.hasClass('selected') ) {
                _this.addClass( "selected" ).siblings().removeClass( "selected" );
                _this.parent().next().val( newValue );
                _this.parent().prev().find( "i" ).first().removeClass().addClass( newValue );
                _this.parents( ".blogzee-repeater-item" ).find( ".item-heading-wrap .item-heading" ).text(newValue.split("-")[1])
            }
            repeater_value_refresh(_this);
        })

        // sortable handler
        container.find( ".blogzee-repeater-control-inner" ).sortable({
            orientation: "vertical",
            items: "> .blogzee-repeater-item",
            update: function (event, ui) {
                $(this).find( " > .blogzee-repeater-item .remove-item" ).show()
                $(this).find( ".blogzee-repeater-item:first .remove-item" ).hide()
                repeater_value_refresh( $(this) );
            }
        })

        // on click display item icon
        container.on( "click", ".display-icon", function() {
            var _this = $(this);
            _this.parents('.blogzee-repeater-item').find("input[data-key='item_option']").val(function(index,current) {
                if( current === 'show' ) {
                    return 'hide';
                } else {
                    return 'show';
                }
            })
            _this.toggleClass( "dashicons-visibility dashicons-hidden" )
            _this.parents( ".blogzee-repeater-item" ).toggleClass( "not-visible visible" )
            repeater_value_refresh(_this)
        })
        
        // on click remove item button
        container.on( "click", ".remove-item", function(e) {
            e.preventDefault();
            var controller = $(this).parents( ".blogzee-repeater-control" ), toRemove = $(this).parents( ".blogzee-repeater-item" );
            toRemove.slideUp(400, function() {
                toRemove.remove();
                repeater_value_refresh(controller);
            })
        })

        // on click heading toggle content
        container.on( "click", ".blogzee-repeater-item.visible .settings-icon", function() {
            $(this).parents(".blogzee-repeater-item").siblings().removeClass("popupActive").find(".item-control-fields").removeClass("isShow").addClass("isHidden")
            $(this).parents(".blogzee-repeater-item").siblings().find( ".fontawesome-icon-picker .icons-list" ).hide()
            $(this).parents(".blogzee-repeater-item").toggleClass("popupActive")
            $(this).parents(".item-heading-wrap").next().toggleClass( "isHidden isShow" );
            $(this).parents(".item-heading-wrap").next().find( ".fontawesome-icon-picker .icons-list" ).hide();
            // close popup on outside click
            var fieldsPopup =  $(this).parents(".blogzee-repeater-item").find( ".item-control-fields.isShow" )
            blogzeeClickOutSideElm( fieldsPopup, function() {
                fieldsPopup.parents( ".blogzee-repeater-item" ).removeClass("popupActive")
                fieldsPopup.removeClass( "isShow" ).addClass( "isHidden" )
            })
        })

        // collect repeater field values
        container.on( "change keyup", ".blogzee-repeater-item .repeater-field-value-holder", function() {
            var _this = $(this)
            repeater_value_refresh(_this)
        })

        // change the position of selected icon at front
        function searchIcon(container) {
            container.find( ".fontawesome-icon-picker" ).each(function() {
                var listContainer  = $(this).find( ".icons-list" ), searchField = $(this).find( ".icon-search-input" )
                listContainer.find( "i.selected" ).insertAfter( searchField );
                // search icon with given input value
                searchField.on( "keyup", function() {
                    var toSearch = $(this).val();
                    if( toSearch ) {
                        listContainer.find( "i" ).each( function() {
                            var iconClass= $(this).attr("class")
                            if( iconClass.includes(toSearch.trim()) ) {
                                $(this).show()
                            } else {
                                $(this).hide()
                            }
                        })
                    } else {
                        listContainer.find( "i" ).show();
                    }
                })
            })
        }
        searchIcon(container)
    })

    // collect repeater control field value
    function repeater_value_refresh( _this ) {
        var controlValue = [], container =  ( _this.hasClass( "blogzee-repeater-control" ) ) ? _this : _this.parents( ".blogzee-repeater-control" );
        container.find( ".blogzee-repeater-item" ).each(function() {
            var newValue = {}
            $(this).find( ".repeater-field-value-holder" ).each(function() {
                var fieldValue, fieldName = $(this).data("key");
                if( $(this).attr("type") === 'checkbox' ) {
                    if( $(this).is(":checked") ) {
                        fieldValue = true;
                    } else {
                        fieldValue = false;
                    }
                } else {
                    fieldValue = $(this).val()
                }
                newValue[fieldName] = fieldValue
            })
            controlValue.push(newValue)
        })
        var ValueHolder = container.find( ".repeater-control-value-holder" )
        ValueHolder.val( JSON.stringify( controlValue ) ).trigger("change")
    }
})