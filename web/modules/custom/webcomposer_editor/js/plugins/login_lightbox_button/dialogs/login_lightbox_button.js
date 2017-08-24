CKEDITOR.dialog.add("login_lightbox_button", function(editor) {
    var fieldsLang = editor.lang.login_lightbox_button.loginLightboxButtonFields;

    return {
        allowedContent: "a[href,data-game-category]",
        title: "Insert Game Category Button",
        minWidth: 550,
        minHeight: 100,
        resizable: CKEDITOR.DIALOG_RESIZE_NONE,
        contents: [
            {
                id: "login_lightbox_button",
                label: "Game Category Button",
                    elements: [
                        {
                            type: "text",
                            label: fieldsLang.label.label,
                            id: "label",
                            validate: CKEDITOR.dialog.validate.notEmpty(fieldsLang.label.notEmptyError),
                            setup: function( element ) {
                                var label = element.getText();
                                this.setValue(label);
                            },
                            commit: function(element) {
                                var currentValue = this.getValue();
                                if(currentValue !== "" && currentValue !== null) {
                                    element.setText(currentValue);
                                }
                            }
                        },
                        {
                            type: "text",
                            label: fieldsLang.class.label,
                            id: "class",
                            setup: function( element ) {
                                var classes = element.getAttribute('class');
                                this.setValue(classes);
                            },
                            commit: function(element) {
                                var classes = this.getValue();
                                element.setAttribute('class', classes);
                            }
                        }
                    ]
            }
        ],
        onShow: function() {
            var selection = editor.getSelection();
            var selector = selection.getStartElement()
            var element;

            if(selector) {
                 element = selector.getAscendant( 'a', true );
            }

            if ((element && element.getName() === 'a' && !element.data('login')) ||
                (!element || element.getName() != 'a')) {
                element = editor.document.createElement('a');

                if(selection) {
                    element.setText(selection.getSelectedText());
                }

                this.insertMode = true;
            } else {
                this.insertMode = false;
            }

            element.setAttribute("href", "#");
            element.setAttribute("data-login", "lightbox");

            this.element = element;

            this.setupContent(this.element);
        },
        onOk: function() {
            var dialog = this;
            var anchorElement = this.element;

            this.commitContent(this.element);

            if(this.insertMode) {
                editor.insertElement(this.element);
            }
        }
    };
});
