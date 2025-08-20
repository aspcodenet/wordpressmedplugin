/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *  
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	const { totalTags, totalCats } = blogzeePreviewObject
	const themeCalls = {
		blogzeeGenerateTypoCss: function( selector, value, isVariable ) {
			const { preset, font_family, font_weight, text_transform, text_decoration, font_size, line_height, letter_spacing } = value
			var cssCode = ''
			if( isVariable ) {
				cssCode += 'body.blogzee-variables {\n'
			} else {
				cssCode = selector + '{\n'
			}
			if( font_family ) cssCode += `${( isVariable ? `${ selector }-family` : 'font-family' )}: ${ this.blogzeeGetTypographyFormat( preset, font_family.value, '-family' ) };\n`

			if( font_weight ) cssCode += `${( isVariable ? `${ selector }-weight` : 'font-weight' )}: ${ this.blogzeeGetTypographyFormat( preset, font_weight.value, '-weight' ) };\n${( isVariable ? `${ selector }-style` : 'font-style' )}: ${ this.blogzeeGetTypographyFormat( preset, font_weight.variant, '-style' ) };\n`
			
			if( text_transform ) cssCode += `${( isVariable ? `${ selector }-texttransform` : 'text-transform' )}: ${ this.blogzeeGetTypographyFormat( preset, text_transform, '-texttransform' )};\n`

			if( text_decoration ) cssCode += `${( isVariable ? `${ selector }-textdecoration` : 'text-decoration' )}: ${ this.blogzeeGetTypographyFormat( preset, text_decoration, '-textdecoration' )};\n`

			if( font_size.desktop ) cssCode += `${( isVariable ? `${ selector }-size` : 'font-size' )}: ${ this.blogzeeGetTypographyFormat( preset, font_size.desktop, '-size' ) };\n`

			if( line_height.desktop ) cssCode += `${( isVariable ? `${ selector }-lineheight` : 'line-height' )}: ${ this.blogzeeGetTypographyFormat( preset, line_height.desktop, '-lineheight' ) };\n`

			if( letter_spacing.desktop ) cssCode += `${( isVariable ? `${ selector }-letterspacing` : 'letter-spacing' )}: ${ this.blogzeeGetTypographyFormat( preset, letter_spacing.desktop, '-letterspacing' ) };\n`
			if( ! isVariable ) cssCode += '}'

			if( ! isVariable ) cssCode += `@media(max-width: 940px) {\n${ isVariable ? 'body.blogzee-variables ' : `${ selector } ` } {\n`
			if( line_height.tablet ) cssCode += `${( isVariable ? `${ selector }-lineheight-tab` : 'line-height' )}: ${ this.blogzeeGetTypographyFormat( preset, line_height.tablet, '-lineheight-tab' ) };\n`
			if( letter_spacing.tablet ) cssCode += `${( isVariable ? `${ selector }-letterspacing-tab` : 'letter-spacing' )}: ${ this.blogzeeGetTypographyFormat( preset, letter_spacing.tablet, '-letterspacing-tab' ) };\n`
			if( font_size.tablet ) cssCode += `${( isVariable ? `${ selector }-size-tab` : 'font-size' )}: ${ this.blogzeeGetTypographyFormat( preset, font_size.tablet, '-size-tab' ) };\n`
			if( ! isVariable ) cssCode += '}}'
			
			if( ! isVariable ) cssCode += `@media(max-width: 610px) {\n${ isVariable ? 'body.blogzee-variables ' : `${ selector } ` } {\n`
			if( line_height.smartphone ) cssCode += `${( isVariable ? `${ selector }-lineheight-mobile` : 'line-height' )}: ${ this.blogzeeGetTypographyFormat( preset, line_height.smartphone, '-lineheight-mobile' ) };\n`
			if( letter_spacing.smartphone ) cssCode += `${( isVariable ? `${ selector }-letterspacing-mobile` : 'letter-spacing' )}: ${ this.blogzeeGetTypographyFormat( preset, letter_spacing.smartphone, '-letterspacing-mobile' ) };\n`
			if( font_size.smartphone ) cssCode += `${( isVariable ? `${ selector }-size-mobile` : 'font-size' )}: ${ this.blogzeeGetTypographyFormat( preset, font_size.smartphone, '-size-mobile' ) };\n`
			if( ! isVariable ) cssCode += '}}'

			if( isVariable ) cssCode += '}'

			return cssCode
		},
		blogzeeGenerateStyleTag: function( code, id ) {
			if( code ) {
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id ).html( code )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + code + '</style>' )
				}
			} else {
				$( "head #" + id ).remove()
			}
		},
		blogzeeGetTypographyFormat: function( preset, value, suffix ) {
			if( preset === '-1' ) {
				let unitsArray = [ '-size', '-lineheight', '-letterspacing', '-lineheight-tab', '-letterspacing-tab', '-size-tab', '-lineheight-mobile', '-letterspacing-mobile', '-size-mobile' ]
				return ( unitsArray.includes( suffix ) ) ? value + 'px' : value;
			} else {
				let variable = 'var(--blogzee-global-preset-typography-' + ( parseInt( preset ) + 1 ) + '-font' + suffix + ')';
				return variable
			}
		}
	}

	// typography preset
	wp.customize( 'typography_presets', function( value ) {
		value.bind( function(to) {
			const { typographies, labels } = to
			typographies.forEach(( typography, index ) => {
				ajaxFunctions.typoFontsEnqueue( typography )
				let variable = '--blogzee-global-preset-typography-';
               	let count = index + 1;
               	variable += count + '-font';
				cssCode = themeCalls.blogzeeGenerateTypoCss( variable, typography, true )
				themeCalls.blogzeeGenerateStyleTag( cssCode, 'blogzee-typography-preset-' + count )
			})
		});
	});

	// theme color bind changes
	wp.customize( 'theme_color', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-color-style', '--blogzee-global-preset-theme-color')
		});
	});

	// gradient theme color bind changes
	wp.customize( 'gradient_theme_color', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-1-style', '--blogzee-global-preset-gradient-theme-color')
		});
	});

	// solid color presets
	wp.customize( 'solid_color_preset', function( value ) {
		value.bind( function( to ) {
			const { active_palette: activePaletteIndex, color_palettes: colorPalettes } = to
			const ACTIVEPALETTE = colorPalettes[ activePaletteIndex ]
			helperFunctions.bulkGenerateStyle( ACTIVEPALETTE, 'blogzee-solid-presets', '--blogzee-global-preset-color-' )
		});
	});

	// gradient color presets
	wp.customize( 'gradient_color_preset', function( value ) {
		value.bind( function( to ) {
			const { active_palette: activePaletteIndex, color_palettes: colorPalettes } = to
			const ACTIVEPALETTE = colorPalettes[ activePaletteIndex ]
			helperFunctions.bulkGenerateStyle( ACTIVEPALETTE, 'blogzee-gradient-presets', '--blogzee-global-preset-gradient-' )
		});
	});

	// single post related articles title option
	wp.customize( 'single_post_related_posts_title', function( value ) {
		value.bind( function(to) {
			if( $( ".single-related-posts-section-wrap" ).find('.blogzee-block-title span:not(.divider)').length > 0 ) {
				$( ".single-related-posts-section-wrap" ).find('.blogzee-block-title span:not(.divider)').text( to )
			} else {
				$( ".single-related-posts-section-wrap .single-related-posts-section" ).prepend('<h2 class="blogzee-block-title"><span class="divider"></span><span>'+ to +'</span></h2>')
			}
		});
	});

	// blog description
	wp.customize( 'blogdescription_option', function( value ) {
		value.bind(function(to) {
			if( to ) {
				$( '.site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		})
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			var cssCode = '.blogzee-light-mode .site-header .site-title a { color: '+ to +' }'
			themeCalls.blogzeeGenerateStyleTag( cssCode, 'blogzee-site-title' )
		} );
	});

	// site title hover color
	wp.customize( 'site_title_hover_textcolor', function( value ) {
		value.bind( function( to ) {
			var cssCode = '.blogzee-light-mode .site-header .site-title a:hover { color: '+ to +' }'
			themeCalls.blogzeeGenerateStyleTag( cssCode, 'blogzee-site-title-hover' )
		} );
	});

	// site description color
	wp.customize( 'site_description_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).css( {
				color: to,
			});
		} );
	});

	// single post related articles title option
	wp.customize( 'stt_text', function( value ) {
		value.bind( function(to) {
			if( $( ".blogzee-scroll-btn" ).find('.icon-text').length > 0 ) {
				$( ".blogzee-scroll-btn" ).find('.icon-text').text( to )
			} else {
				$( ".blogzee-scroll-btn .scroll-top-wrap" ).prepend('<span class="icon-text">'+ to +'</span>')
			}
		});
	});

	if( totalCats.length ) {
		totalCats.forEach(function( termId ) {
			wp.customize( `category_${ termId }_color`, function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += `body .post-categories .cat-item.cat-${ termId } a, body.archive.category.category-${ termId } #blogzee-main-wrap .page-header .blogzee-container i { color : ${ blogzee_get_color_format( initial[ initial.type ] ) } } `
					}
					if( hover ) {
						cssCode += `body .post-categories .cat-item.cat-${ termId } a:hover, body.archive.category.category-${ termId } #blogzee-main-wrap .page-header .blogzee-container i:hover { color : ${ blogzee_get_color_format( hover[ hover.type ] ) } } `
					}
					themeCalls.blogzeeGenerateStyleTag( cssCode, `blogzee-category-${ termId }-style` )
				})
			})
			wp.customize( `category_background_${ termId }_color`, function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += `body .post-categories .cat-item.cat-${ termId } a, body.archive.category.category-${ termId } #blogzee-main-wrap .page-header .blogzee-container i { background : ${ blogzee_get_color_format( initial[ hover.type ] ) } }`
					}
					if( hover ) {
						cssCode += `body .post-categories .cat-item.cat-${ termId } a:hover, body.archive.category.category-${ termId } #blogzee-main-wrap .page-header .blogzee-container i:hover { background : ${ blogzee_get_color_format( hover[ hover.type ] ) } }`
					}
					themeCalls.blogzeeGenerateStyleTag( cssCode, `blogzee-category-background-${ termId }-style` )
				})
			})
		})
	}
	
	if( totalTags.length ) {
		totalTags.forEach(function( termId ) {
			wp.customize( `tag_${ termId }_color`, function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += `body .tags-wrap .tags-item.tag-${ termId } span { color : ${ blogzee_get_color_format( initial[ hover.type ] ) } }`
					}
					if( hover ) {
						cssCode += `body .tags-wrap .tags-item.tag-${ termId }:hover span { color : ${ blogzee_get_color_format( hover[ hover.type ] ) } }`
					}
					themeCalls.blogzeeGenerateStyleTag( cssCode, `blogzee-tag-${ termId }-style` )
				})
			})
			wp.customize( `tag_background_${ termId }_color`, function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					const { initial, hover } = to
					if( initial ) {
						cssCode += `body .tags-wrap .tags-item.tag-${ termId } { background : ${ blogzee_get_color_format( initial[ initial.type ] ) } }`
					}
					if( hover ) {
						cssCode += `body .tags-wrap .tags-item.tag-${ termId }:hover { background : ${ blogzee_get_color_format( hover[ hover.type ] ) } }`
					}
					themeCalls.blogzeeGenerateStyleTag( cssCode, `blogzee-tag-background-${ termId }-style` )
				})
			})
		})
	}

	// custom button label
	wp.customize( 'custom_button_label', function( value ) {
		value.bind( function( to ) {
			if( $( "#masthead .header-custom-button-wrapper" ).find('.custom-button-label').length > 0 ) {
				$( "#masthead .header-custom-button-wrapper" ).find('.custom-button-label').text( to )
			} else {
				$( "#masthead .header-custom-button-wrapper .header-custom-button" ).append('<span class="custom-button-label">'+ to +'</span>')
			}
		})
	})

	// category collection number of columns
	wp.customize( 'category_collection_number_of_columns', function( value ) {
		value.bind( function( to ) {
			if( to.desktop ) {
				$("#blogzee-category-collection-section").removeClass( "column--one column--two column--three column--four column--five" )
				$("#blogzee-category-collection-section").addClass( "column--" + blogzee_get_numeric_string( to.desktop ) )
			}
			if( to.tablet ) {
				$("#blogzee-category-collection-section").removeClass( "tab-column--one tab-column--two tab-column--three tab-column--four tab-column--five" )
				$("#blogzee-category-collection-section").addClass( "tab-column--" + blogzee_get_numeric_string( to.tablet ) )
			}
			if( to.smartphone ) {
				$("#blogzee-category-collection-section").removeClass( "mobile-column--one mobile-column--two mobile-column--three mobile-column--four mobile-column--five" )
				$("#blogzee-category-collection-section").addClass( "mobile-column--" + blogzee_get_numeric_string( to.smartphone ) )
			}
		})
	})

	// cursor animation
	wp.customize( 'cursor_animation', function( value ) {
		value.bind( function(to) {
			if( to != 'none' ) {
				$('body .blogzee-cursor').removeClass( 'type--two' ).addClass( 'type--' + to )
			} else {
				$('body .blogzee-cursor').removeClass( 'type--two' )
			}
		});
	});

	// you may have missed no of columns
	wp.customize( 'you_may_have_missed_no_of_columns', function( value ) {
		value.bind( function(to) {
			$('#blogzee-you-may-have-missed-section').removeClass( 'no-of-columns--two no-of-columns--three no-of-columns--four' ).addClass( 'no-of-columns--' + blogzee_get_numeric_string( parseInt(to) ) )
		});
	});

	// you may have missed section title option
	wp.customize( 'you_may_have_missed_title_option', function( value ) {
		value.bind( function(to) {
			if( $( "#blogzee-you-may-have-missed-section" ).find('.section-title').length > 0 ) {
				if( to ){
					$('#blogzee-you-may-have-missed-section .section-title').show()
				} else {
					$('#blogzee-you-may-have-missed-section .section-title').hide()
				}
			} else {
				var sectionTitleControl = wp.customize.instance('you_may_have_missed_title').get();
				$( "#blogzee-you-may-have-missed-section .blogzee-you-may-missed-inner-wrap" ).prepend('<div class="blogzee-block-title">'+ sectionTitleControl +'</div>')
			}
		});
	});

	// you may have missed section title
	wp.customize( 'you_may_have_missed_title', function( value ) {
		value.bind( function(to) {
			if( $( "#blogzee-you-may-have-missed-section" ).find('.section-title').length > 0 ) {
				$( "#blogzee-you-may-have-missed-section" ).find('.section-title .title').text( to )
			} else {
				$( "#blogzee-you-may-have-missed-section .blogzee-you-may-missed-inner-wrap" ).prepend('<div class="section-title"><span class="divider"></span><span class="title">'+ to +'</span></div>')
			}
		});
	})

	// canvas menu position
	wp.customize( 'canvas_menu_position', function( value ) {
		value.bind( function( to ) {
			if( to == 'right' ) {
				$('body').removeClass('blogzee-canvas-position--left').addClass('blogzee-canvas-position--right')
			} else {
				$('body').removeClass('blogzee-canvas-position--right').addClass('blogzee-canvas-position--left')
			}
		})
	})

	// Site Background Animation
	wp.customize( 'site_background_animation', function( value ) {
		value.bind( function( to ) {
			let prefix = 'background-animation--'
			$( 'body' ).removeClass( `${ prefix }none ${ prefix }two` ).addClass( `${ prefix }${ to }` )
			if( $( '.blogzee-background-animation' ).length <= 0 ) {
				let arr = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ],
					html = arr.map(() => {
						return '<span class="item"></span>';
					}).join('');

				$( 'body #page.site' ).append( `<div class="blogzee-background-animation">${ html }</div>` )
			}
		})
	})

	// post format
	var postFormatIds = { 
		'standard': 'standard_post_format_icon_picker',
		'audio': 'audio_post_format_icon_picker',
		'gallery': 'gallery_post_format_icon_picker',
		'image': 'image_post_format_icon_picker',
		'quote': 'quote_post_format_icon_picker',
		'video': 'video_post_format_icon_picker' 
	}
	Object.entries( postFormatIds ).map(( [ currentKey, currentValue ] ) => {
		wp.customize( currentValue, function( value ) {
			value.bind( function(to) {
				if( to.type == 'none' ) {
					$( 'article.format-'+ currentKey +' .post-format-ss-wrap .post-format-icon' ).hide()
				} else {
					$( 'article.format-'+ currentKey +' .post-format-ss-wrap .post-format-icon' ).show()
				}
			});
		});
	})

	// check if string is variable and formats 
	function blogzee_get_color_format( color ) {
		if( color === null ) return color
		if( color.includes('--blogzee-global-preset-') ) {
			return ( 'var('+ color +')' )
		} else {
			return color
		}
	}

	function blogzee_get_background_style( control ) {
	   	if( control ) {
			var cssCode = '', mediaUrl = '', repeat = '', position = '', attachment = '', size = ''
			switch( control.type ) {
			case 'image' : 
			 		if( 'id' in control.image ) mediaUrl = 'background-image: url(' + control.image.url + ');'
					if( 'repeat' in control ) repeat = " background-repeat: "+ control.repeat + ';'
					if( 'position' in control ) position = " background-position: "+ control.position + ';'
					if( 'attachment' in control ) attachment = " background-attachment: "+ control.attachment + ';'
					if( 'size' in control ) size = " background-size: "+ control.size + ';'
					return cssCode.concat( mediaUrl, repeat, position, attachment, size )
				break;
			default: 
			if( 'type' in control ) return "background: " + blogzee_get_color_format( control[control.type] )
		  }
		}
	}

	// converts integer to string for attibutes value 
	function blogzee_get_numeric_string(int) {
		switch( int ) {
			case 2:
				return "two";
				break;
			case 3:
				return "three";
				break;
			case 4:
				return "four";
				break;
			case 5:
				return "five";
				break;
			case 6:
				return "six";
				break;
			case 7:
				return "seven";
				break;
			case 8:
				return "eight";
				break;
			case 9:
				return "nine";
				break;
			case 10:
				return "ten";
				break;
			default:
				return "one";
		}
	}

	// constants
	const ajaxFunctions = {
		typoFontsEnqueue: function( typography ) {
			const { font_family, font_weight } = typography
			let linkTag = document.getElementById('blogzee-generated-typo-fonts')
			let googleFontsUrl = 'https://fonts.googleapis.com/css2?'
			let googleFontsUrlQuery
			let fontStyle = ( font_weight.variant === 'italic' ) ? 'ital,wght@' : 'wght@'
			if( linkTag !== null ) {
				let parser = new URL( linkTag.href )
				let query = parser.search
				let toAppend = parseTheFontsQuery( query, typography )
				linkTag.href = googleFontsUrl + toAppend
			} else {
				let newLinkTag = document.createElement('link')
				newLinkTag.rel = 'stylesheet'
				newLinkTag.id = 'blogzee-generated-typo-fonts'
				googleFontsUrlQuery = 'family=' + font_family.value + ':' + fontStyle + font_weight.value
				newLinkTag.href = googleFontsUrl + googleFontsUrlQuery
				document.head.appendChild( newLinkTag );
			}
		}
	}

	/**
     * Append new font family 
     * 
     * @since 1.0.0
     */
    const parseTheFontsQuery = ( query, typography ) => {
        const { font_weight:WEIGHT, font_family:FAMILY } = typography
        let toParse = query
        let removeQuestionMark = toParse.replaceAll( '?', '' )
        let filteredQuery = removeQuestionMark.replaceAll( '&', '' )
        let fontFamilyQuery = filteredQuery.split( 'family=' )
        let fontStyleProperty = WEIGHT.variant === 'italic' ? 'ital' : 'wght'
        var fontFamily = [ FAMILY.value ], fontWeight = { [FAMILY.value]: [ WEIGHT.value ] }, fontStyle = { [FAMILY.value]: [ fontStyleProperty ]}
		let filteredFamily = fontFamily.map(( current ) => {
			return current.replaceAll( '%20', ' ' )
		})
        fontFamilyQuery.forEach(( current ) => {
            if( current !== '' ) {
                let splitFamily = current.split( ':' )
                let family = splitFamily[0]
                if ( ! filteredFamily.includes( family ) ) filteredFamily.push( family );
                let splitWeightAndStyle = splitFamily[1].split('@')
                let weight = splitWeightAndStyle[1].replaceAll( '0,', '' ).replaceAll( '1,', '' ).replaceAll( ',', '' )
                let style = splitWeightAndStyle[0]
                if ( ! fontWeight[family] ) fontWeight[family] = []
                if ( ! fontStyle[family] ) fontStyle[family] = []
                if ( ! fontStyle[family].includes( style ) ) fontStyle[family].push( ...style.split(',') );
				
                if ( ! fontWeight[family].includes( weight ) ) fontWeight[family].push( ...weight.split(';') );
            }
        })
        let toAppend = filteredFamily.map(( family ) => {
			let sortedWeights = fontWeight[family].sort(( first, second ) => { return first - second })
			let duplicateRemovedWeights =  [ ...new Set( sortedWeights ) ]	//weights
			let duplicateRemovedStyles =  [ ...new Set( fontStyle[family] ) ]	// styles
			var structuredFontStyles, temporaryStyles = []
			if( duplicateRemovedStyles.includes( 'ital' ) ) {
				duplicateRemovedWeights.forEach(( current ) => { 
					if( current !== undefined && current !== '' ) temporaryStyles.push( '0,' + current + ';' )
				})
				duplicateRemovedWeights.forEach(( current, index ) => { 
					if( current !== undefined && current !== '' ) temporaryStyles.push( '1,' + current + ( index + 1 === duplicateRemovedWeights.length ? '' : ';' ) )
				})
				structuredFontStyles = temporaryStyles.join('')
			} else {
				structuredFontStyles = duplicateRemovedWeights.join(';')
			}
            return 'family=' + family + ':' + duplicateRemovedStyles.sort() + '@' + structuredFontStyles
        }).join('&')
        return toAppend;
    }

	// constants
	const helperFunctions = {
		generateStyle: function(color, id, variable) {
			if(color) {
				if( id === 'theme-color-style' ) {
					var styleText = 'body { ' + variable + ': ' + color + '}';
				} else {
					var styleText = 'body { ' + variable + ': ' + blogzee_get_color_format( color ) + '}';
				}
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id).text( styleText )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + styleText + '</style>' )
				}
			}
		},
		bulkGenerateStyle: function( colors, id, variablePrefix ) {
			if( colors.length > 0 ) {
				let styleText = 'body {'
				colors.forEach(( color, index ) => {
					let count = index + 1
					styleText += variablePrefix + count + ': ' + color + ';'
				})
				styleText += '}'
				
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id).text( styleText )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + styleText + '</style>' )
				}
			}
		}
	}

	class BlogzeeCustomize {

		/**
		 * Method that gets called when class is instantiated
		 * 
		 * @since 1.0.0
		 */
		constructor() {
			this.preview();
		}

		/**
		 * Set suffix in given id
		 * 
		 * @since 1.0.0
		 */
		setSuffix = ( id, suffix, property = '' ) => {
			if( property != '' ) {
				return id + '-' + suffix + '+' + property
			} else {
				return id + '-' + suffix
			}
		}

		/**
		 * checks if the given string is class or css variable
		 * 
		 * @since 1.0.0
		 */
		isVariable = ( selector ) => {
			let mainSelector = selector
			if( typeof selector == 'object' ) {
				mainSelector = selector['selector']
			}
			if( mainSelector.length < 10 ) return false;
			let prefix = mainSelector.slice( 0, 9 )
			if( prefix == '--blogzee' ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Returns list of all typography controls id and selectors 
		 * 
		 * @since 1.0.0
		 */	
		_getTypography = () => {
			let suffix = 'typography'

			return {
				// variable
				[ this.setSuffix( 'global_button_typo' , suffix) ] : '--blogzee-readmore-font',
				[ this.setSuffix( 'site_title_typo' , suffix) ] : '--blogzee-site-title',
				[ this.setSuffix( 'site_description_typo' , suffix) ] : '--blogzee-site-description',
				[ this.setSuffix( 'custom_button_text_typography' , suffix) ] : '--blogzee-custom-button',
				[ this.setSuffix( 'main_menu_typo' , suffix) ] : '--blogzee-menu',
				[ this.setSuffix( 'footer_menu_typography' , suffix) ] : '--blogzee-footer-menu',
				[ this.setSuffix( 'date_time_typography' , suffix) ] : '--blogzee-date-time',
				[ this.setSuffix( 'main_menu_sub_menu_typo' , suffix) ] : '--blogzee-submenu',
				[ this.setSuffix( 'archive_title_typo' , suffix) ] : '--blogzee-post-title-font',
				[ this.setSuffix( 'archive_excerpt_typo' , suffix) ] : '--blogzee-post-content-font',
				[ this.setSuffix( 'archive_category_typo' , suffix) ] : '--blogzee-category-font',
				[ this.setSuffix( 'archive_date_typo' , suffix) ] : '--blogzee-date-font',
				[ this.setSuffix( 'archive_author_typo' , suffix) ] : '--blogzee-author-font',
				[ this.setSuffix( 'archive_read_time_typo' , suffix) ] : '--blogzee-readtime-font',
				[ this.setSuffix( 'archive_comment_typo' , suffix) ] : '--blogzee-comment-font',
				[ this.setSuffix( 'category_collection_typo' , suffix) ] : '--blogzee-category-collection-font',
				[ this.setSuffix( 'you_may_have_missed_design_section_title_typography' , suffix) ] : '--blogzee-youmaymissed-block-title-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_title_typography' , suffix) ] : '--blogzee-youmaymissed-title-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_categories_typography' , suffix) ] : '--blogzee-youmaymissed-category-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_date_typography' , suffix) ] : '--blogzee-youmaymissed-date-font',
				[ this.setSuffix( 'you_may_have_missed_design_post_author_typography' , suffix) ] : '--blogzee-youmaymissed-author-font',
				[ this.setSuffix( 'sidebar_block_title_typography' , suffix) ] : '--blogzee-widget-block-font',
				[ this.setSuffix( 'sidebar_post_title_typography' , suffix) ] : '--blogzee-widget-title-font',
				[ this.setSuffix( 'sidebar_category_typography' , suffix) ] : '--blogzee-widget-category-font',
				[ this.setSuffix( 'sidebar_date_typography' , suffix) ] : '--blogzee-widget-date-font',
				[ this.setSuffix( 'sidebar_date_typography' , suffix) ] : '--blogzee-widget-date-font',
				[ this.setSuffix( 'main_banner_design_post_title_typography' , suffix) ] : '--blogzee-banner-title-font',
				[ this.setSuffix( 'main_banner_design_post_excerpt_typography' , suffix) ] : '--blogzee-banner-excerpt-font',
				// classes
				[ this.setSuffix( 'breadcrumb_typo', suffix ) ] : 'body .blogzee-breadcrumb-wrap ul li span[itemprop="name"]',
				[ this.setSuffix( 'archive_category_info_box_title_typo', suffix ) ] : 'body.blogzee-variables.archive.category .page-header .page-title, .archive.date .page-header .page-title',
				[ this.setSuffix( 'archive_category_info_box_description_typo', suffix ) ] : 'body.blogzee-variables.archive.category .page-header .archive-description',
				[ this.setSuffix( 'archive_tag_info_box_title_typo', suffix ) ] : 'body.blogzee-variables.archive.tag .page-header .page-title',
				[ this.setSuffix( 'archive_tag_info_box_description_typo', suffix ) ] : 'body.blogzee-variables.archive.tag .page-header .archive-description',
				[ this.setSuffix( 'archive_author_info_box_title_typo', suffix ) ] : 'body.blogzee-variables.archive.author .page-header .page-title',
				[ this.setSuffix( 'archive_author_info_box_description_typo', suffix ) ] : 'body.blogzee-variables.archive.author .page-header .archive-description',
				[ this.setSuffix( 'single_title_typo', suffix ) ] : 'body.single-post.blogzee-variables .site-main article .entry-title, body.single-post.blogzee-variables .single-header-content-wrap .entry-title, body.single-post #primary .post-navigation .nav-links .nav-title, body .single-related-posts-section-wrap.layout--list .single-related-posts-wrap article .post-element .post-title',
				[ this.setSuffix( 'single_content_typo', suffix ) ] : 'body.single-post.blogzee-variables .site-main article .entry-content',
				[ this.setSuffix( 'single_category_typo', suffix ) ] : 'body.single-post.blogzee-variables #primary article .post-categories .cat-item a, body.single-post.blogzee-variables .single-header-content-wrap .post-categories .cat-item a',
				[ this.setSuffix( 'single_date_typo', suffix ) ] : 'body.single-post.blogzee-variables .blogzee-main-wrap .blogzee-inner-content-wrap .post-date, body.single-post.blogzee-variables .single-header-content-wrap.post-meta .post-date',
				[ this.setSuffix( 'single_author_typo', suffix ) ] : 'body.single-post.blogzee-variables .site-main article .post-meta-wrap .byline, body.single-post.blogzee-variables .single-header-content-wrap .post-meta-wrap .byline, body .single-related-posts-section-wrap .single-related-posts-wrap .byline',
				[ this.setSuffix( 'single_read_time_typo', suffix ) ] : 'body.single-post.blogzee-variables .blogzee-main-wrap .post-meta .post-read-time, body.single-post.blogzee-variables .blogzee-main-wrap .post-meta .post-comments-num',
				[ this.setSuffix( 'page_title_typo', suffix ) ] : 'body.page.blogzee-variables #blogzee-main-wrap #primary article .entry-title',
				[ this.setSuffix( 'page_content_typo', suffix ) ] : 'body.page.blogzee-variables article .entry-content',
				[ this.setSuffix( 'main_banner_design_post_categories_typography', suffix ) ] : '.blogzee-main-banner-section .main-banner-slider .post-categories .cat-item a',
				[ this.setSuffix( 'main_banner_design_post_date_typography', suffix ) ] : 'body.blogzee-variables .blogzee-main-banner-section .main-banner-wrap .post-elements .post-date',
				[ this.setSuffix( 'main_banner_design_post_author_typography', suffix ) ] : 'body.blogzee-variables .blogzee-main-banner-section .main-banner-wrap .byline',
				[ this.setSuffix( 'main_banner_sidebar_block_typography', suffix ) ] : '--blogzee-banner-sidebar-block-font',
				[ this.setSuffix( 'main_banner_sidebar_post_typography', suffix ) ] : '--blogzee-banner-sidebar-title-font',
				[ this.setSuffix( 'main_banner_sidebar_categories_typography', suffix ) ] : 'body .scrollable-posts-wrapper .post-categories li a',
				[ this.setSuffix( 'main_banner_sidebar_date_typography', suffix ) ] : 'body .scrollable-posts-wrapper .post-date',
				[ this.setSuffix( 'carousel_design_post_title_typography', suffix ) ] : 'body.blogzee-variables .blogzee-carousel-section .carousel-wrap .post-elements .post-title',
				[ this.setSuffix( 'carousel_design_post_categories_typography', suffix ) ] : 'body.blogzee-variables .blogzee-carousel-section .post-categories .cat-item a',
				[ this.setSuffix( 'carousel_design_post_date_typography', suffix ) ] : 'body.blogzee-variables .blogzee-carousel-section .carousel-wrap .post-elements .post-date',
				[ this.setSuffix( 'carousel_design_post_author_typography', suffix ) ] : '.blogzee-variables .blogzee-carousel-section .carousel-wrap .post-elements .byline a',
				[ this.setSuffix( 'carousel_design_post_excerpt_typography', suffix ) ] : 'body.blogzee-variables .blogzee-carousel-section .carousel-wrap .post-elements .post-excerpt .excerpt-content',
				[ this.setSuffix( 'heading_one_typo', suffix ) ] : 'body article .post-inner h1',
				[ this.setSuffix( 'heading_two_typo', suffix ) ] : 'body article .post-inner h2',
				[ this.setSuffix( 'heading_three_typo', suffix ) ] : 'body article .post-inner h3',
				[ this.setSuffix( 'heading_four_typo', suffix ) ] : 'body article .post-inner h4',
				[ this.setSuffix( 'heading_five_typo', suffix ) ] : 'body article .post-inner h5',
				[ this.setSuffix( 'heading_six_typo', suffix ) ] : 'body article .post-inner h6',
				[ this.setSuffix( 'sidebar_heading_one_typography', suffix ) ] : 'body aside h1.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_two_typo', suffix ) ] : 'body aside h2.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_three_typo', suffix ) ] : 'body aside h3.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_four_typo', suffix ) ] : 'body aside h4.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_five_typo', suffix ) ] : 'body aside h5.wp-block-heading',
				[ this.setSuffix( 'sidebar_heading_six_typo', suffix ) ] : 'body aside h6.wp-block-heading',
				[ this.setSuffix( 'sidebar_pagination_button_typo', suffix ) ] : 'body .blogzee-widget-loader .load-more',
				[ this.setSuffix( 'footer_title_typography', suffix ) ] : 'body footer .widget_block .wp-block-group__inner-container .wp-block-heading, body footer section.widget .widget-title, body footer .wp-block-heading',
				[ this.setSuffix( 'footer_text_typography', suffix ) ] : 'body footer ul.wp-block-latest-posts a, body footer ol.wp-block-latest-comments li footer, body footer ul.wp-block-archives a, body footer ul.wp-block-categories a, body footer ul.wp-block-page-list a, body footer .widget_blogzee_post_grid_widget .post-grid-wrap .post-title, body footer .menu .menu-item a, body footer .widget_blogzee_category_collection_widget .categories-wrap .category-item .category-name, body footer .widget_blogzee_post_list_widget .post-list-wrap .post-title a',
				[ this.setSuffix( 'bottom_footer_text_typography', suffix ) ] : 'body footer .site-info',
				[ this.setSuffix( 'bottom_footer_link_typography', suffix ) ] : 'body footer .site-info a',
				[ this.setSuffix( 'ticker_news_post_title_typo', suffix ) ] : '.blogzee-ticker-news .title-wrap .post-title a',
				[ this.setSuffix( 'ticker_news_post_date_typo', suffix ) ] : '.blogzee-ticker-news .title-wrap .post-date a',
			}	
		};	// End of _getTypography method

		/**
		 * Returns a list of color control ids and its related selector
		 * 
		 * @since 1.0.0
		 */
		_getColor = () => {
			let suffix = 'color'
			let property = 'background'

			return {
				[ this.setSuffix( 'date_color', suffix ) ]: '--blogzee-date-color',
				[ this.setSuffix( 'time_color', suffix ) ]: '--blogzee-time-color',
				[ this.setSuffix( 'social_icon_color', suffix ) ]: '--blogzee-header-social-color',
				[ this.setSuffix( 'footer_social_icon_color', suffix ) ]: '--blogzee-footer-social-color',
				[ this.setSuffix( 'header_menu_color', suffix ) ]: '--blogzee-menu-color',
				[ this.setSuffix( 'footer_menu_color', suffix ) ]: '--blogzee-footer-menu-color',
				[ this.setSuffix( 'mobile_canvas_icon_color', suffix ) ]: '--blogzee-mobile-canvas-icon-color',
				[ this.setSuffix( 'header_sub_menu_color', suffix ) ]: '--blogzee-menu-color-submenu',
				[ this.setSuffix( 'search_icon_color', suffix ) ]: '--blogzee-search-icon-color',
				[ this.setSuffix( 'theme_mode_dark_icon_color', suffix ) ]: '--blogzee-theme-darkmode-color',
				[ this.setSuffix( 'theme_mode_light_icon_color', suffix ) ]: '--blogzee-theme-mode-color',
				[ this.setSuffix( 'canvas_menu_icon_color', suffix ) ]: '--blogzee-canvas-icon-color',
				[ this.setSuffix( 'header_custom_button_background_color_group', suffix ) ]: '--blogzee-custom-button-bk-color',
				// all background
				[ this.setSuffix( 'header_builder_background', suffix, property ) ]: 'body.blogzee-light-mode .site-header',
			}
		}

		/**
		 * Returns all checkbox controls id and selectors
		 * 
		 * @since 1.0.0
		 */
		_getCheckbox = () => {
			let suffix = 'checkbox'
			let property = 'hide-on-mobile'

			return {
				// front sections
				[ this.setSuffix( 'show_main_banner_excerpt_mobile_option', suffix, property ) ] : '#blogzee-main-banner-section .post-excerpt',
				[ this.setSuffix( 'show_carousel_banner_excerpt_mobile_option', suffix, property ) ] : '#blogzee-carousel-section .post-excerpt',
				// archive
				[ this.setSuffix( 'show_readtime_mobile_option', suffix, property ) ] : 'body.blog .blogzee-article-inner .post-meta .post-read-time, body.archive .blogzee-article-inner .post-meta .post-read-time, body.home .blogzee-article-inner .post-meta .post-read-time, body.search .blogzee-article-inner .post-meta .post-read-time',
				[ this.setSuffix( 'show_comment_number_mobile_option', suffix, property ) ] : 'body.blog .blogzee-article-inner .post-meta .post-comments-num, body.archive .blogzee-article-inner .post-meta .post-comments-num, body.home .blogzee-article-inner .post-meta .post-comments-num, body.search .blogzee-article-inner .post-meta .post-comments-num',
				// global
				[ this.setSuffix( 'show_background_animation_on_mobile', suffix, property ) ] : 'body .blogzee-background-animation',
				[ this.setSuffix( 'show_scroll_to_top_on_mobile', suffix, property ) ] : 'body #blogzee-scroll-to-top',
				/* Header sticky */
				[ this.setSuffix( 'header_first_row_header_sticky', suffix, 'row-sticky' ) ]: 'body .site-header .row-one',
				[ this.setSuffix( 'header_second_row_header_sticky', suffix, 'row-sticky' ) ]: 'body .site-header .row-two',
				[ this.setSuffix( 'header_third_row_header_sticky', suffix, 'row-sticky' ) ]: 'body .site-header .row-three'
			}
		}

		/**
		 * Returns all spacing controls with its id and selector
		 * 
		 * @since 1.0.0
		 */
		_getSpacing = () => {
			let suffix = 'spacing'
			let property = 'padding'
   
			return {
				// border-radius
				[ this.setSuffix( 'carousel_image_border_radius', suffix, 'border-radius' ) ] : '.blogzee-carousel-section article.post-item .post-thumb',
				[ this.setSuffix( 'you_may_have_missed_image_border_radius', suffix, 'border-radius' ) ] : '.blogzee-you-may-have-missed-section .post-thumbnail-wrapper',
				/* Header Builder Row Spacings */
				[ this.setSuffix( 'header_first_row_padding', suffix, property ) ]: 'body .site-header .row-one',
				[ this.setSuffix( 'header_second_row_padding', suffix, property ) ]: 'body .site-header .row-two',
				[ this.setSuffix( 'header_third_row_padding', suffix, property ) ]: 'body .site-header .row-three',
				/* Footer Builder Row Spacings */
				[ this.setSuffix( 'footer_first_row_padding', suffix, property ) ]: 'body .site-footer .row-one',
				[ this.setSuffix( 'footer_second_row_padding', suffix, property ) ]: 'body .site-footer .row-two',
				[ this.setSuffix( 'footer_third_row_padding', suffix, property ) ]: 'body .site-footer .row-three',
			}
		}	// End of _getSpacing() Method

		/**
		 * Returns all responsive number controls with its id and its related selectors
		 * 
		 * @since 1.0.0
		 */
		_getResponsiveNumber = () => {
			let suffix = 'responsiveNumber'
			let property = 'width'

			return {
				[ this.setSuffix( 'site_logo_width', suffix, property ) ] : 'body .site-branding img',
				[ this.setSuffix( 'theme_mode_icon_size', suffix, [ property, 'font-size' ] ) ] : 'body .site-header .mode-toggle img, body .site-header .mode-toggle i',
				[ this.setSuffix( 'ticker_news_border_radius', suffix, 'border-radius' ) ]: '.blogzee-ticker-news .row, .blogzee-ticker-news .ticker-news-wrap .ticker-item .post-thumb',
				[ this.setSuffix( 'main_banner_border_radius', suffix, 'border-radius' ) ] : '.blogzee-main-banner-section.layout--four .scrollable-post, .blogzee-main-banner-section .main-banner-sidebar .scrollable-post .post-thumb',
				[ this.setSuffix( 'bottom_footer_logo_width', suffix, property ) ] : 'body .footer-logo img',
				[ this.setSuffix( 'search_icon_size', suffix, 'font-size' ) ] : 'body .site-header .search-trigger i',
				[ this.setSuffix( 'header_custom_button_border_radius', suffix, 'border-radius' ) ] : 'body .site-header .header-custom-button',
				[ this.setSuffix( 'category_collection_image_radius', suffix, 'border-radius' ) ] : '.blogzee-category-collection-section .category-wrap .category-thumb a',
			}
		}	// End of _getResponsiveNumber() Method

		/**
		 * Returns all controls that just toggle classes
		 * 
		 * 
		 * @since 1.0.0
		 */
		_getToggleClassControls = () => {
			let suffix = 'toggleClass'

			return {
				[ this.setSuffix( 'header_builder_section_width', suffix ) ] : {
					'selector' : 'header.site-header',
					'toggleClass' : 'boxed--layout full-width--layout'
				},
				[ this.setSuffix( 'footer_builder_section_width', suffix ) ] : {
					'selector' : 'footer.site-footer',
					'toggleClass' : 'boxed--layout full-width--layout'
				},
				// Header Builder First row
				[ this.setSuffix( 'header_first_row_column', suffix, 'column-' ) ] : {
					'selector' : 'header.site-header .bb-bldr-row.row-one',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Header Builder Second row
				[ this.setSuffix( 'header_second_row_column', suffix, 'column-' ) ] : {
					'selector' : 'header.site-header .bb-bldr-row.row-two',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Header Builder Third row
				[ this.setSuffix( 'header_third_row_column', suffix, 'column-' ) ] : {
					'selector' : 'header.site-header .bb-bldr-row.row-three',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Footer Builder First row
				[ this.setSuffix( 'footer_first_row_column', suffix, 'column-' ) ] : {
					'selector' : 'footer.site-footer .bb-bldr-row.row-one',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Footer Builder Second row
				[ this.setSuffix( 'footer_second_row_column', suffix, 'column-' ) ] : {
					'selector' : 'footer.site-footer .bb-bldr-row.row-two',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				// Footer Builder Three row
				[ this.setSuffix( 'footer_three_row_column', suffix, 'column-' ) ] : {
					'selector' : 'footer.site-footer .bb-bldr-row.row-three',
					'toggleClass' : 'column-1 column-2 column-3 column-4'
				},
				[ this.setSuffix( 'post_title_hover_effects', suffix, 'title-hover--' ) ] : {
					'selector' : 'body',
					'toggleClass' : 'title-hover--none title-hover--seven title-hover--eight'
				},
				[ this.setSuffix( 'site_image_hover_effects', suffix, 'image-hover--' ) ] : {
					'selector' : 'body',
					'toggleClass' : 'image-hover--none image-hover--three image-hover--five'
				},
				[ this.setSuffix( 'website_layout', suffix ) ] : {
					'selector' : 'body',
					'toggleClass' : 'boxed--layout full-width--layout'
				},
				[ this.setSuffix( 'header_menu_hover_effect', suffix, 'hover-effect--' ) ] : {
					'selector' : '#site-navigation',
					'toggleClass' : 'hover-effect--none hover-effect--two'
				},
				[ this.setSuffix( 'footer_menu_hover_effect', suffix, 'hover-effect--' ) ] : {
					'selector' : 'footer.site-footer .bb-bldr-widget .menu',
					'toggleClass' : 'hover-effect--none hover-effect--one hover-effect--two hover-effect--three hover-effect--four'
				},
				[ this.setSuffix( 'custom_button_animation_type', suffix, 'animation-type--' ) ] : {
					'selector' : '.header-custom-button-wrapper a.header-custom-button',
					'toggleClass' : 'animation-type--none animation-type--one'
				},
				[ this.setSuffix( 'main_banner_post_elements_alignment', suffix, 'banner-align--' ) ] : {
					'selector' : '.blogzee-main-banner-section',
					'toggleClass' : 'banner-align--right banner-align--center banner-align--left'
				},
				[ this.setSuffix( 'carousel_post_elements_alignment', suffix, 'carousel-align--' ) ] : {
					'selector' : '#blogzee-carousel-section',
					'toggleClass' : 'carousel-align--center carousel-align--right carousel-align--left'
				},
				[ this.setSuffix( 'archive_post_elements_alignment', suffix, 'archive-align--' ) ] : {
					'selector' : 'body.archive .blogzee-inner-content-wrap, body.blog .blogzee-inner-content-wrap, body.home .blogzee-inner-content-wrap, body.search .blogzee-inner-content-wrap',
					'toggleClass' : 'archive-align--left archive-align--center archive-align--right'
				},
				[ this.setSuffix( 'single_post_content_alignment', suffix, 'content-alignment--' ) ] : {
					'selector' : 'body.single #primary .blogzee-inner-content-wrap .entry-content',
					'toggleClass' : 'content-alignment--left content-alignment--center content-alignment--right'
				},
				[ this.setSuffix( 'category_collection_hover_effects', suffix, 'hover-effect--' ) ] : {
					'selector' : '#blogzee-category-collection-section',
					'toggleClass' : 'hover-effect--none hover-effect--one'
				},
				[ this.setSuffix( 'you_may_have_missed_post_elements_alignment', suffix, 'you-may-have-missed-align--' ) ] : {
					'selector' : '.blogzee-you-may-have-missed-section',
					'toggleClass' : 'you-may-have-missed-align--center you-may-have-missed-align--left you-may-have-missed-align--right'
				},
				[ this.setSuffix( 'mobile_canvas_alignment', suffix, 'alignment--' ) ] : {
					'selector' : 'header .bb-bldr--responsive .bb-bldr-row.mobile-canvas',
					'toggleClass' : 'alignment--left alignment--right alignment--center'
				}
			}
		}	// End of _getToggleClassControls() Method

		/**
		 * Returns all controls ids and selecters where text is dynamic
		 * 
		 * @since 1.0.0
		 */
		_getAddTextControls = () => {
			let suffix = 'addText'

			return {
				[ this.setSuffix( 'blogname', suffix )]  : '.site-title a',
				[ this.setSuffix( 'blogdescription', suffix )]  : '.site-description'
			}
		}	// End _getAddTextControls() Method

		/**
		 * Returns all border radius controls
		 *
		 * @since 1.0.0
		 */
		_getBorderRadius = () => {
			let suffix = 'borderRadius'
			let property = 'border-radius'

			return {
				[ this.setSuffix( 'single_page_border_radius', suffix, property ) ]  : 'body.single-post .post-thumbnail.no-single-featured-image, body.single-post #blogzee-main-wrap .blogzee-container .row #primary .blogzee-inner-content-wrap article > div, body.single-post #blogzee-main-wrap .blogzee-container .row #primary nav.navigation, body.single-post #blogzee-main-wrap .blogzee-container .row #primary .single-related-posts-section-wrap.layout--list, body.single-post #primary article .post-card .bmm-author-thumb-wrap, body.single .wp-block-embed-soundcloud iframe, body.single .wp-block-embed-youtube iframe, .single .blogzee-advertisement img',
				[ this.setSuffix( 'main_banner_image_border_radius', suffix, property ) ]  : 'body .blogzee-main-banner-section .swiper .swiper-wrapper .post-thumb, .blogzee-main-banner-section.layout--four .main-banner-slider .post-elements',
				[ this.setSuffix( 'archive_section_border_radius', suffix, property ) ]  : 'body #blogzee-main-wrap > .blogzee-container > .row #primary .blogzee-inner-content-wrap article .blogzee-article-inner, body #blogzee-main-wrap > .blogzee-container > .row #primary .blogzee-inner-content-wrap article .blogzee-article-inner .post-thumbnail-wrapper, body.search.search-results #blogzee-main-wrap .blogzee-container .page-header, .archive--grid-two-layout #primary article:not(.post-format) .inner-content, #primary .blogzee-inner-content-wrap .blogzee-advertisement-block img',
				[ this.setSuffix( 'sidebar_border_radius', suffix, property ) ]  : 'body .widget, body #widget_block, body .widget.widget_media_image figure.wp-block-image img',
				[ this.setSuffix( 'sidebar_image_border_radius', suffix, property ) ]  : '.widget .post-thumb-image, .widget .post-thumb, .widget_blogzee_carousel_widget .post-thumb-wrap, .widget.widget_media_image, .widget_blogzee_category_collection_widget .categories-wrap .category-item .category-name',
				[ this.setSuffix( 'page_image_border_radius', suffix, property ) ]  : 'body.page-template-default.blogzee-variables #primary article .post-thumbnail, body.page-template-default.blogzee-variables #primary article .post-thumbnail img',
				[ this.setSuffix( 'page_border_radius', suffix, property ) ]  : '.page #blogzee-main-wrap #primary article, .error404 .error-404',
				[ this.setSuffix( 'single_image_border_radius', suffix, property ) ]  : '.single .blogzee-inner-content-wrap .post-thumbnail',
			}
		}

		/**
		 * Returns all responsive radio image
		 *
		 * @since 1.0.0
		 */
		_getResponsiveRadioImage = () => {
			let suffix = 'responsiveRadioImage'

			return {
				[ this.setSuffix( 'header_first_row_column_layout', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one'
				},
				[ this.setSuffix( 'header_second_row_column_layout', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two'
				},
				[ this.setSuffix( 'header_third_row_column_layout', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three'
				},
				[ this.setSuffix( 'footer_first_row_column_layout', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one'
				},
				[ this.setSuffix( 'footer_second_row_column_layout', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two'
				},
				[ this.setSuffix( 'footer_third_row_column_layout', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three'
				},
			}
		}

		/**
		 * Returns all responsive radio tab
		 *
		 * @since 1.0.0
		 */
		_getResponsiveRadioTab = () => {
			let suffix = 'responsiveRadioTab'

			return {

				/* Header Builder first row */
				[ this.setSuffix( 'header_first_row_column_one', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.one'
				},
				[ this.setSuffix( 'header_first_row_column_two', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.two'
				},
				[ this.setSuffix( 'header_first_row_column_three', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.three'
				},
				[ this.setSuffix( 'header_first_row_column_four', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.four',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.four',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-one .bb-bldr-column.four'
				},
				/* Header Builder second row */
				[ this.setSuffix( 'header_second_row_column_one', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.one'
				},
				[ this.setSuffix( 'header_second_row_column_two', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.two'
				},
				[ this.setSuffix( 'header_second_row_column_three', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.three'
				},
				[ this.setSuffix( 'header_second_row_column_four', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.four',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.four',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-two .bb-bldr-column.four'
				},
				/* Header Builder third row */
				[ this.setSuffix( 'header_third_row_column_one', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.one',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.one',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.one'
				},
				[ this.setSuffix( 'header_third_row_column_two', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.two',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.two',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.two'
				},
				[ this.setSuffix( 'header_third_row_column_three', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.three',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.three',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.three'
				},
				[ this.setSuffix( 'header_third_row_column_four', suffix ) ]  : {
					'desktop': 'header.site-header .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.four',
					'tablet': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.four',
					'smartphone': 'header.site-header .bb-bldr--responsive .bb-bldr-row.row-three .bb-bldr-column.four'
				},
				/* Footer Builder first row */
				[ this.setSuffix( 'footer_first_row_column_one', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.one',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.one',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.one'
				},
				[ this.setSuffix( 'footer_first_row_column_two', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.two',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.two',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.two'
				},
				[ this.setSuffix( 'footer_first_row_column_three', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.three',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.three',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.three'
				},
				[ this.setSuffix( 'footer_first_row_column_four', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.four',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.four',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-one .bb-bldr-column.four'
				},
				/* Footer Builder second row */
				[ this.setSuffix( 'footer_second_row_column_one', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.one',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.one',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.one'
				},
				[ this.setSuffix( 'footer_second_row_column_two', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.two',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.two',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.two'
				},
				[ this.setSuffix( 'footer_second_row_column_three', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.three',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.three',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.three'
				},
				[ this.setSuffix( 'footer_second_row_column_four', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.four',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.four',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-two .bb-bldr-column.four'
				},
				/* Footer Builder third row */
				[ this.setSuffix( 'footer_third_row_column_one', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.one',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.one',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.one'
				},
				[ this.setSuffix( 'footer_third_row_column_two', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.two',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.two',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.two'
				},
				[ this.setSuffix( 'footer_third_row_column_three', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.three',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.three',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.three'
				},
				[ this.setSuffix( 'footer_third_row_column_four', suffix ) ]  : {
					'desktop': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.four',
					'tablet': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.four',
					'smartphone': 'footer.site-footer .bb-bldr--normal .bb-bldr-row.row-three .bb-bldr-column.four'
				},
			}
		}

		/**
		 * Get all controls
		 * 
		 * @since 1.0.0
		 */
		_getControls = () => {
			let allControls = {}
			allControls = { ...allControls, ...this._getTypography() }
			allControls = { ...allControls, ...this._getColor() }
			allControls = { ...allControls, ...this._getCheckbox() }
			allControls = { ...allControls, ...this._getSpacing() }
			allControls = { ...allControls, ...this._getResponsiveNumber() }
			allControls = { ...allControls, ...this._getToggleClassControls() }
			allControls = { ...allControls, ...this._getAddTextControls() }
			allControls = { ...allControls, ...this._getBorderRadius() }
			allControls = { ...allControls, ...this._getResponsiveRadioImage() }
			allControls = { ...allControls, ...this._getResponsiveRadioTab() }
			return allControls;
		}	// End of _getControls()  method

		/**
		 * change preview according to change
		 * 
		 * @since 1.0.0
		 */
		preview = () => {
			let controls = this._getControls()
			const THIS = this
			const TYPEARRAY = [ 'checkbox', 'toggleClass', 'addText', 'responsiveRadioImage', 'responsiveRadioTab' ]
			Object.entries( controls ).map(([ controlId, selector ]) => {
				const HYPEN = controlId.indexOf('-')
				const ID = controlId.slice( 0, HYPEN )
				const CONTROLTYPE = controlId.slice( HYPEN + 1 )
				const [ TYPE, PROPERTY ] = CONTROLTYPE.split('+')
				var styleTagId = ID.replaceAll( '_', '-' )
				wp.customize( ID, function( value ) {
					value.bind( function( to ) {
						if( ! TYPEARRAY.includes( TYPE ) ) {
							var cssCode = THIS.generateCssCode( CONTROLTYPE, selector, to, ID )
							if( cssCode ) {
								themeCalls.blogzeeGenerateStyleTag( cssCode, 'blogzee-' + styleTagId )
							} else {
								themeCalls.blogzeeGenerateStyleTag( '', 'blogzee-' + styleTagId )
							}
						} else {
							THIS.generateCssCode( CONTROLTYPE, selector, to, ID )
						}
					});
				});
			})
		}	// End of Preview() Method

		/**
		 * generate css code for preview
		 * 
		 * @since 1.0.0
		 */
		generateCssCode = ( controlType, selector, value, controlId ) => {
			const [ TYPE, PROPERTY ] = controlType.split('+')
			const ID = controlId
			if( TYPE ) {
				var cssCode = ''
				let isVariable = ( [ 'responsiveRadioImage', 'responsiveRadioTab' ].includes( controlType ) ) ? '' : this.isVariable( selector )
				switch( TYPE ) {
					case 'typography' :
							ajaxFunctions.typoFontsEnqueue( value )
							cssCode = themeCalls.blogzeeGenerateTypoCss( selector, value, isVariable )
						break;
					case 'color' :
							if( isVariable ) {
								if( 'initial' in value ) {
									cssCode += 'body { '+ selector +' : ' + blogzee_get_color_format( value.initial[ value.initial.type ] ) + ' }';
									cssCode += 'body { '+ selector +'-hover : ' + blogzee_get_color_format( value.hover[ value.hover.type ] ) + ' }';
								} else {
									cssCode += 'body { '+ selector +': ' + blogzee_get_color_format( value[ value.type ] ) + ' }';
								}
							} else {
								if( 'initial' in value ) {
									cssCode += selector + ' { '+ PROPERTY +': ' + blogzee_get_color_format( value.initial[ value.initial.type ] ) + ' }';
									cssCode += selector + ' { '+ PROPERTY +': ' + blogzee_get_color_format( value.hover[ value.hover.type ] ) + ' }';
								} else {
									if( PROPERTY === 'background' ) {
										cssCode += selector + '{' + blogzee_get_background_style( value ) + '}'
									} else {
										cssCode += selector + ' { '+ PROPERTY + ': ' + blogzee_get_color_format( value[ value.type ] ) + ' }';
									}
								}
							}
						break;
					case 'checkbox' :
							if( $( selector ).hasClass( PROPERTY ) ) {
								$( selector ).removeClass( PROPERTY )
							} else {
								$( selector ).addClass( PROPERTY )
							}
							return
						break;
					case 'spacing' :
							if( value.desktop ) {
								let desktop = value.desktop
								cssCode += selector + '{ '+ PROPERTY +': ' + desktop.top + 'px ' + desktop.right + 'px ' + desktop.bottom + 'px ' + desktop.left + 'px }';
							}
							if( value.tablet ) {
								let tablet = value.tablet
								cssCode += '@media(max-width: 940px) {'+ selector  +'{ '+ PROPERTY +': ' + tablet.top + 'px ' + tablet.right + 'px ' + tablet.bottom + 'px ' + tablet.left + 'px } }';
							}
							if( value.smartphone ) {
								let smartphone = value.smartphone
								cssCode += '@media(max-width: 610px) {'+ selector  +'{ '+ PROPERTY +': ' + smartphone.top + 'px ' + smartphone.right + 'px ' + smartphone.bottom + 'px ' + smartphone.left + 'px } }';
							}
						break;
					case 'responsiveNumber' :
							// desktop
							let unit = 'px'
							if( PROPERTY != 'image-ratio' ) {
								const PROPERTIES = PROPERTY.split(',')
								if( Array.isArray( PROPERTIES ) ) {
									var cssCodeArray = PROPERTIES.map( current => {
										return selector + '{ '+ current +': ' + value.desktop + unit + '}'
									} )
									cssCode += cssCodeArray.join('')
								} else {
									if( $( selector ).length > 0 ) cssCode += selector + '{ '+ PROPERTY +': ' + value.desktop + unit + '}'
								}
							}  else {
								if( isVariable ) {
									cssCode += 'body.blogzee-variables{ '+ selector +': ' + value.desktop + '}'
								} else {
									cssCode += selector + '{ padding-bottom: calc(' + value.desktop +  ' * 100%) }'
								}
							}

							// tablet
							if( PROPERTY != 'image-ratio' ) {
								const PROPERTIES = PROPERTY.split(',')
								if( Array.isArray( PROPERTIES ) ) {
									var cssCodeArray = PROPERTIES.map( current => {
										return '@media(max-width: 994px) { '+ selector + '{ '+ current +': ' + value.tablet + unit + '} }'
									} )
									cssCode += cssCodeArray.join('')
								} else {
									cssCode += '@media(max-width: 994px) { '+ selector + '{ '+ PROPERTY +': ' + value.tablet + unit + '} } '
								}
							}  else {
								if( isVariable ) {
									cssCode += 'body.blogzee-variables {' + selector + '-tab :' + value.tablet + '}'
								} else {
									cssCode += '@media(max-width: 994px) { ' + selector + ' { padding-bottom: calc(' + value.tablet +  ' * 100%) } }'
								}
							}

							// smartphone
							if( PROPERTY != 'image-ratio' ) {
								const PROPERTIES = PROPERTY.split(',')
								if( Array.isArray( PROPERTIES ) ) {
									var cssCodeArray = PROPERTIES.map( current => {
										return '@media(max-width: 610px) { '+ selector + '{ '+ current +': ' + value.smartphone + unit + '} } '
									} )
									cssCode += cssCodeArray.join('')
								} else {
									cssCode += '@media(max-width: 610px) { '+ selector + '{ '+ PROPERTY +': ' + value.smartphone + unit + '} } '
								}
							}  else {
								if( isVariable ) {
									cssCode += 'body.blogzee-variables {' + selector + '-mobile:' + value.smartphone + '}'
								} else {
									cssCode += '@media(max-width: 610px){ ' + selector + '{ padding-bottom: calc(' + value.smartphone +  ' * 100%) } }'
								}
							}
						break;
					case 'toggleClass' :
							let classToAdd = ( PROPERTY === undefined ) ? value : PROPERTY + value
							$( selector['selector'] ).removeClass( selector['toggleClass'] ).addClass( classToAdd )
						break;
					case 'addText' :
							$( selector ).text( value )
						break;
					case 'borderRadius' :
							cssCode += selector + " { " + PROPERTY + ": " + value + "px } "
						break;
					case 'responsiveRadioImage' :
							const { desktop: desktopVal, tablet: tabletVal, smartphone: smartphoneVal } = value
							const { desktop, tablet, smartphone } = selector

							$(desktop).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/layout-\S+/g ) || [] ).join(' ');
							}).addClass( 'layout-' + desktopVal )
							
							$(tablet).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/tablet-layout-\S+/g ) || [] ).join(' ');
							}).addClass( 'tablet-layout-' + tabletVal )

							$(smartphone).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/smartphone-layout-\S+/g ) || [] ).join(' ');
							}).addClass( 'smartphone-layout-' + smartphoneVal )
						break;
					case 'responsiveRadioTab' :
							const { desktop: desktopTab, tablet: tabletTab, smartphone: smartphoneTab } = value
							const { desktop: desktopSel, tablet: tabletSel, smartphone: smartphoneSel } = selector

							$( desktopSel ).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/alignment-\S+/g ) || [] ).join(' ');
							}).addClass( 'alignment-' + desktopTab )
							
							$( tabletSel ).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/tablet-alignment-\S+/g ) || [] ).join(' ');
							}).addClass( 'tablet-alignment--' + tabletTab )

							$( smartphoneSel ).removeClass(function( index, _thisClass ) {
								return ( _thisClass.match(/smartphone-alignment-\S+/g ) || [] ).join(' ');
							}).addClass( 'smartphone-alignment--' + smartphoneTab )
						break;
					default:
						cssCode = TYPE + ' default'
				}
				return cssCode;
			}
		}	// End of generateCssCode() method
	}

	new BlogzeeCustomize();
}( jQuery ) );