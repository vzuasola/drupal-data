<?php

namespace Drupal\msw_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * MSWSecurityQuestionForm.
 *
 * @WebcomposerForm(
 *   id = "msw_security_question_form",
 *   name = "MSW Security Question Form",
 * )
 */

class MSWSecurityQuestionForm extends WebcomposerFormBase implements WebcomposerFormInterface
{

    /**
     * @{inheritdoc}
     */
    public function getSettings()
    {
        return [
            'show' => [
                '#title' => 'Show this form',
                '#type' => 'checkbox',
                '#default_value' => true
            ],
            'alias' => [
                '#title' => 'Security Question Form',
                '#type' => 'textfield',
                '#description' => 'Security Question Form Alias',
            ],
        ];
    }

    public function getFields()
    {
        return [
            'header_markup' => [
                'name' => 'Header Markup',
                'type' => 'markup',
                'settings' => [
                    'markup' => [
                        '#title' => 'Header Blurb',
                        '#type' => 'text_format',
                        '#default_value' => '',
                    ],
                ],
            ],

            'question_markup' => [
                'name' => 'Question Markup',
                'type' => 'markup',
                'settings' => [
                    'markup' => [
                        '#title' => 'Question Messages',
                        '#type' => 'textfield',
                        '#default_value' => '',
                    ],
                ],
            ],

            'security_answer' => [
                'name' => 'Security question answer',
                'type' => 'password',
                'settings' => [
                    'annotation' => [
                        '#title' => 'Security question answer Annotation text',
                        '#description' => 'Field annotation that will be displayed on focus',
                    ],
                ],
            ],

            'error_markup' => [
                'name' => 'Error Markup',
                'type' => 'markup',
                'settings' => [
                    'markup' => [
                        '#title' => 'Error Messages',
                        '#type' => 'text_format',
                        '#default_value' => '',
                    ],
                ],
            ],

            "cancel_btn" => [
                "name" => "Cancel",
                "type" => "button",
                "settings" => [
                    "label" => [
                        "#title" => "Cancel",
                        "#type" => "textfield",
                        "#description" => "Cancel",
                        "#default_value" => "Cancel",
                    ]
                ]
            ],

            "submit" => [
                "name" => "Submit",
                "type" => "submit",
                "settings" => [
                    "label" => [
                        "#title" => "Submit Label",
                        "#type" => "textfield",
                        "#description" => "Label for the Submit button",
                        "#default_value" => "Save Changes",
                    ]
                ]
            ]
        ];
    }
}
