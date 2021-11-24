CKEDITOR.dialog.add("game_category_button", function(editor) {
    var fieldsLang = editor.lang.game_category_button.categoryButtonFields;

    return {
        allowedContent: "a[href,data-game-category]",
        title: "Insert Game Category Button",
        minWidth: 550,
        minHeight: 100,
        resizable: CKEDITOR.DIALOG_RESIZE_NONE,
        contents: [
            {
                id: "game_category_button",
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
                            label: fieldsLang.alias.label,
                            id: "alias",
                            validate: CKEDITOR.dialog.validate.notEmpty(fieldsLang.alias.notEmptyError),
                            setup: function( element ) {
                                var alias = element.data('game-category');
                                this.setValue(alias);
                            },
                            commit: function(element) {
                                var alias = this.getValue();
                                element.setAttribute('data-game-category', alias);
                                if (!element.getText()) {
                                    element.setText(this.getValue());
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

            if ((element && element.getName() === 'a' && !element.data('game-category')) ||
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

            this.element = element;

            this.setupContent(this.element);
        },
        onOk: function() {
            this.commitContent(this.element);

            if(this.insertMode) {
                editor.insertElement(this.element);
            }
        }
    };
});
