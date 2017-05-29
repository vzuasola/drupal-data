CKEDITOR.dialog.add("link", function(editor) {
    var plugin = CKEDITOR.plugins.link,
        initialLinkText;

    var allowedLangCodes = [
        'sc', 'ch'
    ];

    return {
        // allowedContent: "a[href,target]",
        title: "Insert Link",
        minWidth: 550,
        minHeight: 100,
        resizable: CKEDITOR.DIALOG_RESIZE_NONE,
        contents:
        [{
            id: "Link",
            label: "Link",
            elements:
            [{
                type: "text",
                label: "Link",
                id: "edp-URL",
                validate: CKEDITOR.dialog.validate.regex(/^(\/|http(|s)|mailto\:).*/i, "Please enter a valid url." ),
                setup: function(data) {
                    this.setValue(data.href);
                },
                commit: function(data) {
                    var url = this.getValue();
                    if (/^(http|https)/.test(url.toLowerCase()) == false) {
                        var segments = url.replace(/^\/|\/$/g, '').split('/');
                        if (segments && allowedLangCodes.indexOf(segments[0]) == -1) {
                            url = '/' + editor.config.language + '/' + editor.config.site + url;
                        }
                    }
                    data.href = url;
                }               
            }, 
            {
                type: "text",
                label: "Text",
                id: "edp-text-display",
                setup: function() {
                    this.setValue( editor.getSelection().getSelectedText() );
                    initialLinkText = this.getValue();
                },
                commit: function(data) {
                    data.linkText = this.getValue();
                }   
            }, 
            {
                requiredContent: 'a[target]', // This is not fully correct, because some target option requires JS.
                type: "select",
                label: "Target",
                items: [ ['New Tab', '_blank'], ['Same Tab', '_self'], ['New Window', 'window'] ],
                'default': '_blank',
                setup: function(data) {
                    this.setValue( data.target || '_blank' );
                },
                commit: function(data) {
                    data.target = this.getValue();
                }
            }]
        }],
        onShow: function() {
            var editor = this.getParentEditor(),
                selection = editor.getSelection(),
                selectedElement = selection.getSelectedElement(),
                element = null;

            if ( ( element = plugin.getSelectedLink( editor ) ) && element.hasAttribute( 'href' ) ) {
                // Don't change selection if some element is already selected.
                // For example - don't destroy fake selection.
                if ( !selectedElement ) {
                    selection.selectElement( element );
                    selectedElement = element;
                }
            } else {
                element = null;
            }

            var data = plugin.parseLinkAttributes( editor, element );

            this._.selectedElement = element;

            this.setupContent( data );
        },
        onOk: function() {
            var data = {};

            // Collect data from fields.
            this.commitContent(data);

            var selection = editor.getSelection(),
                attributes = plugin.getLinkAttributes( editor, data ),
                nestedLinks;

            if ( !this._.selectedElement ) {
                var range = selection.getRanges()[ 0 ],
                    text;

                // Use link URL as text with a collapsed cursor.
                if ( initialLinkText !== data.linkText ) {
                    text = new CKEDITOR.dom.text( data.linkText, editor.document );

                    // Shrink range to preserve block element.
                    range.shrink( CKEDITOR.SHRINK_TEXT );

                    // Use extractHtmlFromRange to remove markup within the selection. Also this method is a little
                    // smarter than range#deleteContents as it plays better e.g. with table cells.
                    editor.editable().extractHtmlFromRange( range );
                    
                    range.insertNode( text );
                }

                // Editable links nested within current range should be removed, so that the link is applied to whole selection.
                nestedLinks = range._find( 'a' );

                for ( var i = 0; i < nestedLinks.length; i++ ) {
                    nestedLinks[ i ].remove( true );
                }

                // Apply style.
                var style = new CKEDITOR.style( {
                    element: 'a',
                    attributes: attributes.set
                } );

                style.type = CKEDITOR.STYLE_INLINE; // need to override... dunno why.
                style.applyToRange( range, editor );
                range.select();
            } else {
                // We're only editing an existing link, so just overwrite the attributes.
                var element = this._.selectedElement,
                    newText;

                element.setAttributes( attributes.set );
                // element.removeAttributes( attributes.removed );

                if ( data.linkText && initialLinkText != data.linkText ) {
                    // Display text has been changed.
                    newText = data.linkText;
                }

                if ( newText ) {
                    element.setText( newText );
                    // We changed the content, so need to select it again.
                    selection.selectElement( element );
                }

                delete this._.selectedElement;
            }
        }
    };
});
