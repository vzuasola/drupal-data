(function ($, Drupal, drupalSettings, CKEDITOR) {

    CKEDITOR.dtd.$removeEmpty.span = 0;

    function getSelectedSpan(editor) {
        var selection = editor.getSelection();
        var selectedElement = selection.getSelectedElement();

        var allowedTags = ['span', 'p', 'ul', 'li', 'div', 'a'];

        if (selectedElement) {
            for (i = 0; i <= allowedTags.length; i++) {
                if (selectedElement.is(allowedTags[i])) {
                    return selectedElement;
                }
            }
        }

        var range = selection.getRanges(true)[0];

        if (range) {
            range.shrink(CKEDITOR.SHRINK_TEXT);

            for (i = 0; i <= allowedTags.length; i++) {
                if (editor.elementPath(range.getCommonAncestor()).contains(allowedTags[i], 1)) {
                    return editor.elementPath(range.getCommonAncestor()).contains(allowedTags[i], 1);
                }
            }
        }
        return null;
    }

    var onSelect = function(editor) {

        var span = getSelectedSpan(editor);
        
        if (span) {
            if (span.getAttribute('class') != null) {
                var classes = span.getAttribute('class').split(' ');

                var fontSizes = editor.ui.get('FontSizes');
                var fontColors = editor.ui.get('FontColors');
                
                for (i = 0; i < classes.length; i++) {
                    if (classes[i].match(/^text\-[0-9]/)) {
                        fontSizes.setValue(classes[i], span.getAttribute('data-font-size'));
                    }
                    if (classes[i].match(/^text\-[a-zA-Z\-]/)) {
                        fontColors.setValue(classes[i], span.getAttribute('data-font-color'));
                    }
                }
            }
        }
    };

    var onFontChange = function(editor, value, items) {

        var span = getSelectedSpan(editor);
        var selection = editor.getSelection();
        var selectionRange = selection.getRanges(true)[0];
        var selected_text = selection.getSelectedText();
        

        if (span) {
            var className = span.$.className.split(' ');
            for(i = 0; i < className.length; i++) {
                if (className[i].match(/^text\-[0-9]/)) {
                    className.splice(i, 1);
                }
            }
            className.push(value);
            span.setAttributes({ class: className.join(' ') });
            span.data('font-size', items[value]);
        } else {
            var span = new CKEDITOR.dom.element("span");
            span.setAttributes({ class: value });
            span.data('font-size', items[value]);
            span.setText(selected_text);
            editor.insertElement(span);   
            
        }
    }

    var onFontColorChange = function(editor, value, items) {

        var span = getSelectedSpan(editor);

        var selected_text = editor.getSelection().getSelectedText();

        if (span) {
            var className = span.$.className.split(' ');
            for(i = 0; i < className.length; i++) {
                if (className[i].match(/^text\-[a-zA-Z\-]/)) {
                    className.splice(i, 1);
                }
            }
            className.push(value);
            span.setAttributes({ class: className.join(' ') });
            span.data('font-color', items[value]);
        } else {
            var span = new CKEDITOR.dom.element("span");
            span.setAttributes({ class: value });
            span.setText(selected_text);  
            span.data('font-color', items[value]);
            editor.insertElement(span);   
        }
    }


    CKEDITOR.plugins.add('casino_editor', {
            requires : ['richcombo', 'dialog'],
            icons: 'simplelink',

            init: function (editor) {

                this._editor = editor;
                var config = editor.config;

                // editor.removeListener('link');

                // editor.on('contentDom', function() {
                //     editor.document.on('keyup', function(event) {
                //         console.log('ye')
                //     });
                // });

                // editor.on('doubleclick', function( evt )
                // {
                //     onSelect(editor);
                // });

                editor.ui.addRichCombo('FontSizes',
                {
                    label: 'Font Size',
                    title: 'Font Size',
                    init: function() {
                        // TODO: pull this from config?
                        this.add('text-12', '12px', '12px');
                        this.add('text-14', '14px', '14px');
                        this.add('text-16', '16px', '16px');
                        this.add('text-20', '20px', '20px');
                        this.add('text-36', '36px', '36px');
                        this.add('text-48', '48px', '48px');
                        this.add('text-72', '72px', '72px');
                    },

                    onClick: function(value, marked)
                    {
                        editor.fire( 'saveSnapshot' );
                        onFontChange(editor, value, this._.items);
                        this.setValue(value, this._.items[value]);
                    }
                });

                editor.ui.addRichCombo('FontColors',
                {
                    id: 'fontcolor',
                    label: 'Font Color',
                    title: 'Font Color',
                    init: function() {
                        // TODO: pull this from config
                        this.add('text-yellow', 'Yellow', 'Yellow');
                        this.add('text-red', 'Red', 'Red');
                        this.add('text-dark-red', 'Dark Red', 'Dark Red');
                        this.add('text-white', 'White', 'White');
                        this.add('text-lightest-gray', 'Lightest Gray', 'Lightest Gray');
                        this.add('text-light-gray', 'Light Gray ', 'Light Gray');
                        this.add('text-gray', 'Gray', 'Gray');
                        this.add('text-dark-gray', 'Dark Grey', 'Dark Grey');
                        this.add('text-black', 'Black', 'Black');
                        this.add('text-light-gold', 'Light Gold', 'Light Gold');
                    },


                    onClick: function(value)
                    {
                        editor.fire( 'saveSnapshot' );

                        onFontColorChange(editor, value, this._.items);
                        this.setValue(value, this._.items[value]);
                    }
                });

                editor.addCommand( 'simplelink', new CKEDITOR.dialogCommand( 'simplelinkDialog' ) );

                editor.ui.addButton( 'SimpleLink', {
                    label: 'Add a link',
                    icons: 'simplelink',
                    command: 'simplelink'
                });

                CKEDITOR.dialog.add( 'simplelinkDialog', this.path + 'js/dialogs/simplelink.js' );

            }
        }
    );

})(jQuery, Drupal, drupalSettings, CKEDITOR);