/**
 * Image block before and after.
 */
( function( blocks, editor, i18n, element, components, _ ) {
	var __					= i18n.__;
	var createElement		= element.createElement;
	var MediaUpload			= editor.MediaUpload;
	var InspectorControls	= editor.InspectorControls;
	var BlockControls		= editor.BlockControls;
	var Toolbar 			= components.Toolbar;
	var ToggleControl		= components.ToggleControl;
	var PanelBody			= components.PanelBody;
	var SelectControl		= components.SelectControl;
	var RangeControl		= components.RangeControl;
	var TextControl			= components.TextControl;

	/**
	 * Register block
	 *
	 * @param  {string}   name		Block name.
	 * @param  {Object}   settings	Block settings.
	 * @return {?WPBlock}			The block, if it has been successfully
	 *								registered; otherwise `undefined`.
	 */
	blocks.registerBlockType( 'before-after-image-slider/block', {
		title: __( 'Before & After Image Slider', 'before-after-image-slider' ),
		icon: 'image-flip-horizontal',
		category: 'layout',
		description: __( 'Highlight the differences between the two images.', 'before-after-image-slider' ),
		attributes: {
			mediaBeforeID: {
				type: 'number'
			},
			mediaBeforeURL: {
				type: 'string',
				source: 'attribute',
				selector: '.image-before',
				attribute: 'src'
			},
			mediaAfterID: {
				type: 'number'
			},
			mediaAfterURL: {
				type: 'string',
				source: 'attribute',
				selector: '.image-after',
				attribute: 'src'
			},
			overlay: {
				type: 'boolean',
				default: false,
			},
			moveSliderOnHover: {
				type: 'boolean',
				default: false
			},
			moveWithHandleOnly: {
				type: 'boolean',
				default: true
			},
			clickToMove: {
				type: 'boolean',
				default: false
			},
			orientation: {
				type: 'string',
				default: 'horizontal'
			},
			offset: {
				type: 'number',
				default: 50
			},
			beforeLabel: {
				type: 'string',
				default: __( 'Before', 'before-after-image-slider' )
			},
			afterLabel: {
				type: 'string',
				default: __( 'After', 'before-after-image-slider' )
			}
		},

		// Defines the block within the editor.
		edit: function( props ) {
			var attributes = props.attributes;

			function onSelectImageBefore( media ) {
				return props.setAttributes( {
					mediaBeforeURL: media.url,
					mediaBeforeID: media.id
				} );
			};

			function onSelectImageAfter( media ) {
				return props.setAttributes( {
					mediaAfterURL: media.url,
					mediaAfterID: media.id
				} );
			};

			return [

				createElement( InspectorControls, null,
					createElement( PanelBody, {
							title: __( 'Options', 'before-after-image-slider' )
						},
						createElement( RangeControl, {
								label: __( 'Default offset pct', 'before-after-image-slider' ),
								value: attributes.offset,
								min: 0,
    							max: 100,
    							onChange: function( value ) {
    								props.setAttributes( {
    									offset: value
    								} )
    							},
    							help: __( 'How much of the before image is visible when the page loads', 'before-after-image-slider' )
							}
						),
						createElement( SelectControl, {
								label: __( 'Orientation', 'before-after-image-slider' ),
								value: attributes.orientation,
								options: [ {
									label: 'Vertical',
									value: 'vertical'
								}, {
									label: 'Horizontal',
									value: 'horizontal'
								} ],
						        onChange: function( value ) {
						        	props.setAttributes( {
						        		orientation: value
						        	} )
						        },
						        help: __( 'Orientation of the before and after images', 'before-after-image-slider' )
							}
						),
						createElement( TextControl, {
								label: __( 'Before label', 'before-after-image-slider' ),
								value: attributes.beforeLabel,
    							onChange: function( value ) {
    								props.setAttributes( {
    									beforeLabel: value
    								} )
    							},
    							help: __( 'Set a custom before label', 'before-after-image-slider' )
							}
						),
						createElement( TextControl, {
								label: __( 'After label', 'before-after-image-slider' ),
								value: attributes.afterLabel,
    							onChange: function( value ) {
    								props.setAttributes( {
    									afterLabel: value
    								} )
    							},
    							help: __( 'Set a custom after label', 'before-after-image-slider' )
							}
						),
						createElement( ToggleControl, {
								label: __( 'No overlay', 'before-after-image-slider' ),
								checked: attributes.overlay,
								onChange: function( value ) {
									props.setAttributes( {
										overlay: value
									} )
								},
								help: __( 'Do not show the overlay with before and after', 'before-after-image-slider' )
							}
						),
						createElement( ToggleControl, {
								label: __( 'Move slider on hover', 'before-after-image-slider' ),
								checked: attributes.moveSliderOnHover,
								onChange: function( value ) {
									props.setAttributes( {
										moveSliderOnHover: value
									} )
								},
								help: __( 'Move slider on mouse hover?', 'before-after-image-slider' )
							}
						),
						createElement( ToggleControl, {
								label: __( 'Move with handle only', 'before-after-image-slider' ),
								checked: attributes.moveWithHandleOnly,
								onChange: function( value ) {
									props.setAttributes( {
										moveWithHandleOnly: value
									} )
								},
								help: __( 'Allow a user to swipe anywhere on the image to control slider movement.', 'before-after-image-slider' )
							}
						),
						createElement( ToggleControl, {
								label: __( 'Click to move', 'before-after-image-slider' ),
								checked: attributes.clickToMove,
								onChange: function( value ) {
									props.setAttributes( {
										clickToMove: value
									} )
								},
								help: __( 'Allow a user to click (or tap) anywhere on the image to move the slider to that location.', 'before-after-image-slider' )
							}
						),
					),
				),

				createElement( BlockControls, null,
                    createElement( Toolbar, {
	                    	controls: [ {
                    			icon: 'controls-repeat',
								title: 'Swap images',
								onClick: function() {
									props.setAttributes( {
										mediaBeforeURL: attributes.mediaAfterURL,
										mediaAfterURL: attributes.mediaBeforeURL,
										mediaBeforeID: attributes.mediaAfterID,
										mediaAfterID: attributes.mediaBeforeID
									} );
								}
	                    	} ]
	                    }
	                ),
                ),

				createElement( 'div', {
						className: props.className
					},
					createElement( 'div', {
							className: 'image-button-before'
						},
						createElement( MediaUpload, {
							onSelect: onSelectImageBefore,
							allowedTypes: 'image',
							value: attributes.mediaBeforeID,
							render: function( obj ) {
								return createElement( components.Button, {
										className: attributes.mediaBeforeID ? 'image-button' : 'button button-large',
										onClick: obj.open
									},
									! attributes.mediaBeforeID ? __( 'Upload Image Before', 'before-after-image-slider' ) : createElement( 'img', { src: attributes.mediaBeforeURL } )
								);
							}
						} ),
					),
					createElement( 'div', {
							className: 'image-button-after'
						},
						createElement( MediaUpload, {
							onSelect: onSelectImageAfter,
							allowedTypes: 'image',
							value: attributes.mediaAfterID,
							render: function( obj ) {
								return createElement( components.Button, {
										className: attributes.mediaAfterID ? 'image-button' : 'button button-large',
										onClick: obj.open
									},
									! attributes.mediaAfterID ? __( 'Upload Image After', 'before-after-image-slider' ) : createElement( 'img', { src: attributes.mediaAfterURL } )
								);
							}
						} )
					),
				)
			];
		},

		// Defines the saved block.
		save: function( props ) {
			var attributes = props.attributes;

			return createElement( 'div',
				{
					className			: props.className,
					'data-offset'		: attributes.offset,
					'data-orientation'	: attributes.orientation,
					'data-before'		: attributes.beforeLabel,
					'data-after'		: attributes.afterLabel,
					'data-overlay'		: attributes.overlay,
					'data-hover'		: attributes.moveSliderOnHover,
					'data-handle'		: attributes.moveWithHandleOnly,
					'data-click'		: attributes.clickToMove

				},
				attributes.mediaBeforeURL &&
					createElement( 'img', {
							className: 'image-before',
							src: attributes.mediaBeforeURL
						}
					),
				attributes.mediaAfterURL &&
					createElement( 'img', {
							className: 'image-after',
							src: attributes.mediaAfterURL
						}
					),

			);
		},
	} );

} )(
	window.wp.blocks,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components,
	window._,
);
