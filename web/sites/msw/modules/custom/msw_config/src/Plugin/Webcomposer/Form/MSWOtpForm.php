<?php

namespace Drupal\msw_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * MSWOtpForm.
 *
 * @WebcomposerForm(
 *   id = "msw_otp_form",
 *   name = "MSW OTP Form",
 * )
 */

class MSWOtpForm extends WebcomposerFormBase implements WebcomposerFormInterface
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
                '#title' => 'OTP Form',
                '#type' => 'textfield',
                '#description' => 'OTP Form Alias',
            ],
        ];
    }

    public function getFields()
    {
        return [

            'otp_code' => [
                'name' => 'OTP Code',
                'type' => 'textfield',
                'settings' => [
                    'label' => [
                        '#title' => 'OTP Code Label',
                        '#type' => 'textfield',
                        '#description' => 'The label for the OTP Code field',
                        '#default_value' => 'OTP Code',
                    ],
                    'placeholder' => [
                        '#title' => 'OTP Code placeholder label',
                        '#type' => 'textfield',
                        '#description' => 'Label for OTP Code field placeholder',
                        '#default_value' => 'OTP Code',
                    ],
                    'annotation' => [
                        '#title' => 'OTP Code Annotation text',
                        '#type' => 'textarea',
                        '#description' => 'Field annotation that will be displayed on focus',
                    ],
                ],
            ],
            "request_new_otp" => [
                "name" => "Request New OTP",
                "type" => "button",
                "settings" => [
                    "label" => [
                        "#title" => "Request New OTP Label",
                        "#type" => "textfield",
                        "#description" => "Label for the Request New OTP button",
                        "#default_value" => "Request New OTP",
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
            ],
            "cancel" => [
                "name" => "Cancel",
                "type" => "button",
                "settings" => [
                    "label" => [
                        "#title" => "Cancel Label",
                        "#type" => "textfield",
                        "#description" => "Label for the Cancel button",
                        "#default_value" => "Cancel",
                    ]
                ]
            ]
        ];
    }
}
