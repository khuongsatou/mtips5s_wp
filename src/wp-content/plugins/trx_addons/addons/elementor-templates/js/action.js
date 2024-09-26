/* global jQuery, elementor, elementorCommon, TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION, TRX_ADDONS_STORAGE, cssbeautify, elementorModules, $e */

jQuery( window ).on( 'elementor/init', function() {
	var trx_addons_elementor_extension = window.trx_addons_elementor_extension = window.trx_addons_elementor_extension || {};
	var elementorSettings = elementor.settings.page.model.attributes;

	// trx_addons_elementor_extension.fixKitClasses = ( id = elementor.config.kit_id ) => {
	// 	const classes = elementor.$previewContents.find('body').classList().filter(word => word.startsWith('elementor-kit-'));
	// 	classes.forEach( className => {
	// 		elementor.$previewContents.find('body').removeClass(className);
	// 	} );
	// 	elementor.$previewContents.find('body').addClass(`elementor-kit-${id}`);
	// }

	// trx_addons_elementor_extension.loadDocumentAndEnqueueFonts = ( id, softReload = false ) => {
	// 	elementor.documents.request(id)
	// 		.then( ( config ) => {
	// 			elementor.documents.addDocumentByConfig(config);

	// 			/**
	// 			 * If for some reasons, Kit CSS wasn't enqueued.
	// 			 * This line forces Theme Style window to open, which re-renders the CSS for current kit.
	// 			 */
	// 			if ( ! elementor.$previewContents.find( `#elementor-post-${config.id}-css` ).length && softReload ) {
	// 				trx_addons_elementor_extension.openThemeStyles();
	// 			}
	// 		})
	// 		.then( () => {
	// 			const document = elementor.documents.get(id);
	// 			const settings = document.config.settings.settings;
	// 			const controls = document.config.settings.controls;

	// 			for (let [key, value] of Object.entries( settings ) ) {
	// 				if ( controls[ key ] && 'font' === controls[ key ].type && value ) {
	// 					elementor.helpers.enqueueFont( value );
	// 				}
	// 			}
	// 		} );
	// }

	// trx_addons_elementor_extension.enqueueFonts = () => {
	// 	const attributes = elementor.settings.page.model.attributes;
	// 	const controls = elementor.settings.page.model.controls;

	// 	for (let [key, value] of Object.entries(attributes)) {
	// 		if ( controls[ key ] && 'font' === controls[ key ].type && value ) {
	// 			elementor.helpers.enqueueFont( value );
	// 		}
	// 	}
	// }

	// trx_addons_elementor_extension.refreshKit = ( id ) => {
	// 	trx_addons_elementor_extension.setPanelTitle(id);
	// 	elementor.config.kit_id = id;
	// 	trx_addons_elementor_extension.fixKitClasses(id);
	// 	trx_addons_elementor_extension.loadDocumentAndEnqueueFonts( id );
	// }

	// trx_addons_elementor_extension.kitSwitcher = ( id ) => {
	// 	if ( elementor.config.kit_id !== id ) {
	// 		elementor.settings.page.model.setExternalChange( 'ang_updated_token', elementor.config.kit_id );
	// 		trx_addons_elementor_extension.refreshKit(id);
	// 		setTimeout( () => {
	// 			$e.run( 'document/save/update' ).then( () => {
	// 				window.location.reload();
	// 			} );
	// 		}, 1000 );
	// 	}
	// }

	// trx_addons_elementor_extension.setPanelTitle = ( id = false ) => {
	// 	const container = elementor.documents.documents[elementor.config.initial_document.id].container;
	// 	if ( ! id ) {
	// 		id = container.settings.attributes.TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION_tokens;
	// 	}

	// 	const options = container.controls.TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION_tokens.options;
	// 	const title = options[id];

	// 	if ( '' !== title && 'undefined' !== title && 'undefined' !== typeof( title ) ) {
	// 		elementor.getPanelView().getPages().kit_settings.title = elementor.translate( 'Theme Style' ) + ' - ' + title;
	// 	}
	// };

	// trx_addons_elementor_extension.openThemeStyles = ( tab = 'theme-style-kits' ) => {
	// 	if ( `panel/global/${tab}` in $e.routes.components ) {
	// 		setTimeout(function() {
	// 			$e.run( 'panel/global/open' ).then(
	// 				() => setTimeout( () => $e.route( `panel/global/${tab}` ) )
	// 			);
	// 		});
	// 	} else {
	// 		$e.run( 'panel/global/open' );
	// 	}
	// };

	trx_addons_elementor_extension.openGlobalColors = () => {
		trx_addons_elementor_extension.redirectToPanel( 'trx_addons_global_colors_section', 'global-colors' );
	};

	trx_addons_elementor_extension.openGlobalFonts = () => {
		trx_addons_elementor_extension.redirectToPanel( 'trx_addons_global_fonts_section', 'global-typography' );
	};

	/**
	 * Escape characters in during Regexp.
	 *
	 * @param {string} String to replace.
	 *
	 * @returns {void | *}
	 */
	function escapeRegExp( string ) {
		return string.replace( /[.*+?^${}()|[\]\\]/g, "\\$&" );
	}

	/**
	 * Define function to find and replace specified term with replacement string.
	 *
	 * @param {string} str String to replace.
	 * @param {string} term Search string.
	 * @param {string}replacement Replacement string.
	 *
	 * @since 1.5.0
	 * @returns {string}
	 */
	function replaceAll(str, term, replacement) {
		return str.replace(new RegExp( escapeRegExp( term ), 'g' ), replacement );
	}

	/**
	 * Determines if given key should be exported/imported into Style Kit.
	 *
	 * @param {string} key Setting ID.
	 * 
	 * @return {boolean} True, or false.
	 */
	// const eligibleKey = ( key ) => {
	// 	return ! ( key.startsWith( 'TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION' ) || key.startsWith( 'post' ) || key.startsWith( 'preview' ) );
	// };

	/**
	 * Redirect to specific section.
	 *
	 * @since 1.6.2
	 *
	 * @param {string} section Panel/Section ID.
	 * @param {string} panel Panel ID for Theme Style window panels.
	 * @returns void
	 */
	trx_addons_elementor_extension.redirectToSection = function( tab = 'settings', section = 'trx_addons_style_settings', page = 'page-settings', kit = false ) {
		$e.route( `panel/${ page }/${ tab }` );

		if ( kit ) {
			elementor.getPanelView().getCurrentPageView().content.currentView.activateSection(section).render();
		} else {
			elementor.getPanelView().getCurrentPageView().activateSection(section)._renderChildren();
		}

		return false;
	};

	/**
	 * Opens global panel and redirects to specific section.
	 *
	 * @since 1.6.2
	 *
	 * @param {string} section Panel/Section ID.
	 * @param {string} panel Panel ID for Theme Style window panels.
	 * @returns void
	 */
	trx_addons_elementor_extension.redirectToPanel = ( section, panel = 'theme-style-kits' ) => {
		$e.run( 'panel/global/open' ).then( () => {
			$e.route( `panel/global/${panel}` );
			elementor.getPanelView().getCurrentPageView().content.currentView.activateSection(section).render();
		});
	};

	/**
	 * Used to switch section when Theme Style panels is open.
	 *
	 * @since 1.6.2
	 *
	 * @param {string} section Section ID.
	 */
	// trx_addons_elementor_extension.switchKitSection = (section) => {
	// 	elementor.getPanelView().setPage('kit_settings').content.currentView.activateSection( section ).activateTab('style');
	// };

	// trx_addons_elementor_extension.resetStyles = () => {
	// 	$e.run( 'document/elements/reset-settings', {
	// 		container: elementor.documents.documents[elementor.config.kit_id].container,
	// 		settings: null,
	// 	} );

	// 	// Reset value render hack.
	// 	$e.run('document/save/update').then( () => $e.run( 'panel/global/close' ).then( () => trx_addons_elementor_extension.redirectToPanel( 'ang_tools' ) ));
	// };

	// elementor.on( 'preview:loaded', () => {
	// 	jQuery('body').toggleClass( 'dark-mode', elementor.settings.editorPreferences.model.attributes.ui_theme === 'dark' );
	// } );

	// jQuery('#elementor-panel').on('change', '[data-setting="ui_theme"]', function(e) {
	// 	const value = e.target.value;

	// 	jQuery('body').toggleClass( 'dark-mode', value === 'dark' );
	// });

	// trx_addons_elementor_extension.handleCSSReset = () => {
	// 	elementorCommon.dialogsManager.createWidget( 'confirm', {
	// 		message: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['resetMessage'],
	// 		headerMessage: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['resetHeader'],
	// 		strings: {
	// 			confirm: elementor.translate( 'yes' ),
	// 			cancel: elementor.translate( 'cancel' ),
	// 		},
	// 		defaultOption: 'cancel',
	// 		onConfirm: trx_addons_elementor_extension.resetStyles,
	// 	} ).show();
	// };

	function refreshPageConfig( id ) {
		elementor.documents.invalidateCache( id );
		elementor.documents.request( id )
			.then( ( config ) => {
				elementor.documents.addDocumentByConfig(config);

				$e.internal( 'editor/documents/load', { config } ).then( () => {
					elementor.reloadPreview();
				} );
			});
	}

	// trx_addons_elementor_extension.handleSaveToken = () => {
	// 	const modal = elementorCommon.dialogsManager.createWidget( 'lightbox', {
	// 		id: 'ang-modal-save-token',
	// 		className: 'dialog-type-confirm',
	// 		headerMessage: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['saveToken'],
	// 		message: '',
	// 		position: {
	// 			my: 'center',
	// 			at: 'center',
	// 		},
	// 		onReady: function() {
	// 			this.addButton( {
	// 				name: 'cancel',
	// 				text: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['cancel'],
	// 				callback: function() {
	// 					modal.destroy();
	// 				},
	// 			} );
	// 			this.addButton( {
	// 				name: 'ok',
	// 				text: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['saveToken2'],
	// 				callback: function( widget ) {
	// 					const title = widget.getElements( 'content' ).find( '#ang_token_title' ).val();

	// 					if ( title ) {
	// 						const angSettings = {};
	// 						const settings = elementor.documents.documents[elementor.config.kit_id].container.settings.attributes;

	// 						_.map( settings, function( value, key ) {
	// 							if ( eligibleKey( key ) ) {
	// 								angSettings[ key ] = value;
	// 							}
	// 						} );

	// 						wp.apiFetch( {
	// 							url: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['saveToken'],
	// 							method: 'post',
	// 							data: {
	// 								id: elementor.config.kit_id,
	// 								title: title,
	// 								settings: JSON.stringify( angSettings ),
	// 							},
	// 						} ).then( function( response ) {
	// 							modal.destroy();

	// 							// Ensure current changes are not saved to active document.
	// 							$e.run( 'document/save/discard' ); // TODO: Fix console TypeError while closing kit panel.

	// 							/**
	// 							 * Open Document is not accessible while Kit is active.
	// 							 * So we close the Kit panel and then save Style Kit value.
	// 							 */
	// 							$e.run( 'panel/global/close' ).then( () => {
	// 								elementor.settings.page.model.setExternalChange( 'TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION_tokens', response.id );
	// 								trx_addons_elementor_extension.kitSwitcher( response.id );
	// 							} );


	// 							elementor.notifications.showToast( {
	// 								message: response.message,
	// 							} );
	// 						} ).catch( function( error ) {
	// 							elementorCommon.dialogsManager.createWidget( 'alert', {
	// 								headerMessage: error.code,
	// 								message: error.message,
	// 							} ).show();
	// 						} );
	// 					} else {
	// 						elementor.notifications.showToast( { message: 'Please enter a title to save your Kit.' } );
	// 					}
	// 				},
	// 			} );
	// 		},

	// 		onShow: function() {
	// 			const content = modal.getElements( 'content' );
	// 			content.append( `<input id="ang_token_title" type="text" value="" placeholder="${ TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['enterTitle'] }" />` );
	// 		},
	// 	} );

	// 	modal.getElements( 'message' ).append( modal.addElement( 'content' ) );
	// 	modal.show();
	// 	jQuery( window ).resize();
	// };

	// trx_addons_elementor_extension.handleCSSExport = () => {
	// 	// Get the whole Page CSS
	// 	const allStyles = elementor.settings.page.getControlsCSS().elements.$stylesheetElement[ 0 ].textContent;

	// 	// Then remove Page's custom CSS.
	// 	const pageCSS = elementor.settings.page.model.get( 'custom_css' );
	// 	const strippedCSS = allStyles.replace( pageCSS, '' );
	// 	const formattedCSS = cssbeautify( strippedCSS, {
	// 		indent: '  ',
	// 		openbrace: 'end-of-line',
	// 		autosemicolon: true,
	// 	} );

	// 	const replacer = (e) => {
	// 		const checked = e.target.checked;
	// 		const elBody = `body.elementor-kit-${elementor.config.document.id}`;
	// 		const elSelector = 'body.elementor-page';
	// 		const elTextarea = jQuery('#ang-export-css');

	// 		if ( checked ) {
	// 			let stripped = replaceAll( formattedCSS, elBody + ' ', elSelector + ' ' );
	// 			stripped = replaceAll( stripped, elBody + ':', elSelector + ':' );
	// 			stripped = replaceAll( stripped, elBody + ',', elSelector + ',' );

	// 			jQuery(elTextarea).html(stripped);
	// 		} else {
	// 			let stripped = replaceAll( formattedCSS, elSelector + ' ', elBody + ' ' );
	// 			stripped = replaceAll( stripped, elSelector + ':', elBody + ':' );
	// 			stripped = replaceAll( stripped, elSelector + ',', elBody + ',' );

	// 			jQuery(elTextarea).html(stripped);
	// 		}
	// 	};

	// 	const modal = elementorCommon.dialogsManager.createWidget( 'lightbox', {
	// 		id: 'ang-modal-export-css',
	// 		className: 'dialog-type-confirm',
	// 		headerMessage: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['exportCSS'],
	// 		message: '',
	// 		position: {
	// 			my: 'center',
	// 			at: 'center',
	// 		},
	// 		onReady: function() {
	// 			this.addButton( {
	// 				name: 'cancel',
	// 				text: elementor.translate( 'cancel' ),
	// 				callback: function() {
	// 					modal.destroy();
	// 				},
	// 			} );

	// 			this.addButton( {
	// 				name: 'ok',
	// 				text: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['copyCSS'],
	// 				callback: function() {
	// 					const content = modal.getElements( 'content' ).find('#ang-export-css');

	// 					if( navigator.clipboard ) {
	// 						const textToCopy = content[0].innerHTML;
	// 						navigator.clipboard.writeText( textToCopy ).then( () => {
	// 							elementor.notifications.showToast( {
	// 								message: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].cssCopied,
	// 							} );
	// 						} );
	// 					} else {
	// 						// execCommand method is not recommended anymore and soon will be dropped by browsers.
	// 						jQuery( content ).select();
	// 						document.execCommand('copy');

	// 						elementor.notifications.showToast( {
	// 							message: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].cssCopied,
	// 						} );
	// 					}
	// 				},
	// 			} );
	// 		},

	// 		onShow: function() {
	// 			const content = modal.getElements( 'content' );
	// 			content.append( `
	// 					<textarea id="ang-export-css" rows="10">${formattedCSS}</textarea>
	// 					<div style="text-align:left;">
	// 						<input type="checkbox" id="ang-switch-selector" />
	// 						<label for="ang-switch-selector">${TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].cssSelector}</label>
	// 					</div>
	// 				` );

	// 			jQuery('#ang-switch-selector').bind('change', replacer);
	// 		},
	// 		onHide: function() {
	// 			setTimeout(function(){
	// 				modal.destroy();
	// 			}, 200 );
	// 		},
	// 	} );

	// 	modal.getElements( 'message' ).append( modal.addElement( 'content' ) );
	// 	modal.show();
	// 	jQuery( window ).resize();
	// }

	trx_addons_elementor_extension.resetGlobalColors = () => {

		var defaultValues = {};

		// Get defaults for each scheme
		Object.keys( TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['schemes'] ).forEach( ( scheme ) => {
			const option_name = 'trx_addons_global_colors_scheme_' + scheme;
			const options = elementor.documents.documents[elementor.config.kit_id].container.controls[ option_name ];
			if ( undefined === options || null === options ) {
				return;
			}
			defaultValues[ option_name ] = options.default;
		} );

		// Reset the selected settings to their default values
		$e.run( 'document/elements/settings', {
			container: elementor.documents.documents[ elementor.config.kit_id ].container,
			settings: defaultValues,
			options: {
				external: true,
			},
		} );

		// Save changes and reopen the global colors panel
		$e.run('document/save/update').then( () => $e.run( 'panel/global/close' ).then( () => trx_addons_elementor_extension.openGlobalColors() ) );
	};

	trx_addons_elementor_extension.handleGlobalColorsReset = () => {
		elementorCommon.dialogsManager.createWidget( 'confirm', {
			message: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['resetGlobalColorsMessage'],
			headerMessage: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate']['resetHeader'],
			strings: {
				confirm: elementor.translate( 'yes' ),
				cancel: elementor.translate( 'cancel' ),
			},
			defaultOption: 'cancel',
			onConfirm: trx_addons_elementor_extension.resetGlobalColors,
		} ).show();
	};

	// trx_addons_elementor_extension.resetGlobalFonts = () => {
	// 	const ang_global_fonts = [
	// 		'ang_global_title_fonts',
	// 		'ang_global_text_fonts',
	// 		'ang_global_secondary_part_one_fonts',
	// 		'ang_global_secondary_part_two_fonts',
	// 		'ang_global_tertiary_part_one_fonts',
	// 		'ang_global_tertiary_part_two_fonts',
	// 	];

	// 	let defaultValues = {};

	// 	// Get defaults for each setting
	// 	ang_global_fonts.forEach( ( setting ) => {
	// 		const options = elementor.documents.documents[elementor.config.kit_id].container.controls[setting];
	// 		if ( undefined === options || null === options ) {
	// 			return;
	// 		}
	// 		defaultValues[ setting ] = options.default;
	// 	} );

	// 	// Reset the selected settings to their default values
	// 	$e.run( 'document/elements/settings', {
	// 		container: elementor.documents.documents[elementor.config.kit_id].container,
	// 		settings: defaultValues,
	// 		options: {
	// 			external: true,
	// 		},
	// 	} );

	// 	// Reset value render hack.
	// 	$e.run('document/save/update').then( () => $e.run( 'panel/global/close' ).then( () => trx_addons_elementor_extension.openGlobalFonts() ));
	// };

	// trx_addons_elementor_extension.handleGlobalFontsReset = () => {
	// 	elementorCommon.dialogsManager.createWidget( 'confirm', {
	// 		message: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].resetGlobalFontsMessage,
	// 		headerMessage: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].resetHeader,
	// 		strings: {
	// 			confirm: elementor.translate( 'yes' ),
	// 			cancel: elementor.translate( 'cancel' ),
	// 		},
	// 		defaultOption: 'cancel',
	// 		onConfirm: trx_addons_elementor_extension.resetGlobalFonts,
	// 	} ).show();
	// };

	// trx_addons_elementor_extension.resetContainerPadding = () => {
	// 	const ang_container_padding = [
	// 		'ang_container_padding',
	// 		'ang_container_padding_part_two',
	// 		'ang_container_padding_secondary',
	// 		'ang_container_padding_tertiary',
	// 		'ang_custom_container_padding',
	// 	];

	// 	let defaultValues = {};

	// 	// Get defaults for each setting
	// 	ang_container_padding.forEach( ( setting ) => {
	// 		const options = elementor.documents.documents[elementor.config.kit_id].container.controls[setting];
	// 		if ( undefined === options || null === options ) {
	// 			return;
	// 		}
	// 		defaultValues[ setting ] = options.default;
	// 	} );

	// 	// Reset the selected settings to their default values
	// 	$e.run( 'document/elements/settings', {
	// 		container: elementor.documents.documents[elementor.config.kit_id].container,
	// 		settings: defaultValues,
	// 		options: {
	// 			external: true,
	// 		},
	// 	} );

	// 	// Reset value render hack.
	// 	$e.run('document/save/update').then( () => $e.run( 'panel/global/close' ).then( () => trx_addons_elementor_extension.redirectToPanel( 'ang_container_spacing' ) ));
	// };

	// trx_addons_elementor_extension.handleContainerPaddingReset = () => {
	// 	elementorCommon.dialogsManager.createWidget( 'confirm', {
	// 		message: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].resetContainerPaddingMessage,
	// 		headerMessage: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].resetHeader,
	// 		strings: {
	// 			confirm: elementor.translate( 'yes' ),
	// 			cancel: elementor.translate( 'cancel' ),
	// 		},
	// 		defaultOption: 'cancel',
	// 		onConfirm: trx_addons_elementor_extension.resetContainerPadding,
	// 	} ).show();
	// };

	// trx_addons_elementor_extension.resetBoxShadows = () => {
	// 	const ang_box_shadows = [
	// 		'ang_box_shadows',
	// 		'ang_box_shadows_secondary',
	// 		'ang_box_shadows_tertiary'
	// 	];

	// 	const defaultValues = {};

	// 	// Get defaults for each setting
	// 	ang_box_shadows.forEach( ( setting ) => defaultValues[ setting ] = elementor.documents.documents[ elementor.config.kit_id ].container.controls[ setting ].default );

	// 	// Reset the selected settings to their default values
	// 	$e.run( 'document/elements/settings', {
	// 		container: elementor.documents.documents[ elementor.config.kit_id ].container,
	// 		settings: defaultValues,
	// 		options: {
	// 			external: true,
	// 		},
	// 	} );

	// 	// Reset value render hack.
	// 	$e.run( 'document/save/update' ).then( () => $e.run( 'panel/global/close' ).then( () => trx_addons_elementor_extension.redirectToPanel( 'ang_shadows' ) ) );
	// };

	// trx_addons_elementor_extension.handleResetBoxShadows = () => {
	// 	elementorCommon.dialogsManager.createWidget( 'confirm', {
	// 		message: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].resetShadowsDesc,
	// 		headerMessage: TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION['translate'].resetHeader,
	// 		strings: {
	// 			confirm: elementor.translate( 'yes' ),
	// 			cancel: elementor.translate( 'cancel' ),
	// 		},
	// 		defaultOption: 'cancel',
	// 		onConfirm: trx_addons_elementor_extension.resetBoxShadows,
	// 	} ).show();
	// };

	elementor.channels.editor.on( 'trx_addons_elementor_extension:resetGlobalColors', trx_addons_elementor_extension.handleGlobalColorsReset );
	// elementor.channels.editor.on( 'trx_addons_elementor_extension:resetGlobalFonts', trx_addons_elementor_extension.handleGlobalFontsReset );

	// elementor.channels.editor.on( 'trx_addons_elementor_extension:resetContainerPadding', trx_addons_elementor_extension.handleContainerPaddingReset );
	// elementor.channels.editor.on( 'trx_addons_elementor_extension:resetBoxShadows', trx_addons_elementor_extension.handleResetBoxShadows );
	// elementor.channels.editor.on( 'trx_addons_elementor_extension:resetKit', trx_addons_elementor_extension.handleCSSReset );
	// elementor.channels.editor.on( 'trx_addons_elementor_extension:saveKit', trx_addons_elementor_extension.handleSaveToken );
	// elementor.channels.editor.on( 'trx_addons_elementor_extension:exportCSS', trx_addons_elementor_extension.handleCSSExport );
} );
