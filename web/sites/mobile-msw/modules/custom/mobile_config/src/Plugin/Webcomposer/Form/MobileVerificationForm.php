<?php

namespace Drupal\mobile_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * MobileVerificationForm.
 *
 * @WebcomposerForm(
 *   id = "mobile_verification_form",
 *   name = "Mobile Verification Form",
 * )
 */

class MobileVerificationForm extends WebcomposerFormBase implements WebcomposerFormInterface
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
                '#title' => 'Mobile Verification Form',
                '#type' => 'textfield',
                '#description' => 'Mobile Verification Form Alias',
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

            'verification_code' => [
                'name' => 'Mobile Verification Code',
                'type' => 'textfield',
                'settings' => [
                    'label' => [
                      '#title' => 'Mobile Verification Label',
                      '#type' => 'textfield',
                      '#description' => 'The label for the Mobile Verification field',
                      '#default_value' => '',
                    ],
                ],
            ],

            'messages_markup' => [
                'name' => 'Message Markup',
                'type' => 'markup',
                'settings' => [
                    'markup' => [
                        '#title' => 'Message Messages',
                        '#type' => 'text_format',
                        '#default_value' => '',
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
                        "#default_value" => "Submit",
                    ]
                ]
            ]
        ];
    }
}
