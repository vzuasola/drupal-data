(function ($, Drupal, drupalSettings, CKEDITOR) {
    function bindSelectionChange(editor) {
        editor.getCommand('login_lightbox_button').disable();

        editor.on( 'selectionChange', function( evt ) {
            var loginLightboxButton = this.getCommand( 'login_lightbox_button' );
            var selection = editor.getSelection();
            var selector = selection.getStartElement()
            var element;

            if(selector) {
                element = selector.getAscendant( 'a', true );
                if (element && !element.data('login')) {
                    loginLightboxButton.disable();
                } else {
                    loginLightboxButton.enable();
                }
            } else {
                loginLightboxButton.enable();
            }
        });
    }
    CKEDITOR.plugins.add('login_lightbox_button', {
            requires : ['dialog'],
            icons: 'login_lightbox_button',
            lang: 'en',
            init: function (editor) {
                var config = editor.config;

                editor.addCommand( 'login_lightbox_button', new CKEDITOR.dialogCommand( 'login_lightbox_button' , {
                    startDisabled: true
                }));

                editor.ui.addButton('login_lightbox_button', {
                    label: editor.lang.login_lightbox_button.loginLightboxButton.label,
                    command: 'login_lightbox_button'
                });

                CKEDITOR.dialog.add( 'login_lightbox_button', this.path + 'dialogs/login_lightbox_button.js' );
                bindSelectionChange(editor);
            }
        }
    );
})(jQuery, Drupal, drupalSettings, CKEDITOR);
