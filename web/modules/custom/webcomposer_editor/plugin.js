(function ($, Drupal, drupalSettings, CKEDITOR) {
    var fontSizes = [
        ['12px', 'text-12'],
        ['14px', 'text-14'],
        ['16px', 'text-16'],
        ['18px', 'text-18'],
        ['20px', 'text-20'],
        ['36px', 'text-36'],
        ['48px', 'text-48'],
        ['72px', 'text-72']
    ];

    var fontColors = [
        ['Yelow', 'text-yellow'],
        ['Red', 'text-red'],
        ['Dark Red', 'text-dark-red'],
        ['White', 'text-white'],
        ['Lightest Gray', 'text-lightest-gray'],
        ['Light Gray', 'text-light-gray'],
        ['Gray', 'text-gray'],
        ['Dark Gray', 'text-dark-gray'],
        ['Black', 'text-black'],
        ['Light Gold', 'text-light-gold'],
    ];

    var fontSizesStr = '';
    $.each(fontSizes, function(key, value) {
        fontSizesStr += (value[0] + '/' + value[1] + ';');
    });

    var fontColorsStr = '';
    $.each(fontColors, function(key, value) {
        fontColorsStr += (value[0] + '/' + value[1] + ';');
    });

    CKEDITOR.config.fontSizes = fontSizesStr;
    CKEDITOR.config.fontSizesDefaultLabel = '';
    CKEDITOR.config.fontSizeStyle = {
        element: 'span',
        attributes: { 
            'class': '#(size)'
        }
    };

    CKEDITOR.config.fontColors = fontColorsStr;
    CKEDITOR.config.fontColorsDefaultLabel = '';
    CKEDITOR.config.fontColorStyle = {
        element: 'span',
        attributes: { 
            'class': '#(color)'
        }
    };

    function addCombo( editor, comboName, styleType, lang, entries, defaultLabel, styleDefinition, order ) {
        var config = editor.config,
            style = new CKEDITOR.style( styleDefinition );

        // Gets the list of fonts from the settings.
        var names = entries.split( ';' ),
            values = [];

        // Create style objects for all fonts.
        var styles = {};
        for ( var i = 0; i < names.length; i++ ) {
            var parts = names[ i ];

            if ( parts ) {
                parts = parts.split( '/' );

                var vars = {},
                    name = names[ i ] = parts[ 0 ];

                vars[ styleType ] = values[ i ] = parts[ 1 ] || name;

                styles[ name ] = new CKEDITOR.style( styleDefinition, vars );
                styles[ name ]._.definition.name = name;
            } else {
                names.splice( i--, 1 );
            }
        }

        editor.ui.addRichCombo( comboName, {
            label: lang.label,
            title: lang.panelTitle,
            toolbar: 'styles,' + order,
            allowedContent: style,
            requiredContent: style,
            contentTransformations: [
                [
                    {
                        element: 'font',
                        check: 'span',
                        left: function( element ) {
                            return !!element.attributes.size ||
                                !!element.attributes.align ||
                                !!element.attributes.face;
                        },
                        right: function( element ) {
                            var sizes = [
                                '', // Non-existent size "0"
                                'x-small',
                                'small',
                                'medium',
                                'large',
                                'x-large',
                                'xx-large',
                                '48px' // Closest value to what size="7" might mean.
                            ];

                            element.name = 'span';

                            if ( element.attributes.size ) {
                                element.styles[ 'font-size' ] = sizes[ element.attributes.size ];
                                delete element.attributes.size;
                            }

                            if ( element.attributes.align ) {
                                element.styles[ 'text-align' ] = element.attributes.align;
                                delete element.attributes.align;
                            }

                            if ( element.attributes.face ) {
                                element.styles[ 'font-family' ] = element.attributes.face;
                                delete element.attributes.face;
                            }
                        }
                    }
                ]
            ],
            panel: {
                css: [ CKEDITOR.skin.getPath( 'editor' ) ].concat( config.contentsCss ),
                multiSelect: false,
                attributes: { 'aria-label': lang.panelTitle }
            },

            init: function() {
                this.startGroup( lang.panelTitle );

                for ( var i = 0; i < names.length; i++ ) {
                    var name = names[ i ];

                    // Add the tag entry to the panel list.
                    this.add( name, styles[ name ].buildPreview(), name );
                }
            },

            onClick: function( value ) {
                editor.focus();
                editor.fire( 'saveSnapshot' );

                var previousValue = this.getValue(),
                    style = styles[ value ];

                // When applying one style over another, first remove the previous one (#12403).
                // NOTE: This is only a temporary fix. It will be moved to the styles system (#12687).
                if ( previousValue && value != previousValue ) {
                    var previousStyle = styles[ previousValue ],
                        range = editor.getSelection().getRanges()[ 0 ];

                    // If the range is collapsed we can't simply use the editor.removeStyle method
                    // because it will remove the entire element and we want to split it instead.
                    if ( range.collapsed ) {
                        var path = editor.elementPath(),
                            // Find the style element.
                            matching = path.contains( function( el ) {
                                return previousStyle.checkElementRemovable( el );
                            } );

                        if ( matching ) {
                            var startBoundary = range.checkBoundaryOfElement( matching, CKEDITOR.START ),
                                endBoundary = range.checkBoundaryOfElement( matching, CKEDITOR.END ),
                                node, bm;

                            // If we are at both boundaries it means that the element is empty.
                            // Remove it but in a way that we won't lose other empty inline elements inside it.
                            // Example: <p>x<span style="font-size:48px"><em>[]</em></span>x</p>
                            // Result: <p>x<em>[]</em>x</p>
                            if ( startBoundary && endBoundary ) {
                                bm = range.createBookmark();
                                // Replace the element with its children (TODO element.replaceWithChildren).
                                while ( ( node = matching.getFirst() ) ) {
                                    node.insertBefore( matching );
                                }
                                matching.remove();
                                range.moveToBookmark( bm );

                            // If we are at the boundary of the style element, move out and copy nested styles/elements.
                            } else if ( startBoundary || endBoundary ) {
                                range.moveToPosition( matching, startBoundary ? CKEDITOR.POSITION_BEFORE_START : CKEDITOR.POSITION_AFTER_END );
                                cloneSubtreeIntoRange( range, path.elements.slice(), matching );
                            } else {
                                // Split the element and clone the elements that were in the path
                                // (between the startContainer and the matching element)
                                // into the new place.
                                range.splitElement( matching );
                                range.moveToPosition( matching, CKEDITOR.POSITION_AFTER_END );
                                cloneSubtreeIntoRange( range, path.elements.slice(), matching );
                            }

                            editor.getSelection().selectRanges( [ range ] );
                        }
                    } else {
                        editor.removeStyle( previousStyle );
                    }
                }

                editor[ previousValue == value ? 'removeStyle' : 'applyStyle' ]( style );

                editor.fire( 'saveSnapshot' );
            },

            onRender: function() {
                editor.on( 'selectionChange', function( ev ) {
                    var currentValue = this.getValue();

                    var elementPath = ev.data.path,
                        elements = elementPath.elements;

                    // For each element into the elements path.
                    for ( var i = 0, element; i < elements.length; i++ ) {
                        element = elements[ i ];

                        // Check if the element is removable by any of
                        // the styles.
                        for ( var value in styles ) {
                            if ( styles[ value ].checkElementMatch( element, true, editor ) ) {
                                if ( value != currentValue )
                                    this.setValue( value );
                                return;
                            }
                        }
                    }

                    // If no styles match, just empty it.
                    this.setValue( '', defaultLabel );
                }, this );
            },

            refresh: function() {
                if ( !editor.activeFilter.check( style ) )
                    this.setState( CKEDITOR.TRISTATE_DISABLED );
            }
        } );
    };

    CKEDITOR.config.protectedSource.push(/<a[^>]*><\/a>/g);
    CKEDITOR.dtd.$removeEmpty.span = 0;


    CKEDITOR.plugins.add('webcomposer_editor', {
            requires : ['richcombo', 'dialog'],
            icons: 'link,unlink',
            lang: 'en',
            init: function (editor) {

                this._editor = editor;
                var config = editor.config;

                addCombo( editor, 'FontSizes', 'size', editor.lang.webcomposer_editor.fontSize, config.fontSizes, config.fontSizesDefaultLabel, config.fontSizeStyle, 30 );
                addCombo( editor, 'FontColors', 'color', editor.lang.webcomposer_editor.fontColor, config.fontColors, config.fontfontColorsDefaultLabel, config.fontColorStyle, 30 );

                editor.addCommand( 'link', new CKEDITOR.dialogCommand( 'link' ) );
                editor.addCommand( 'unlink', new CKEDITOR.unlinkCommand() );

                editor.ui.addButton( 'Link', {
                    label: 'Link',
                    command: 'link'
                });
                editor.ui.addButton( 'Unlink', {
                    label: 'Unlink',
                    command: 'unlink'
                });
                CKEDITOR.dialog.add( 'link', this.path + 'js/dialogs/link.js' );
            },
            afterInit: function(editor) {
                var dataProcessor = editor.dataProcessor,
                    htmlFilter = dataProcessor && dataProcessor.htmlFilter;

                if (htmlFilter) {
                    htmlFilter.addRules({
                        elements: {
                            $: function (element) {
                                element.forEach(function(node) {
                                    if (node.name == 'img' && typeof node.attributes['draggable'] === 'undefined') {
                                        var src = node.attributes['src'];
                                        // remove publich path
                                        var inlineSrc = src.replace(editor.config.publicPath, '');
                                        // trim slashes
                                        inlineSrc = inlineSrc ? inlineSrc.replace(/^\/+|\/+$/g, '') : null;
                                        // add attribute to image
                                        node.attributes['inline-src'] = inlineSrc;
                                    }
                                });
                                return element;
                            }
                        }
                    });
                }
            }
        }
    );

    CKEDITOR.plugins.link = {
        getSelectedLink: function( editor ) {
            var selection = editor.getSelection();
            var selectedElement = selection.getSelectedElement();
            if ( selectedElement && selectedElement.is( 'a' ) )
                return selectedElement;

            var range = selection.getRanges()[ 0 ];

            if ( range ) {
                range.shrink( CKEDITOR.SHRINK_TEXT );
                return editor.elementPath( range.getCommonAncestor() ).contains( 'a', 1 );
            }
            return null;
        },
        getLinkAttributes: function( editor, data ) {
            var set = {},
                url = ( data.href && CKEDITOR.tools.trim( data.href ) ) || '';

            set[ 'data-cke-saved-href' ] = url;

            if ( data.target ) {
                set.target = data.target;
            }

            if ( set[ 'data-cke-saved-href' ] )
                set.href = set[ 'data-cke-saved-href' ];

            return {
                set: set
            };
        },
        parseLinkAttributes: function( editor, element ) {
            var href = ( element && ( element.data( 'cke-saved-href' ) || element.getAttribute( 'href' ) ) ) || '',
                retval = {};

            retval.href = href;

            // Load target and popup settings.
            if ( element ) {
                var target = element.getAttribute( 'target' );

                retval.target = target;
            }

            return retval;
        },
    };

    CKEDITOR.unlinkCommand = function() {};
    CKEDITOR.unlinkCommand.prototype = {
        exec: function( editor ) {
            var style = new CKEDITOR.style( { element: 'a', type: CKEDITOR.STYLE_INLINE, alwaysRemoveElement: 1 } );
            editor.removeStyle( style );
        },

        refresh: function( editor, path ) {
            // Despite our initial hope, document.queryCommandEnabled() does not work
            // for this in Firefox. So we must detect the state by element paths.

            var element = path.lastElement && path.lastElement.getAscendant( 'a', true );

            if ( element && element.getName() == 'a' && element.getAttribute( 'href' ) && element.getChildCount() )
                this.setState( CKEDITOR.TRISTATE_OFF );
            else
                this.setState( CKEDITOR.TRISTATE_DISABLED );
        },

        contextSensitive: 1,
        startDisabled: 1,
        requiredContent: 'a[href]'
    };

})(jQuery, Drupal, drupalSettings, CKEDITOR);
