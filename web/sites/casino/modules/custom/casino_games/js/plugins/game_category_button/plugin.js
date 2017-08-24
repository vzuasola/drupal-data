(function ($, Drupal, drupalSettings, CKEDITOR) {
    function bindSelectionChange(editor) {
        editor.getCommand('game_category_button').disable();

        editor.on( 'selectionChange', function( evt ) {
            var categoryButton = this.getCommand( 'game_category_button' );
            var selection = editor.getSelection();
            var selector = selection.getStartElement()
            var element;

            if(selector) {
                element = selector.getAscendant( 'a', true );
                if (element && !element.data('game-category')) {
                    categoryButton.disable();
                } else {
                    categoryButton.enable();
                }
            } else {
                categoryButton.enable();
            }
        });
    }
    CKEDITOR.plugins.add('game_category_button', {
            requires : ['dialog'],
            icons: 'game_category_button',
            lang: 'en',
            init: function (editor) {
                var config = editor.config;

                editor.addCommand( 'game_category_button', new CKEDITOR.dialogCommand( 'game_category_button' ) );

                editor.ui.addButton('game_category_button', {
                    label: editor.lang.game_category_button.categoryButton.label,
                    command: 'game_category_button'
                });
                CKEDITOR.dialog.add( 'game_category_button', this.path + 'js/dialogs/game_category_button.js' );
                bindSelectionChange(editor);
            }/*,
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
            }*/
        }
    );
})(jQuery, Drupal, drupalSettings, CKEDITOR);
